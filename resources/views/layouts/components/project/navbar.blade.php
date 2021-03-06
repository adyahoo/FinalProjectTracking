<div style="background-color:#6dda5f" class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
            <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }} ({{ Auth::user()->role->name }})</div></a>
            @if(Auth::user()->role->privilege == 'admin')
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-title">Menu</div>
                    <a href="{{route('admin.profile.profile')}}" class="dropdown-item has-icon">
                        <i class="far fa-user"></i> Profile
                    </a>
                    <a href="{{route('admin.profile.change-password')}}" class="dropdown-item has-icon">
                        <i class="fas fa-lock"></i> Change Password
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            @elseif(Auth::user()->role->privilege == 'project_manager')
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-title">Menu</div>
                    <a href="{{route('project_manager.profile.profile')}}" class="dropdown-item has-icon">
                        <i class="far fa-user"></i> Profile
                    </a>
                    <a href="{{route('project_manager.profile.change-password')}}" class="dropdown-item has-icon">
                        <i class="fas fa-lock"></i> Change Password
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            @elseif(Auth::user()->role->privilege == 'employee')
                <div class="dropdown-menu dropdown-menu-right">
                    <div class="dropdown-title">Menu</div>
                    <a href="{{route('employee.profile.profile')}}" class="dropdown-item has-icon">
                        <i class="far fa-user"></i> Profile
                    </a>
                    <a href="{{route('employee.profile.change-password')}}" class="dropdown-item has-icon">
                        <i class="fas fa-lock"></i> Change Password
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item has-icon text-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                </div>
            @endif
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </ul>
</nav>