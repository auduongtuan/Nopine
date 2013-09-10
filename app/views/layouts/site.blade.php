<!doctype html>
<html lang="vi">
<head>	
<title>{{ $title }}</title>

<!-- Meta Data -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<meta name="description" content="{{ $description }}" />
<link rel="canonical" href="{{ Request::url() }}" />
@if($follow == true)
<meta name="robots" content="index, follow" />
@else
<meta name="robots" content="noindex, nofollow" />
@endif

@if(isset($ogimage))
<meta property="og:image" content="{{ $ogimage }}" />
@endif
<meta property="og:description" content="{{ $description }}"/>
<meta property="og:title" content="{{ $title }}"/>

<!-- Favicon -->
<link rel="shortcut icon" href="/img/favicon.png" />

<!-- CSS -->
{{ HTML::style('http://fonts.googleapis.com/css?family=Open+Sans:400&amp;subset=latin,vietnamese|Noto+Serif&amp;subset=latin,vietnamese') }}
{{ HTML::style('http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css') }}
{{ HTML::style('css/site.css') }}

</head>

<body {{ $body_attr }}>

@include('content.header')

 <!--[if lt IE 8]>
    <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
<![endif]-->

<section id="posts">
@yield('content')
</section><!-- /#posts -->

<!-- Javscript -->
<script type="text/javascript">
	var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-18474693-1']);
		_gaq.push(['_trackPageview']);
	
	(function() {
	    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
	    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
	    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
	})();
</script>
{{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js') }}


{{ HTML::script('js/site.js') }}

</body>

</html>
