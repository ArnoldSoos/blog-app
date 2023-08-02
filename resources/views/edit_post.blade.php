@include('header')

	<section class="section content">
		<h1 class="text-center">Edit post</h1>

		<a href="{{ url('posts') }}">
			<button class="button is-link">Back to posts</button>
		</a>

		<section class="section">
			<form method="post" action="{{ route('posts.update', $post->id) }}">
        @csrf
        @method('PUT')

        <div class="field">
				  <label class="label">Title</label>
				  <div class="control">
				    <input class="input" id="title" name="title" type="text" value="{{ $post->title }}" required maxlength="50">
				  </div>
				</div>
				@error('title')
		        <div class="notification is-danger">{{ $message }}</div>
		    @enderror

				<div class="field">
				  <label class="label">Content</label>
				  <div class="control">
				    <textarea class="textarea" id="content" name="content" required maxlength="2000">{{ $post->content }}</textarea>
				  </div>
				</div>
				@error('content')
		        <div class="error">{{ $message }}</div>
		    @enderror

				<div class="field">
				  <label class="label">Tags</label>
				  <div class="control">
				  	<select id="tags" name="tags[]" class="form-control select is-full-width" multiple="multiple" style="width: 100%">
							@foreach($tags as $tag)
				      	<option @if (in_array($tag->tag, $post->tags->pluck('tag')->toArray())) selected @endif>{{ $tag->tag }}</option>
				      @endforeach
						</select>
				  </div>
				</div>

        <!-- Add other fields as needed -->
        <div class="control has-text-right">
			    <button type="submit" class="button is-primary">Save</button>
			  </div>
	    </form>
	  </section>

	</section>

@include('footer')

<script type="text/javascript">
	$('#tags').select2({
		tags: true
	});
</script>