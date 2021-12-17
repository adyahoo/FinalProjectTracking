@extends('layouts.blog')
@section('title', 'Blog')

@push('css')
<link rel="stylesheet" href="{{asset('css/blog/blog/blog.css')}}">
@endpush

@section('content')
<div class="section-banner">
    @yield('banner')
</div>
<div class="section container section-content">
    <h2>@yield('title-search')</h2>
    <div class="section-label">
        @yield('label')
    </div>
    <div class="section-sort row no-gutters mb-4 justify-content-end align-items-center">
        <p class="m-0 mr-2">Sort By : </p>
        <form>
            <div class="form-group m-0">
                <select class="form-control" id="exampleFormControlSelect1">
                    <option selected>Choose...</option>
                    <option>Newest</option>
                    <option>Oldest</option>
                </select>
            </div>
        </form>
        <i data-id="0" id="view_id" class="fas fa-th-large section-content__icon"></i>
        <a data-toggle="collapse" href="#collapseSidebar" role="button" aria-expanded="false" aria-controls="collapseSidebar">
            <i class="fa fa-filter section-content__icon"></i>
        </a>
    </div>
    <div class="section-body row no-gutters justify-content-between">
        <div class="col-12 col-md-8 order-1 order-md-0" id="list-view">
            @yield('content-horiz')            
        </div>
        
        <div class="col-12 col-md-8 order-1 order-md-0" id="grid-view">
            <div class="row no-gutters justify-content-between">
                @yield('content-vert')
            </div>
        </div>
        
        <div class="col-12 col-md-3 mb-4 collapse" id="collapseSidebar">
            <div class="border rounded p-2 bg-white" id="sidebar">
                <x-blog-sidebar></x-blog-sidebar>        
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script src="{{asset('js/bootstrap-toolkit.min.js')}}"></script>
<script src="{{asset('js/blog/blog.js')}}"></script>
@endpush