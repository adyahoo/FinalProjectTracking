<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>General Dashboard &mdash; Stisla</title>

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
        <footer class="main-footer">
          <div class="footer-left">
            Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a>
          </div>
          <div class="footer-right">
            2.3.0
          </div>
        </footer>
      </div>
    </div>

    @yield('modal')

    @include('layouts.components.project.script')
    @yield('script')
  </body>
</html>