@section('title')
Quản lí thẻ
@stop

@section('content')

<div class="p30">

<ul id="tags">
@foreach($tags as $tag)
<li class="tag">
{{ $tag->name }}
</li>
@endforeach
</ul><!-- /#tags -->

</div>

@stop