@include('header')

	<section class="section content">

		<div class="columns">
	    <div class="column">
	    	<a href="{{ url('posts') }}">
					<button class="button is-link is-fullwidth-mobile">Back to posts</button>
				</a>
	    </div>

	    <div class="column is-narrow">
	    	<a href="{{ route('posts.edit', $post->id) }}">
					<button class="button is-primary is-fullwidth-mobile">Edit</button>
				</a>
	    </div>

	    <div class="column is-narrow">
				<form method="post" action="{{ route('posts.destroy', $post->id) }}">
          @csrf
          @method('DELETE')
          <a href="{{ route('posts.destroy', $post->id) }}">
						<button type="submit" class="button is-danger is-fullwidth-mobile">Delete</button>
					</a>
        </form>
	    </div>
		</div>

		<h3 class="text-center">{{ $post->title }}</h3>

		<div class="tags is-inline-block">
      @foreach($post->tags as $tag)
      	<span class="tag is-light">{{ $tag->tag }}</span>
      @endforeach
    </div>

    <div class="is-inline-block">

    </div>

		<p>{{ $post->content }}</p>

		<hr class="mb-1">
    <p class="is-size-7">By {{ $post->authorName() }} on {{ $post->publishedAt() }}</p>

	</section>

@include('footer')