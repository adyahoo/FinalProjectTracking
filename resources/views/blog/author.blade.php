@extends('layouts.blog')
@section('title', 'Author')

@push('css')
<link rel="stylesheet" href="{{asset('css/blog/author/author.css')}}">
<link rel="stylesheet" href="{{asset('css/blog/blog/blog.css')}}">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
@endpush

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('blog')}}">Blog</a></li>
            <li class="breadcrumb-item">Author</li>
            <li class="breadcrumb-item active" aria-current="page">{{$user->name}}</li>
        </ol>
    </nav>
    <div class="section section-author bg-white rounded text-center">
        <input type="hidden" id="userSelectedId" value="{{$user->id}}">
        <div class="section-author__profile-container">
            <img class="section-author__profile-img rounded-circle"
                src="{{$user->profile_image != null ? asset(Storage::url('profile_images/'.$user->profile_image)) : asset('templates/stisla/assets/img/avatar/avatar-1.png')}}">
        </div>
        <h2 class="text-dark">{{$user->name}}</h2>
        <p>{{strip_tags($user->bio)}}</p>
    </div>
    <div class="row no-gutters mb-4 justify-content-end align-items-center">
        <p class="m-0 mr-2">Sort By : </p>
        <form>
            <div class="form-group m-0">
                <select class="form-control" id="authorSortSelect">
                    <option selected disabled>Choose...</option>
                    <option value="newest">Newest</option>
                    <option value="oldest">Oldest</option>
                </select>
            </div>
        </form>
        <i data-id="0" id="viewId" class="fas fa-th-large section-content__icon"></i>
        <a data-toggle="collapse" href="#collapseSidebar" role="button" aria-expanded="false"
            aria-controls="collapseSidebar">
            <i class="fa fa-filter section-content__icon"></i>
        </a>
    </div>
    <div class="section row no-gutters justify-content-between">
        <div class="col-12 col-md-8 order-1 order-md-0" id="listView">
            @if($blogs->count() < 1) <h2>No Data Found</h2>
                @else
                <div class="row no-gutters justify-content-between" id="listContent">
                    <x-content-horiz :blogs="$blogs"></x-content-horiz>
                </div>
                @endif
        </div>
        <div class="col-12 col-md-8 order-1 order-md-0" id="gridView">
            <div class="row no-gutters justify-content-between">
                @if($blogs->count() < 1) <h2>No Data Found</h2>
                    @else
                    <div class="row no-gutters justify-content-between" id="gridContent">
                        <x-content-vert :blogs="$blogs"></x-content-vert>
                    </div>
                    @endif
            </div>
        </div>

        <div class="col-12 col-md-3 mb-4 collapse" id="collapseSidebar">
            <div class="border rounded p-2 bg-white" id="sidebar">
                <x-blog-sidebar>
                </x-blog-sidebar>
            </div>
        </div>
    </div>
    <div class="section-btn-share fab-container">
        <div class="fab shadow">
            <div class="fab-content">
                <span class="material-icons">share</span>
            </div>
        </div>
        <div class="sub-button shadow">
            <a href="#" target="_blank">
                <i class="material-icons fa-facebook"></i>
            </a>
        </div>
        <div class="sub-button shadow">
            <a href="#" target="_blank">
                <i class="material-icons fa-instagram"></i>
            </a>
        </div>
        <div class="sub-button shadow">
            <a href="#" target="_blank">
                <i class="material-icons fa-linkedin"></i>
            </a>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{asset('js/bootstrap-toolkit.min.js')}}"></script>
<script src="{{asset('js/blog/blog.js')}}"></script>
<script src="{{asset('js/blog/author.js')}}"></script>
@endpush