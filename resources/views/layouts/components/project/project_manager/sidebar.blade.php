<div class="sidebar-brand">
    <a href="index.html">Project Tracker</a>
</div>
<div class="sidebar-brand sidebar-brand-sm">
    <a href="index.html">Pt</a>
</div>
<ul class="sidebar-menu">
    <li class="menu-header">Menu</li>
    <li class="active"><a class="nav-link" href="credits.html"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-project-diagram"></i> <span>Projects</span></a>
        <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{ route('project_manager.projects.all') }}">Project List</a></li>
            <li><a class="nav-link" href="{{ route('project_manager.projects.create') }}">Create Project</a></li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-th"></i> <span>Modules</span></a>
        <ul class="dropdown-menu">
            <li><a class="nav-link" href="layout-default.html">Module List</a></li>
            <li><a class="nav-link" href="layout-default.html">Add Module</a></li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-blog"></i> <span>Blogs</span></a>
        <ul class="dropdown-menu">
            <li><a class="nav-link" href="layout-default.html">Blog List</a></li>
            <li><a class="nav-link" href="layout-default.html">Add Blog</a></li>
        </ul>
    </li>
</ul>