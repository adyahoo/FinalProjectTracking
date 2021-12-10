@extends('layouts.blog')
@section('title', 'Blog Dashboard')

@push('css')
<link rel="stylesheet" href="css/blog/banner.css">
@endpush

@section('content')
<div class="section-banner__container">
    <!-- <img class="section-banner__img" src="images/banner-bg.svg"> -->
    <div class="container section-banner__content">
        <div class="row">
            <div class="col-4">
                <div class="section-banner__content-container">
                    <img class="section-banner__content-img" src="images/img-content.svg">
                </div>
            </div>
            <div class="col-8">
                adsds
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
@endpush