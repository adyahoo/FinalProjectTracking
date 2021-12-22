<nav class="navbar navbar-secondary navbar-expand-lg">
    <div class="container">
        <ul class="navbar-nav">
            <li class="nav-item {{ Request::is('employee/dashboard*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('employee.dashboard') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
            <li class="nav-item dropdown {{ Request::is('employee/projects*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-project-diagram"></i> <span>Projects</span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('employee.projects.all') }}">Project List</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('employee.projects.create') }}">Create Project</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown {{ Request::is('employee/blogs*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-blog"></i> <span>Blogs</span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('employee.blogs.all') }}">Blog List</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('employee.blogs.create') }}">Add Blog</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>