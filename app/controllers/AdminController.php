<?php

class AdminController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function __construct()
	{
		$this->layout = 'admin.base';
	}

	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
			$this->layout->title = '';
		}		
	}

	public function getIndex()
	{
		return $this->getPosts();
	}

	public function getPosts()
	{
		$posts = Post::orderBy('created_at', 'DESC')->paginate(10);		
		$this->layout->title = 'Quản lí';
		$this->layout->content = View::make('admin.post.list')->with('posts', $posts);
		$this->layout->currentPage = 'posts';
	}

	public function getNewPost()
	{
		$this->layout->title = 'Bài viết mới';
		$this->layout->content = View::make('admin.post.single')->with('post', new Post);
		$this->layout->currentPage = 'post';
	}

	public function getEditPost($id)
	{
		if($post = Post::find($id))
		{
			$this->layout->title = 'Sửa bài viết';
			$this->layout->content = View::make('admin.post.single')->with('post', $post);
			$this->layout->currentPage = 'post';
		}
	}

	public function postCreatePost()
	{
		$validator = Validator::make(
		    array('name' => Input::get('title')),
		    array('name' => 'required|min:5'),
		    array('category_id' => 'required'),
		    array('content' => Input::get('content')),
		    array('content' => 'required|min:10')
		);
		if (!$validator->fails())
		{
			if(!$post = Post::find(Input::get('id'))) $post = new Post;
			$post->title = Input::get('title');
			$post->slug = Str::slug($post->title);		
			$post->content = Input::get('content');
			$post->category_id = Input::get('category_id');
			$post->status = Input::get('status');
			$post->media = Input::get('media');

			// Upload thumbnail
			if($file = Input::file('thumbnail'))
			{
				$destinationPath = 'uploads/thumbnails/';
				//$filename = $value->getClientOriginalName();
				$extension = '.'.$file->getClientOriginalExtension(); //if you need extension of the file
				$uploadSuccess = $file->move($destinationPath, $post->slug.$extension);
				 
				if($uploadSuccess) 
				{
					$post->thumbnail = $destinationPath.$post->slug.$extension;
				} 		
			}
			
			$post->save();
			Cache::flush();

			$post->tags = Input::get('tags');
			return Redirect::to('admin/edit-post/'.$post->id);			
		}
		else
		{
			return Redirect::back()->withErrors($validator);
		}
		// Delete Cache
		$cache = new Cache;
		$cache->flush();	
		
	}

	public function postSoftDeletePost()
	{
		if($post = Post::find(Input::get('id')))
		{
			$post->delete();
		}
	}

	public function postDeletePost()
	{
		if($post = Post::find(Input::get('id')))
		{
			$post->delete();
			$post->tags()->sync(array());
		}
	}

	public function getCategories()
	{
		$categories = Category::all();
		$this->layout->title = 'Thể loại';
		$this->layout->content = View::make('admin.categories')->with('categories', $categories);
	}

	public function getCategory()
	{
		
	}

	public function getTags()
	{
		$tags = Tag::all();
		$this->layout->title = 'Quản lí Thẻ';
		$this->layout->content = View::make('admin.tag.list')->with('tags', $tags);
		$this->layout->currentPage = 'tags';
	}

	public function postDeleteCategory()
	{
		if($category = Category::find(Input::get('id')))
		{
			$category->delete();
		}
	}

	public function postCleanCache()
	{
		Cache::flush();
		return Redirect::action('AdminController@getIndex');
	}

	public function getCleanCache()
	{
		Cache::flush();
		return Redirect::action('AdminController@getIndex');
	}

	public function getJsonTags()
	{
		$tags = array();
		$p = Input::get('term');
		foreach(Tag::where('name', 'like', "%{$p}%")->get() as $tag)
		{
			$tags[] = $tag->name;
		}
		return json_encode($tags);
	}

	public function getCleanTags()
	{
		foreach(Tag::all() as $tag)
		{
			if($tag->posts->count() == 0)
			{
				$tag->delete();
			}
		}
	}

}