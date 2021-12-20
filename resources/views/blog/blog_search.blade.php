@extends('blog.blog')

@section('title-search', 'Search Result: ')

@section('label')
<div class="bootstrap-tagsinput">
    @if($request != null)
        @if($request->searchInput != null)
            <span id="labelSearch" class="badge badge-info section-blog__label rounded-pill mr-3">
                {{$request->searchInput}} <i id="cancelLabelSearch" class="fas fa-times ml-3"></i>
            </span>
        @endif
        @if($request->filterSidebar != null)
            @foreach($request->filterSidebar as $data)
                @if($data != "")
                <span id="labelFilter-{{$loop->iteration}}" class="badge badge-info section-blog__label rounded-pill mr-3">
                    {{$data}} <i id="cancelLabelFilter-{{$loop->iteration}}" class="fas fa-times ml-3"></i>
                    <input type="hidden" id="filterIndex" name="filterIndex[]" value="{{$loop->count}}">
                </span>
                @endif
            @endforeach
        @endif
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