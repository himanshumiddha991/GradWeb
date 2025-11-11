@php
    $pageTitle = $page->title;
    $metaDescription = $page->description;
    $metaKeywords = $page->keywords;
@endphp
@include('website.layouts.header')
<div class="container flex-content">
{!! $page->content !!}
</div>
@include('website.layouts.footer')
</body>

</html>