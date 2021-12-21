<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>@yield('title')</title>

    @yield('style')
    @include('layouts.components.project.style')
  </head>

  <body>
    <div id="app">
      <div class="main-wrapper">
        @include('layouts.components.project.navbar')
        <div class="main-sidebar">
          <aside id="sidebar-wrapper">
              @include('layouts.components.project.project_manager.sidebar')
          </aside>
        </div>

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
    @yield('script')
  </body>
</html>