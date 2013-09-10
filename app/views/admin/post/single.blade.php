@section('title')
	@if($post->id)
	Sửa bài {{ $post->title }}
	@else
	Thêm bài viết
	@endif
@stop

@section('content')

{{ Form::open(array('url' => 'admin/create-post', 'files' => true, 'class' => 'form-horizontal', 'id' => 'new-post')) }}

<div class="p30">
	{{ ($post->id) ? '<input type="hidden" name="id" value="'.$post->id.'">' : '' }}
	
	<div class="control-group">
	    <label class="control-label" for="title">Tên bài viết <em>với bài hát đặt dạng "tên bài hát | tên ca sĩ"</em></label>
	    <div class="controls">
			<input name="title" class="max-width" type="text" value="{{ $post->title }}">
	    </div>
  	</div>

  	<div class="control-group">
  		<div class="pull-left mright-30">
		    <label class="control-label" for="category_id">Chuyên mục</label>
		    <div class="controls">
		    	<select class="" name="category_id">
					<option>Chọn một chuyên mục</option>
				@foreach(Category::all() as $category)
					<option {{ ($post->category_id == $category->id||$category->id == Input::get('category_id')) ? 'selected="selected"' : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
				@endforeach
				</select>
				
		    </div>
		</div>

	    <div class="pull-left mright-30">
		    <label class="control-label" for="thumbnail">Ảnh đại diện <em>hỗ trợ .jpg, .png, .gif</em></label>
		    <div class="controls">
				<input name="thumbnail" class="50-width" type="file" />	
			</div>		

		</div>

		<div class="pull-left">
			<label class="control-label" for="status">Trạng thái</label>
			<div class="controls">
				<select class="" name="status">
					<option value="publish"{{ ($post->status == 'publish') ? ' selected' : '' }}>Xuất bản</option>
					<option value="draft"{{ ($post->status == 'draft') ? ' selected' : '' }}>Nháp</option>
				</select>
			</div>
		</div>

		<div class="clearfix"></div>

  	</div>

  	<div class="control-group" id="media-field">
	    <label class="control-label" for="tags">Video / Audio <em>hỗ trợ link từ youtube, nhaccuatui, zing hoặc file .mp3, .mp4</em></label>
	    <div class="controls">
			<input name="media" class="max-width" type="text" value="{{ $post->media }}">
		</div>
  	</div>



  	<div class="control-group" id="tags-field">
	    <label class="control-label" for="tags">Từ khóa (Tag) <em>mỗi từ khóa ngắn cách nhau bằng dấu phẩy</em></label>
	    <div class="controls">
			<input {{ ($tags_list = $post->tags_list) ? 'value="'.$post->tags_list.'"' : '' }} id="tags"  name="tags" id="tags-input" class="max-width" type="text" placeholder="Tag bài viết" />
	    </div>
  	</div>

	<div class="control-group">
		<label class="control-label" for="content">Nội dung</label>
		<div class="controls">
		<textarea name="content" id="content-textarea" id="content-textarea" rows="16" cols="100">
			{{ $post->content }}
		</textarea>
		</div>
	</div>


	<div class="form-actions">

		<div class="pull-left">
			<button id="submit" type="submit" class="btn mright-10 btn-blue"><i class="icon icon-white icon-ok"></i> Lưu bài viết</button>
		</div>

		<div class="pull-right">
			<button data-href="/admin" id="cancel" type="button" class="btn mright-10"><i class="icon icon-remove-sign"></i></button>
			@if($post->id)		
			<button data-id="{{ $post->id }}" id="soft-delete" type="button" class="btn btn-red"><i class="icon icon-white icon-trash"></i></button>
			@endif
		</div>

		<div class="clearfix"></div>
	</div>

</div>

</form>


@stop