@include('header')

	<section class="section content">
		
		<h1 class="text-center">Posts</h1>

		<div class="columns">
	    <div class="column">
				<a href="{{ url('posts/create') }}">
					<button class="button is-link">Create post</button>
				</a>
	    </div>

	    <div class="column is-narrow">
	    	<form method="get" action="{{ route('posts.index') }}">
	        <div class="select">
					  <select name="tag" id="tag">
	            <option value="">All Tags</option>
	            @foreach($tags as $tag)
				      	<option value="{{ $tag->tag }}" @if ($selected_tag === $tag->tag) selected @endif>{{ $tag->tag }}</option>
				      @endforeach
	        </select>
					</div>
	        
	        <button class="button is-primary" type="submit">Filter by tags</button>
		    </form>
	    </div>
	</div>

	<div class="list has-visible-pointer-controls">
		@foreach($posts as $post)
			
			<div class="list-item">
		    <div class="list-item-content">
		      <div class="list-item-title">
		      	{{ $loop->iteration . '. ' . $post->title }}

			      <div class="tags is-inline-block">
				      @foreach($post->tags as $tag)
				      	<span class="tag is-light">{{ $tag->tag }}</span>
				      @endforeach
				    </div>
			    </div>

			    <p class="mb-1 is-size-7">By {{ $post->authorName() }} on {{ $post->publishedAt() }}</p>

		      <div class="list-item-description">{{ $post->content }}</div>
		    </div>

		    <div class="list-item-controls">
		      <div class="buttons is-right">
		        <a href="{{ url('posts/'.$post->id) }}">
			        <button class="button is-small">
			          <span class="icon is-small">
			            <i class="fas fa-eye"></i>
			          </span>
			          <span>View</span>
			        </button>
		        </a>

		        <a href="{{ route('posts.edit', $post->id) }}">
			        <button class="button is-small">
			          <span class="icon is-small">
			            <i class="fas fa-edit"></i>
			          </span>
			          <span>Edit</span>
			        </button>
		        </a>

	          <form method="post" action="{{ route('posts.destroy', $post->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="button is-small">
				          <span class="icon is-small">
				            <i class="fas fa-trash"></i>
				          </span>
				          <span>Delete</span>
                </button>
            </form>

		      </div>
		    </div>

		  </div>

			@endforeach
		</div>

	</section>

@include('footer')