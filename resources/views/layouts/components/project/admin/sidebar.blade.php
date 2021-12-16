<div class="sidebar-brand">
    <a href="index.html">Project Tracker</a>
</div>
<div class="sidebar-brand sidebar-brand-sm">
    <a href="index.html">Pt</a>
</div>
<ul class="sidebar-menu">
    <li class="menu-header">Menu</li>
    <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}"><a class="nav-link" href="{{route('admin.dashboard')}}"><i class="fas fa-fire"></i> <span>Dashboard</span></a></li>
    <li class="nav-item dropdown {{ Request::is('admin/projects/*') ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-project-diagram"></i> <span>Projects</span></a>
        <ul class="dropdown-menu">
            <li ><a class="nav-link" href="">Project List</a></li>
            <li class="{{ Request::is('admin/projects/modules/*') ? 'active' : '' }}"><a class="nav-link" href="{{route('admin.modules.index')}}">Modules</a></li>
        </ul>
    </li>
    <li class="nav-item dropdown {{ Request::is('admin/membership/*') ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span>Membership</span></a>
        <ul class="dropdown-menu">
            <li class="{{ Request::is('admin/membership/members/*') ? 'active' : '' }}"><a class="nav-link" href="{{route('admin.members.index')}}">Member List</a></li>
            <li class="{{ Request::is('admin/membership/roles/*') ? 'active' : '' }}"><a class="nav-link" href="{{route('admin.roles.index')}}">Roles</a></li>
            <li class="{{ Request::is('admin/membership/divisions/*') ? 'active' : '' }}"><a class="nav-link" href="{{route('admin.divisions.index')}}">Division</a></li>
        </ul>
    </li>
    <li class="nav-item dropdown {{ Request::is('admin/blogs/*') ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-blog"></i> <span>Blogs</span></a>
        <ul class="dropdown-menu">
            <li class="{{ Request::is('admin/blogs/admin_blog/*') ? 'active' : '' }}"><a class="nav-link" href="{{route('admin.blog.index')}}">Blog List</a></li>
            <li class="{{ Request::is('admin/blogs/blog_categories/*') ? 'active' : '' }}"><a class="nav-link" href="{{route('admin.blog_categories.index')}}">Blog Categories</a></li>
            <li><a class="nav-link" href="layout-transparent.html">Blog Approval</a></li>
        </ul>
    </li>
    <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-tools"></i> <span>System Setting</span></a>
        <ul class="dropdown-menu">
            <li><a class="nav-link" href="layout-default.html">Change Logo</a></li>
        </ul>
    </li>
    <li class=""><a class="nav-link" href="#"><i class="fas fa-list"></i> <span>Logs Activity</span></a></li>
</ul>