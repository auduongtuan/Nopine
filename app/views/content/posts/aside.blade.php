	<aside class="post-info">

		<div class="post-categories">
		<i class="icon-folder-open"></i>{{ $post->category->a }}</div>

		@if($tags = $post->tags_list)
		<div class="post-tags">
		<i class="icon-tags"></i>{{ $tags }}
		</div>
		@endif

		<h4><i class="icon-random"></i>Bài viết ngẫu nhiên</h4>
		<ul class="post-random">
			@foreach(Post::random() as $post)
				<li><i class="icon-file-alt"></i>{{ HTML::link($post->link, $post->title) }}</li>
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