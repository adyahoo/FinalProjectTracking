@extends('layouts.blog')
@section('title', 'Detail Blog')

@push('css')
<link rel="stylesheet" href="{{asset('css/blog/detail/detail.css')}}">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
@endpush

@section('content')
<div class="container">
    <div class="row no-gutters justify-content-center mt-5">
        <div class="col-10">
            <div class="section section-detail">
                <h2 class="text-dark text-center">{{$blog->title}}</h2>
                <div class="row no-gutters align-items-center">
                    <div class="col-3 col-lg-2">
                        <div class="section-detail__profile-container">
                            <img class="rounded-circle section-detail__profile-img" src="{{Auth::user()->profile_image != null ? Storage::url('profile_images/'.Auth::user()->profile_image) : asset('templates/stisla/assets/img/avatar/avatar-1.png')}}">
                        </div>
                    </div>
                    <div class="col-7 col-lg-9 ml-3 section-detail__profile-info">
                        <p class="section-detail__profile-name font-weight-bold d-inline-block mb-0">{{$blog->user->name}}</p>
                        <p>
                            Published at: {{date('d M Y', strtotime($blog->published_at))}}<br>
                            Published by: {{$blog->user->name}}
                        </p>
                        <i class="far fa-eye mr-5">100</i>
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