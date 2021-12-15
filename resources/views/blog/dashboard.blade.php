@extends('layouts.blog')
@section('title', 'Blog Dashboard')

@push('css')
<link rel="stylesheet" href="{{asset('css/blog/home/home.css')}}">
@endpush

@section('content')
<x-banner></x-banner>
<div class="section container section-most-viewed">
    <h3 class="section-most-viewed__title">
        Most Viewed Blogs
    </h3>
    <div class="row">
        @for($i = 0; $i < 4; $i++)
        <div class="col-6">
            <x-content-horiz></x-content-horiz>
        </div>
        @endfor
    </div>
</div>
<div class="section container section-popular-author">
    <h3 class="section-popular-author__title">
        From Popular Author
    </h3>
    <div class="row">
        @for($i = 0; $i < 4; $i++)
        <div class="col-6">
            <x-content-horiz></x-content-horiz>
        </div>
        @endfor
    </div>
</div>
@endsection

@push('js')
@endpush