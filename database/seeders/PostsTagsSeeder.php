<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PostsTagsSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $posts = \App\Models\Post::latest()->take(10)->get();

    $tags_ids = \App\Models\Tag::pluck('id')->toArray();

    foreach ($posts as $post) {

      // get a random number between 1 and 4
      $rand_nr = rand(1, 4);

      for($i = 0; $i < $rand_nr; $i++) {
          // get a random tag id, and attach to actual post
          $post->tags()->attach($tags_ids[array_rand($tags_ids)]);
      }
        
    }
  }
}
