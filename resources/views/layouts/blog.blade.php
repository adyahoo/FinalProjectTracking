<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta id="csrf-token" name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/blog/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/blog/content.css') }}">
    <link rel="stylesheet" href="{{ asset('css/tagsinput.css') }}">
    @stack('css')
</head>

<body>
    @include('layouts.components.blog.header')

    <main>
        @yield('content')
    </main>

    @include('layouts.components.blog.footer')

    <script src="{{asset('js/jquery.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/blog/layout.js')}}"></script>
    <script src="{{asset('js/blog/swiper-js.js')}}"></script>
    <script src="{{asset('js/tagsinput.js')}}"></script>
    @stack('js')
</body>

</html>