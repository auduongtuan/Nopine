<!-- Header -->
<header id="top">
<div id="top-wrap">
    <h1><a href="/">TuanBlog.</a></h1>

    <nav>
    <ul>
        @foreach($categories as $category)
        <li class="{{ (isset($category_id) && $category_id == $category->id) ? 'current' : '' }}" id="category-{{ $category->id }}">
        {{ $category->a }}
        </li>    
        @endforeach
        <!-- li class="search-button"><a href="#"><i class="icon-search"></i></a></li -->
    </ul> 

    <form class="search-form">
        <input class="search-input" type="text" />
    </form>
    
    </nav><!-- /nav -->

    <div class="clearfix"></div>
</div>

</header><!-- /header -->
