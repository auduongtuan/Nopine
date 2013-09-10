@section('title')
Quản lí bài viết
@stop

@section('content')
<div class="actions p30">
	<div class="pull-left">
		<a class="btn mright-10 btn-blue" href="/admin/new-post"><i class="icon-pencil"></i> Thêm bài mới</a>
		<a id="clean-cache" class="btn btn-yellow" href="/admin/clean-cache"><i class="icon-warning-sign"></i> Xóa Cache</a>
	</div>
	<div class="pull-right">
		<a target="_blank" href="/" class="btn"><i class="icon icon-home"></i></a>
		<a href="/logout" class="btn mleft-10"><i class="icon icon-off"></i></a>
	</div>
	<div class="clearfix"></div>
</div>

<ul id="posts" class="p30">
	
	@foreach($posts as $post)

	<li id="post-{{ $post->id }}" class="post post-category-{{ $post->category_id }} {{ $post->status }}">
		<div class="id post-icon"><a target="_blank" href="{{ $post->link }}" title="Xem bài viết này">{{ $post->admin_post_icon }}</a></div>
		<div class="pull-left">
			<div class="post-title">
				<a href="/admin/edit-post/{{ $post->id }}" title="Sửa bài viết này">{{ $post->title }}</a>
			</div>

			<div class="post-info">
				<span class="post-date">{{ $post->created_at }}</span>
				<span class="post-status"></span>
			</div>
		</div>
		<div class="clearfix"></div>
	</li>

	@endforeach

</ul>

{{ $posts->links() }}

@stop