<div style="background-color:#6dda5f" class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <a href="index.html" class="navbar-brand sidebar-gone-hide">Project Tracker</a>
    <div class="navbar-nav">
    <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar"><i class="fas fa-bars"></i></a>
    </div>
    <div class="nav-collapse">
    
    </div>
    <form class="form-inline ml-auto">
    <ul class="navbar-nav">
        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a></li>
    </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }} ({{ Auth::user()->role->name }})</div></a>
            <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-title">Menu</div>
                <a href="features-profile.html" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </ul>
</nav>

@if(Auth::user()->role->privilege == 'admin')
    @include('layouts.components.project.admin.nav-topbar')
@elseif(Auth::user()->role->priviledge == 'project_manager')
    @include('')
@elseif(Auth::user()->role->priviledge == 'developer')
    @include('')
@endif