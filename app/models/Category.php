<?php

class Category extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'categories';

	public function getLinkAttribute() {
		return URL::route('category', array('category' => $this->slug));
	}

	public function posts()
    {
        return $this->hasMany('Post');
    }

    public function getAAttribute() {
		return HTML::link($this->link, $this->name, array('title' => "Xem tất cả bài viết trong mục $this->name"));
	}
	   
}