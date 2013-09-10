<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" />
	<title>@yield('title')</title>	
	{{-- HTML::style('css/bootstrap.min.css') --}}
	{{ HTML::style('http://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css') }}
	{{ HTML::style('css/admin.css') }}

</head>

<body>

<span id="loading"></span>
<div id="wrapper" class="container">   
	<div id="main">@yield('content')</div>
</div>

{{ HTML::script('//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js') }}
{{ HTML::script('http://code.jquery.com/ui/1.10.3/jquery-ui.js') }}

<script>
AdminConfig = {
	site : '{{ url('') }}',
	url : '{{ url('admin') }}',
	currentPage : '{{ $currentPage }}',
}
</script>

{{ HTML::script('js/admin.js') }}

</body>
</html>
	