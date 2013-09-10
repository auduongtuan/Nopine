<?php
use Blog\ShortCode;
class Post extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'posts';

	public $timestamps = 'true';

	protected $softDelete = true;

	protected $fillable = array('title', 'content');

	public static function random($limit = 10)
	{
		return static::orderBy(DB::raw('RAND()'))->take($limit)->get();
	}

	public function category()
	{
		return $this->belongsTo('Category');
	}

	public function tags()
	{
		return $this->belongsToMany('Tag');
	}	

	public function getLinkAttribute()
	{
		return URL::route('post', array('category' => $this->category->slug, 'slug' => $this->slug));
	}

	public function getFullAttribute()
	{
		return ShortCode::create($this->content);
	}

	public function getMiniAttribute()
	{
		$ex = explode('<!-- more -->', $this->full);
		if(isset($ex[1]))
		{
			return $ex[0].'<p><a href="'.$this->link.'" class="read-more">Đọc thêm <i class="icon-reorder"></i></a></p>';
		}
		else
		{
			return $this->full;
		}
	}

	public function getExcerptAttribute($value)
	{
		return $this->getExcerpt();
	}

	public function getDateAttribute() {
		return date('j \t\há\n\g n, Y', strtotime($this->created_at));
	}


	public function getExcerpt($chars = 200)
	{
		$ellipsis = false;
		$text = $this->content_html;
		$text = $text." ";
		$text = strip_tags($text);
		$text = str_replace('&nbsp;', '', $text);
		$text = str_replace("\n", ' ', $text);
		if(mb_strlen($text) > $chars) $ellipsis = true;
		$text = mb_substr($text, 0, $chars);
		$text = mb_substr($text, 0, mb_strrpos($text,' '));
		if($ellipsis == true) $text = $text." ...";
		return $text;
	}	

	public function setTagsAttribute($value)
	{
		$tag_ids = array();
		$tags = explode(',', $value);
		foreach($tags as $name)
		{
			if($tag = Tag::addTag(trim($name)))	$tag_ids[] = $tag->id;
		}
		$this->tags()->sync($tag_ids);
	}


	public function getThumbnailImgAttribute($value)
	{
		if($this->thumbnail)
		{
			return '<a href="'.$this->link.'" class="featured-image">'.HTML::image($this->thumbnail, $this->title, array('width' => '270')).'</a>';
		}
		else
		{
			return false;
		}
	}

	public function getTagsLinkListAttribute($value)
	{
		$tags = array();
		foreach($this->tags as $tag)
		{
			$tags[] = $tag->a;
		}
		if(count($tags) > 0)
		{
			return implode(', ', $tags);
		}
		else
		{
			return false;
		}
	}

	public function getTagsListAttribute()
	{
		$tags = array();
		foreach($this->tags as $tag)
		{
			$tags[] = $tag->name;
		}
		return implode(', ', $tags);
	}

	public function addViews()
	{
		$this->views++;
		$this->save();
	}

	public function getPlayerAttribute()
	{
		return ShortCode::media($this->media);
	}

	public function getAdminPostIconAttribute($white = false)
	{
		$a = str_replace(
			array('1', '2', '3', '4'),
			array('icon-music', 'icon-facetime-video', 'icon-list-alt', 'icon-comment'),
			$this->category_id
		);
		if($white == true) $a .= ' icon-white';
		return '<i class="'.$a.'"></i>';
	}

	public function getAAttribute($value)
	{
		return HTML::link($this->link, $this->title);
	}


}