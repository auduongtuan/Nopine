<article class="post">

	@if($post->media)
		<div class="media-wrap">{{ $post->theMedia() }}</div>
	@endif

	<div class="post-wrap">

	<h2 class="post-title"><a href="{{ $post->link }}">{{ $post->title }}</a></h2>

	<div class="post-date">
		Đăng ngày {{ $post->date }}
		@if(Auth::check())
			<a class="edit" href="/admin/edit-post/{{ $post->id }}"><i class="icon-edit-sign"></i> Sửa</a>
		@endif
	</div>


	@if(Route::currentRouteName() != 'post')

		<div class="post-content">
		{{ $post->mi_content }}	
		</div>

	@else

		<div class="post-content">
		{{ $post->content_html }}	
		</div>
		
		@include('content.posts.aside');

	@endif

	</div><!-- /.post-wrap -->

</article><!-- /.post -->
