<?php namespace Blog;
class ShortCode
{
	/**
	 * @param string $text Text need rendering
	 */
	public static function create($text)
	{
		return new self($text);
	}

	public function __toString()
	{
		return $this->render();
	}

	public function __construct($text)
	{
		$this->text = $text;
	}

	public static function download($link)
	{
		$service = 'none';
		if(preg_match('/mega.co.nz/i', $link)) $service = 'mega';
		return '<a href="'.$link.'" target="__BLANK" class="button yellow download '.$service.'"><i class="icon-download-alt"></i> Download</a>';
	}

	public static function media($link)
	{
		if(preg_match('#http://www.nhaccuatui.com/m/(.*?)#s', $link, $m))
		{
			return '<iframe with="300" height="58" src="'.$link.'"></iframe>';
		}
		elseif(preg_match('#^(?:https?://)?(?:www\.)?(?:youtu\.be/|youtube\.com(?:/embed/|/v/|/watch\?v=|/watch\?.+&v=))([\w-]{11})(?:.+)?$#x', $link, $m)) 
		{
			return '<div class="video youtube"><iframe width="100%" height="315" src="//www.youtube.com/embed/'.$m[1].'" allowfullscreen></iframe></div>';
		}
		// NCT
		elseif(preg_match('#^http://www.nhaccuatui.com/video/xem-clip/(.*?)#s', $link, $m))
		{
			return '<iframe width="560" height="315" src="'.$link.'" allowfullscreen></iframe>';
		}
		elseif(preg_match('/.mp3/s', $link, $m))
		{
		return '<audio src="'.$link.'" controls></audio>';
		}
		else
		{
			return '<video src="'.$link.'" controls></video>';
		}
	}

	public function callback($matches)
	{
		if(method_exists($this, $matches[1]))
		{
			return $this->$matches[1]($matches[2]);
		}
		else
		{
			return $matches[0];
		}
	}

	public function render()
	{
		$newText = preg_replace_callback('#\[([A-Za-z]+)\](.*?)\[\/[A-Za-z]+\]#si', array(&$this, 'callback'), $this->text);
		return $newText;
	}

	
}