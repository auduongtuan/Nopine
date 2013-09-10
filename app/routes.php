<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::group(array('before' => 'auth'), function()
{
	Route::controller('admin', 'AdminController');
});

Route::get('/login', function()
{
	if(!Auth::check())
	{
    	return View::make('admin.login');
    }
    else
    {
    	return Redirect::to('/admin');
    }
});

Route::get('/logout', function()
{
    Auth::logout();
    return Redirect::to('/admin');
});

Route::post('/login', function()
{
    if(Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')), true))
    {
        return Redirect::to('/admin');
    }
    else
    {
        return Redirect::to('/login')->with('error', true);
    }
});

$postFilter = array();

if(Auth::guest() && Config::get('blog.cache') == true)
{
    $postFilter = array('before' => 'cache', 'after' => 'cache');
}

Route::group($postFilter, function()
{

    Route::get('/search/{text}', array('as' => 'search', 'uses' => 'ContentController@search'));

    Route::get('/{category}', array('as' => 'category', 'uses' =>'ContentController@category'))->where('category', '[A-Za-z_-]+');

    Route::get('/tag/{tag}', array('as' => 'tag', 'uses' =>'ContentController@tag'))->where('tag', '[A-Za-z_-]+');

    Route::get('/{category}/{slug}', array('as' => 'post', 'uses' =>'ContentController@post', 'after' => 'post_view'))->where(array('category' => '[A-Za-z_-]+', 'slug' => '[A-Za-z0-9_-]+'));

    Route::get('/', array('as' => 'index', 'uses' =>'ContentController@posts'));

});

Route::get('/sitemap.xml', function()
{
    // Grab all artiles for xml generation
    $articles = Post::select('title', 'slug', 'category_id', 'updated_at')->orderBy('created_at', 'asc')->get();

    // Grab latest updated article for 'last modified'
    $latest = DB::table('posts')->select('updated_at')->orderBy('updated_at', 'desc')->first();

    // Get XML
    $content = View::make('sitemap')
                ->with('articles', $articles)
                ->with('latest', $latest);

    // Respond with proper content type
    return Response::make($content, 200, array('Content-Type' => 'text/xml'));
});