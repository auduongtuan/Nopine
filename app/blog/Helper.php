<?php namespace Blog;
use Illuminate\Support\Facades\Route;
class Helper 
{
	public static function timeAgo($date)
	{
	    if(empty($date))
	    {
	        return "không có ngày hiển thị";
	    }
	    
	    $periods         = array("giây", "phút", "giờ", "ngày", "tuần", "tháng", "năm", "thập kỷ");
	    $lengths         = array("60","60","24","7","4.35","12","10");
	    
	    $now             = time();
	    $unix_date       = strtotime($date);
	    
	       // check validity of date
	    if(empty($unix_date))
	    {   
	        return "ngày sai";
	    }
	 
	    // is it future date or past date
	    if($now > $unix_date)
	    {   
	        $difference     = $now - $unix_date;
	        $tense         = "trước";
	        
	    }
	    else
	    {
	        $difference     = $unix_date - $now;
	        $tense         = "from now";
	    }
	    
	    for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++)
	    {
	        $difference /= $lengths[$j];
	    }
	    
	    $difference = round($difference);
	    /* 
		Thêm s nếu số nhiều => VN ko xài :))
	    if($difference != 1) {
	        $periods[$j].= "s";
	    }
	    */
	    echo "$difference $periods[$j] {$tense}";
	}

	
	public static function bodyAttr()
	{
		$currentRoute = Route::currentRouteName();
		$attr = 'id="'.$currentRoute.'-page'.'"';
		if(in_array($currentRoute, array('index', 'category', 'tag')))
		{
			$attr .= ' class="posts-page"';
		}
		return $attr;
	}

	public static function styles($styles)
	{
		foreach($styles as $style)
		{
			
		}
	}
}