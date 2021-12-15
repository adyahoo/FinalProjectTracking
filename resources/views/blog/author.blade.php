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
            <li class="breadcrumb-item active" aria-current="page">Jessica Jones</li>
        </ol>
    </nav>
    <div class="section section-author bg-white rounded text-center">
        <div class="rounded-circle section-author__profile-container">
            <img class="section-author__profile-img" src="{{asset('images/img-profile.png')}}">
        </div>
        <h2 class="text-dark">Jessica Jones</h2>
        <p>Voluptate labore esse laborum aute ipsum aute. Incididunt magna adipisicing consectetur aute amet dolor officia ex occaecat enim incididunt do esse. Ipsum officia in ut ad duis magna aliqua aliquip amet tempor do. Excepteur mollit in quis cillum fugiat ea eu enim dolore labore quis velit. Mollit do aute eiusmod aliquip est.</p>
    </div>
    <div class="row no-gutters mb-4 justify-content-end align-items-center">
        <p class="m-0 mr-2">Sort By : </p>
        <form>
            <div class="form-group m-0">
                <select class="form-control" id="exampleFormControlSelect1">
                    <option selected>Choose...</option>
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
        </form>
        <i data-id="0" id="view_id" class="fas fa-th-large section-content__icon"></i>
    </div>    
    <div class="section row no-gutters justify-content-between">
        <div class="col-7" id="list-view">
            @for($i = 0; $i < 5; $i++)
            <x-content-horiz></x-content-horiz>
            @endfor
        </div>
        
        <div class="col-8" id="grid-view">
            <div class="row no-gutters justify-content-between">
                @for($i = 0; $i < 5; $i++)
                <x-content-vert></x-content-vert>
                @endfor
            </div>
        </div>
        
        <div class="col-3 h-100 border rounded p-2 bg-white sticky-top">
            <x-blog-sidebar></x-blog-sidebar>
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
<script src="{{asset('js/blog/blog.js')}}"></script>
@endpush