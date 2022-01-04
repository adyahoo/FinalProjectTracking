@extends('layouts.blog')
@section('title', 'Blog Dashboard')

@push('css')
<link rel="stylesheet" href="{{asset('css/blog/home/home.css')}}">
@endpush

@section('content')
<x-banner :blogs="$newest"></x-banner>
<div class="section container section-most-viewed">
    <h3 class="section-most-viewed__title">
        Most Viewed Blogs
    </h3>
    <div class="row">
        @if($mostViewed->count() < 1)
            <h2>No Data Found</h2>
        @else
            <x-content-list-home :blogs="$mostViewed"></x-content-list-home>
        @endif
    </div>
</div>
<div class="section container section-popular-author">
    <h3 class="section-popular-author__title">
        From Popular Author
    </h3>
    <div class="row">
        @if($mostViewed->count() < 1)
            <h2>No Data Found</h2>
        @else
            <x-content-list-home :blogs="$mostViewed"></x-content-list-home>
        @endif
    </div>
</div>
@endsection

@push('js')
@endpush