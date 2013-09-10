{{ '<?xml version="1.0" encoding="UTF-8"?>' }}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
	<url><loc>{{ URL::route('index') }}</loc><changefreq>hourly</changefreq><lastmod>{{ date('c', strtotime($latest->updated_at)) }}</lastmod></url>

@foreach( Category::all() as $article )
	<url><loc>{{ $article->link }}</loc><lastmod>{{ date('c', strtotime($latest->updated_at)) }}</lastmod></url>
@endforeach

@foreach( Tag::all() as $article )
	<url><loc>{{ $article->link }}</loc><lastmod>{{ date('c', strtotime($latest->updated_at)) }}</lastmod></url>
@endforeach

@foreach( $articles as $article )
	<url><loc>{{ $article->link }}</loc><lastmod>{{ date('c', strtotime($article->updated_at)) }}</lastmod></url>
@endforeach

</urlset>
