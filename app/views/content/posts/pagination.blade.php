<aside id="pagination">

	@if($inputPage = Input::get('page', 1))

		@if (($currentPage = $posts->getCurrentPage()) > 1)
		    <a href="{{ Request::url() }}{{ ($inputPage != 2) ? '?page='.($currentPage-1) : '' }}" class="prev">Trang trước</a>
		@endif

		@if ($currentPage < $posts->getLastPage())
			<a href="{{ Request::url() }}?page={{ ++$currentPage }}" class="next">Trang sau</a>
		@endif

	@endif

	<div class="clearfix"></div>
</aside>