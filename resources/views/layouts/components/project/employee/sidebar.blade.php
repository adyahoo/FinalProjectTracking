<div class="sidebar-brand">
    <a href="index.html">Project Tracker</a>
</div>
<div class="sidebar-brand sidebar-brand-sm">
    <a href="index.html">Pt</a>
</div>
<ul class="sidebar-menu">
    <li class="menu-header">Menu</li>
    <li class="{{ Request::is('employee/dashboard*') ? 'active' : '' }} nav-item"><a class="nav-link" href="{{ route('employee.dashboard') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
    <li class="{{ Request::is('employee/projects*') ? 'active' : '' }} nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-project-diagram"></i> <span>Projects</span></a>
        <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{ route('employee.projects.all') }}">Project List</a></li>
        </ul>
    </li>
    <li class="{{ Request::is('employee/blogs*') ? 'active' : '' }} nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-blog"></i> <span>Blogs</span></a>
        <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{ route('employee.blogs.all') }}">Blog List</a></li>
            <li><a class="nav-link" href="{{ route('employee.blogs.create') }}">Create Blog Post</a></li>
        </ul>
    </li>
</ul>