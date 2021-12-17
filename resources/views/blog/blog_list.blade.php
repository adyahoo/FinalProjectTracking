@extends('blog.blog')

@section('banner')
<x-banner></x-banner>
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