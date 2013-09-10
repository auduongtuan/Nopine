@section('content')
	
@foreach($posts as $post) 

	@include('content.p')

@endforeach


@include('content.posts.pagination')


@stop