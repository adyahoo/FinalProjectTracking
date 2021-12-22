@extends('blog.blog')

@section('banner')
<x-banner :blogs="$bannerBlogs"></x-banner>
@endsection

@section('content-list')
@if($blogs->count() < 1)
<h2>No Data Found</h2>
@else
<x-content-horiz :blogs="$blogs"></x-content-horiz>
@endif
@endsection

@section('content-grid')
@if($blogs->count() < 1)
<h2>No Data Found</h2>
@else
<div class="row no-gutters justify-content-between" id="gridContent">
    <x-content-vert :blogs="$blogs"></x-content-vert>
</div>
@endif
@endsection

@section('content-sidebar')
<x-blog-sidebar>
</x-blog-sidebar>
@endsection