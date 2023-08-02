<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\{ Post, Tag };

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $selected_tag = $request->input('tag');

      // Retrieve the tag based on the tag ID
      $tag = Tag::where('tag', $selected_tag)->first();

      if($tag) {
        $posts = Post::whereHas('tags', function ($query) use ($tag) {
            $query->where('tags.id', $tag->id);
        })->orderBy('created_at', 'desc')->get();  
      }
      else {
        $posts = Post::with('tags')->where('created_by', 1)->orderBy('created_at', 'desc')->get();    
      }
      
      $tags = Tag::get();

      return view('posts', compact(['posts', 'tags', 'selected_tag']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $tags = Tag::get();

      return view('create_post', compact(['tags']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validatedData = $request->validate([
        'title' => 'required|string|max:50',
        'content' => 'required|string|max:2000',
        'tags' => ''
      ]);

      $post = new Post();
      $post->title = $validatedData['title'];
      $post->content = $validatedData['content'];
      $post->created_by = 1;
      $post->updated_by = 1;
      $post->save();

      // process tags
      if(isset($validatedData['tags'])) {
        foreach ($validatedData['tags'] as $tag) {
          $tag_match = Tag::where('tag', $tag)->first();

          if(is_null($tag_match)) {
            $tag_match = Tag::create(['tag' => $tag]);
          }

          // create post-tag relation
          $post->tags()->attach($tag_match->id);
        }    
      }

      return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $post = Post::find($id);
      
      return view('post', compact(['post']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $post = Post::find($id);
      $tags = Tag::get();

      return view('edit_post', compact('post', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $validatedData = $request->validate([
        'title' => 'required|string|max:50',
        'content' => 'required|string|max:2000',
        'tags' => ''
      ]);
      
      $post = Post::find($id);
      $post->update($validatedData);

      // process tags
      $tag_ids = [];
      if(isset($validatedData['tags'])) {
        foreach ($validatedData['tags'] as $tag) {
          $tag_match = Tag::where('tag', $tag)->first();

          if(is_null($tag_match)) {
              $tag_match = Tag::create(['tag' => $tag]);
          }

          $tag_ids[] = $tag_match->id;
        }
      }
      $post->tags()->sync($tag_ids);

      return redirect()->route('posts.index')->with('success', 'Post edited successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Post::destroy($id);

      return redirect('posts');
    }
}
