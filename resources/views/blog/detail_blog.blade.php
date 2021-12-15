@extends('layouts.blog')
@section('title', 'Detail Blog')

@push('css')
<link rel="stylesheet" href="{{asset('css/blog/detail/detail.css')}}">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
@endpush

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="{{route('blog')}}">Blog</a></li>
            <li class="breadcrumb-item active" aria-current="page">12 Tips On Creating Content For Your New Website (A Complete Guide)</li>
        </ol>
    </nav>
    <div class="row no-gutters justify-content-center mt-5">
        <div class="col-10">
            <div class="section section-detail">
                <h2 class="text-dark">12 Tips On Creating Content For Your New Website (A Complete Guide)</h2>
                <div class="row no-gutters align-items-center">
                    <div class="col-2">
                        <div class="rounded-circle section-detail__profile-container">
                            <img class="section-detail__profile-img" src="{{asset('images/img-profile.png')}}">
                        </div>
                    </div>
                    <div class="col-5 section-detail__profile-info">
                        <a href="{{route('author')}}">
                            <p class="section-detail__profile-name font-weight-bold d-inline-block">Emily Johnson</p>
                        </a>
                        <p>
                            Published at: 12 Desember 2020<br>
                            Published by: Alex
                        </p>
                        <i class="far fa-eye mr-5">100</i>
                    </div>
                </div>
            </div>
            <div class="section section-body">
                <div class="section-body__img-container mb-3">
                    <img class="section-body__img" src="{{asset('images/img-content.svg')}}">
                </div>
                <p class="mb-3">
                    Adipisicing consectetur amet occaecat non excepteur consequat nulla laboris aute et nulla excepteur. Qui sit et ipsum labore voluptate ipsum enim sit. Aute duis ea dolore sunt fugiat et commodo eu amet culpa cillum. Do dolor deserunt dolor aliquip reprehenderit voluptate amet velit ullamco. Laboris anim aute commodo amet reprehenderit occaecat sint ipsum eiusmod laborum irure sunt ullamco.
                </p>
                <p class="mb-3">
                    Adipisicing consectetur amet occaecat non excepteur consequat nulla laboris aute et nulla excepteur. Qui sit et ipsum labore voluptate ipsum enim sit. Aute duis ea dolore sunt fugiat et commodo eu amet culpa cillum. Do dolor deserunt dolor aliquip reprehenderit voluptate amet velit ullamco. Laboris anim aute commodo amet reprehenderit occaecat sint ipsum eiusmod laborum irure sunt ullamco.
                </p>
                <p class="mb-3">
                    Adipisicing consectetur amet occaecat non excepteur consequat nulla laboris aute et nulla excepteur. Qui sit et ipsum labore voluptate ipsum enim sit. Aute duis ea dolore sunt fugiat et commodo eu amet culpa cillum. Do dolor deserunt dolor aliquip reprehenderit voluptate amet velit ullamco. Laboris anim aute commodo amet reprehenderit occaecat sint ipsum eiusmod laborum irure sunt ullamco.
                </p>
                <p class="mb-3">
                    Adipisicing consectetur amet occaecat non excepteur consequat nulla laboris aute et nulla excepteur. Qui sit et ipsum labore voluptate ipsum enim sit. Aute duis ea dolore sunt fugiat et commodo eu amet culpa cillum. Do dolor deserunt dolor aliquip reprehenderit voluptate amet velit ullamco. Laboris anim aute commodo amet reprehenderit occaecat sint ipsum eiusmod laborum irure sunt ullamco.
                </p>
            </div>                        
        </div>
    </div>
    <div class="section section-related-blogs">
        <h3 class="section-related__title">
            Discover Related Blogs
        </h3>
        <div class="row">
            @for($i = 0; $i < 4; $i++)
            <div class="col-6">
                <x-content-horiz></x-content-horiz>
            </div>
            @endfor
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
@endpush