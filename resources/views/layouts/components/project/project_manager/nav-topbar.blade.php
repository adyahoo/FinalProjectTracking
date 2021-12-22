<nav class="navbar navbar-secondary navbar-expand-lg">
    <div class="container">
        <ul class="navbar-nav">
            <li class="nav-item {{ Request::is('project_manager/dashboard*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('project_manager.dashboard') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
            <li class="nav-item dropdown {{ Request::is('project_manager/projects*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-project-diagram"></i> <span>Projects</span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('project_manager.projects.all') }}">Project List</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('project_manager.projects.create') }}">Create Project</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-th"></i> <span>Modules</span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item"><a class="nav-link" href="layout-default.html">Module List</a></li>
                    <li class="nav-item"><a class="nav-link" href="layout-default.html">Add Module</a></li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-blog"></i> <span>Blogs</span></a>
                <ul class="dropdown-menu">
                    <li class="nav-item"><a class="nav-link" href="layout-default.html">Blog List</a></li>
                    <li class="nav-item"><a class="nav-link" href="layout-default.html">Add Blog</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>