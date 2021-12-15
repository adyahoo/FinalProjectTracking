@extends('layouts.blog')
@section('title', 'Blog')

@push('css')
<link rel="stylesheet" href="{{asset('css/blog/blog/blog.css')}}">
@endpush

@section('content')
<x-banner></x-banner>
<div class="section container section-content">
    <x-blog-label>
        <x-slot name="label">asdasd</x-slot>
    </x-blog-label>
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
        <a data-toggle="collapse" href="#collapseSidebar" role="button" aria-expanded="false" aria-controls="collapseSidebar">
            <i class="fa fa-filter section-content__icon"></i>
        </a>
    </div>    
    <div class="row no-gutters justify-content-between">
        <div class="col-12 col-md-8 order-1 order-md-0" id="list-view">
            @for($i = 0; $i < 5; $i++)
            <x-content-horiz></x-content-horiz>
            @endfor
        </div>
        
        <div class="col-12 col-md-8 order-1 order-md-0" id="grid-view">
            <div class="row no-gutters justify-content-between">
                @for($i = 0; $i < 5; $i++)
                <x-content-vert></x-content-vert>
                @endfor
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