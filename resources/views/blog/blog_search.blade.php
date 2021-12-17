@extends('blog.blog')

@section('title-search', 'Search Result: ')

@section('label')
<div class="bootstrap-tagsinput">
    @if($request != null)
    <span id="label" class="badge badge-info section-blog__label rounded-pill">
        {{$request->searchInput}} <i id="cancelLabel" class="fas fa-times ml-3"></i>
    </span>
    @endif
</div>
@endsection

@section('content-horiz')
@for($i = 0; $i < 5; $i++)
<x-content-horiz></x-content-horiz>
@endfor
@endsection

@section('content-vert')
@for($i = 0; $i < 5; $i++)
<x-content-vert></x-content-vert>
@endfor
@endsection