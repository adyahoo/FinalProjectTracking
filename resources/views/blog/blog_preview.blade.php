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
            <li class="breadcrumb-item active" aria-current="page">{{$blog->title}}</li>
        </ol>
    </nav>
    <div class="row no-gutters justify-content-center mt-5">
        <div class="col-10">
            <div class="section section-detail">
                <h2 class="text-dark text-center">{{$blog->title}}</h2>
                <div class="row no-gutters align-items-center">
                    <div class="col-3 col-lg-2">
                        <div class="section-detail__profile-container">
                            <img class="section-detail__profile-img rounded-circle" src="{{$blog->user->profile_image != null ? asset(Storage::url('profile_images/'.$blog->user->profile_image)) : asset('templates/stisla/assets/img/avatar/avatar-1.png')}}">
                        </div>
                    </div>
                    <div class="col-7 col-lg-9 ml-3 section-detail__profile-info">
                        <a href="{{route('author', $blog->user->name)}}">
                            <p class="section-detail__profile-name font-weight-bold d-inline-block mb-0">{{$blog->user->name}}</p>
                        </a>
                        <p>
                            Published at: {{Carbon\Carbon::parse($blog->published_at)->format('d M Y')}}<br>
                        </p>
                        <i class="far fa-eye">{{$blog->view_count}}</i>
                    </div>
                </div>
            </div>
            <div class="section section-body">
                <div class="section-body__img-container mb-3">
                    <img class="section-body__img" src="{{asset(Storage::url('blog_images/'.$blog->image))}}">
                </div>
                {!! $blog->content !!}
            </div>                        
        </div>
    </div>
</div>
@endsection

@push('js')
@endpush