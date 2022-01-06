@extends('blog.blog')

@section('title-search', 'Search Result: ')

@section('label')
<div class="bootstrap-tagsinput">
    @if($request != null)
        @if($request->searchInput != null)
        <span id="labelSearch" class="badge badge-info section-blog__label rounded-pill mr-3">
            {{$request->searchInput}}
        </span>
        @endif
        
        @if($request->filterSidebar != null)
            @foreach($request->filterSidebar as $data)
            @if($data != "")
            <span id="labelFilter-{{$loop->iteration}}" class="badge badge-info section-blog__label rounded-pill mr-3">
                {{$data}}
                <input type="hidden" id="filterIndex" name="filterIndex[]" value="{{$loop->count}}">
            </span>
            @endif
            @endforeach
        @endif

        @if($request->categoryName != null)
        <span id="labelKategori" class="badge badge-info section-blog__label rounded-pill mr-3">
            {{$request->categoryName}}
        </span>
        @endif
    @endif
</div>
@endsection

@if(!is_null($blogs))
@section('content-list')
    @if($blogs->count() < 1)
    <h2>No Data Found</h2>
    @else
    <div class="row no-gutters justify-content-between" id="listContent">
        <x-content-horiz :blogs="$blogs"></x-content-horiz>
    </div>
    @endif
@endsection

@section('content-grid')
    @if($blogs->count() < 1)
    <h2>No Data Found</h2>
    @else
    <div class="row no-gutters justify-content-between" id="gridContent">
        <x-content-vert :blogs="$blogs"></x-content-vert>
    </div>
    @endif
@endsection
@else
@section('content-grid')
    <h2>No Data Found</h2>
@endsection
@section('content-list')
    <h2>No Data Found</h2>
@endsection
@endif

@section('content-sidebar')
<x-blog-sidebar>
</x-blog-sidebar>
@endsection

@push('blog-js')
<script>
    $(document).ready(function() {
        $('#sortSelect').remove()
        $('#sortTitle').remove()
    })
</script>
@endpush