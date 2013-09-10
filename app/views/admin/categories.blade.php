@section('content')

	@foreach($categories as $category)

	{{ $category->name }}

	@endforeach

@stop