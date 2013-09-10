<?php

class ContentController extends BaseController {

	public function __construct()
	{

		$this->layout = 'layouts.site';
		$this->page = Input::get('page', 1);
	} 		

	public function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	
		$this->layout->title = Config::get('blog.title', 'Page name');

		$this->layout->right = Config::get('blog.sep', ' | ').$this->layout->title;

		$this->layout->description = Config::get('blog.description');

		$this->layout->ogimage = null;

		$this->layout->follow = true;	

		$this->layout->categories = Category::all();

		$this->layout->body_attr = \Blog\Helper::bodyAttr();

		/* Global View Var */
		View::share('is_post', (bool) (Route::currentRouteName() == 'post'));
		View::share('is_loggedin', Auth::check());
	}

	public function setPosts($posts)
	{
		$posts = $posts->where('status', '=', 'publish')->paginate(Config::get('blog.perpage', 5));
		if(isset($posts) && $posts->getLastPage() >= $this->page)
		{
			$this->layout->content = View::make('content.posts.list')->with('posts', $posts);								
		}	
		else
		{
			App::abort(404);
		}
	}

	public function posts()
	{	
		$posts = Post::orderBy('created_at', 'DESC');	
		$this->setPosts($posts);	
	}

	public function post($category, $slug) 
	{		
		$post = Post::where('slug', '=', $slug)->first();
		if(!$post)
		{
			App::abort(404);
		}
		$post->addViews();

		$this->layout->title = $post->title.$this->layout->right;
		$this->layout->description = $post->excerpt;

		if($post->thumbnail)
		{
			$this->layout->ogimage = $post->thumbnail;
		}
		$this->layout->content = View::make('content.posts.single')->with('post', $post);
		$this->layout->category_id = $post->category_id;
		$this->layout->randomPosts = Post::random();
	}

	public function category($slug)
	{	
		$category = Category::where('slug', '=', $slug)->first();	
		if(!$category)
		{
			App::abort(404);
		}
		$this->layout->title = $category->name.$this->layout->right;		
		$this->layout->category_id = $category->id;

		$this->setPosts($category->posts());
	}

	public function tag($tag)
	{
		$tag = Tag::where('slug', '=', $tag)->first();
		if(!$tag)
		{
			App::abort(404);
		}
		$this->layout->title = $tag->name.$this->layout->right;
		$this->setPosts($tag->posts());
	}

	public function search($text)
	{
		$posts = new Post();

		if(isset($text))
		{
			$posts->where('title', 'RLIKE', "%$text%");
		}
		
		$this->layout->title = 'Search'.$this->layout->right;
		$this->layout->follow = false;
		$this->setPosts($posts);
	}
}