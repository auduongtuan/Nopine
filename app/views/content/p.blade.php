<article class="post">
	@if($post->media)
		<div class="media-wrap">{{ $post->player }}</div>
	@endif
<div class="post-wrap">

	<h2 class="post-title"><a href="{{ $post->link }}">{{ $post->title }}</a></h2>

	<div class="post-date">
		Đăng ngày {{ $post->date }}
		@if($is_loggedin)
			<a class="edit" href="/admin/edit-post/{{ $post->id }}"><i class="icon-edit-sign"></i> Sửa</a>
		@endif
	</div>


	@if(!$is_post)

	<div class="post-content">
	{{ $post->mini }}	
	</div>

	@else
	<div class="post-content">
	{{ $post->full }}	
	</div>
	<aside class="post-info">

		<div class="post-categories">
		<i class="icon-folder-open"></i>{{ $post->category->a }}</div>

		@if($tags = $post->tags_link_list)
		<div class="post-tags">
		<i class="icon-tags"></i>{{ $tags }}
		</div>
		@endif

		<h4><i class="icon-random"></i>Bài viết ngẫu nhiên</h4>
		<ul class="post-random">
			@foreach(Post::random() as $post)
				<li><i class="icon-file-alt"></i>{{ $post->a }}</li>
			@endforeach
		</ul>

	</aside><!-- /.post-info -->
	
	<aside class="post-comment">
	<h4><i class="icon-comments"></i>Gửi bình luận</h4>
	<!-- FB Comments -->
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
	<div class="fb-comments" data-href="{{ $post->link }}"></div>
	</aside><!-- /.post-comment -->

	@endif

</div><!-- /.post-wrap -->

</article><!-- /.post -->
