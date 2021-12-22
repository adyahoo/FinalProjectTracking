<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title')</title>
    @yield('css')
    @include('layouts.components.project.style')
</head>

<body class="layout-3">
    <div id="app">
    <div class="main-wrapper mx-4">
        @include('layouts.components.project.navbar-top')

        <!-- Main Content -->
        <div class="main-content">
            <section class="section">
                @yield('content')
            </section>
        </div>
        @include('layouts.components.project.footer')
    </div>
    </div>
    @yield('modal')
    @include('layouts.components.project.script')
    @yield('js')
</body>
</html>