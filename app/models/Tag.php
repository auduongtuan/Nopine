<?php

class Tag extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	
	protected $table = 'tags';

	public $timestamps = false;

	public function posts()
	{
		return $this->belongsToMany('Post');
	}

	public static function addTag($name)
	{
		$validator = Validator::make(
		    array('name' => $name),
		    array('name' => 'required|min:2')		
		);
		if (!$validator->fails())
		{
			if(!$tag = Tag::getByName($name))
			{
				$tag = new Tag;
				$tag->name = $name;
				$tag->slug = Str::slug($name);
				$tag->save();			
			}
			return $tag;
		}
		else
		{
			return false;
		}
	}

	public function getLinkAttribute()
	{
		return URL::route('tag', array('tag' => $this->slug));
	}

	public static function getByName($name)
	{
		if($tag = Tag::where('name', '=', $name)->first())
		{
			return $tag;
		}
		else
		{
			return false;
		}
	}

	
	public function getAAttribute() {
    	return HTML::link($this->link, $this->name, array('title' => "Xem tất cả bài viết có thẻ $this->name"));
    }
}