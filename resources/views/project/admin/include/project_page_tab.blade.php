<div class="section-header" style="display: block">
    <div class="row">
        <div class="col-lg-8 col-md-8 col-12 col-sm-12">
            <h1>{{ $project->name }}</h1>
        </div>
        <div class="col-lg-4 col-md-4 col-12 col-sm-12 text-right">
            <p>Latest Version v{{ $latestVersionNumber }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-md-8 col-12 col-sm-12">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/projects/admin_projects/detail*') ? 'active-tab' : '' }}" href="{{ route('admin.admin_projects.detail', $project) }}">Detail</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/projects/admin_projects/project_module/*') ? 'active-tab' : '' }}" href="{{ route('admin.admin_projects.project_module.index', $project) }}">Modules</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/projects/admin_projects/version/*') ? 'active-tab' : '' }}" href="{{ route('admin.admin_projects.version.index', $project) }}">Version</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/projects/admin_projects/project_logs/*') ? 'active-tab' : '' }}" href="{{ route('admin.admin_projects.project_logs.index', $project) }}">Logs</a>
                </li>
            </ul>
        </div>
        <div class="col-lg-4 col-md-4 col-12 col-sm-12 text-right">
            <a href="{{ route('admin.admin_projects.edit', $project) }}" class="btn btn-icon btn-primary"><i class="fa fa-cog"></i></a>
        </div>
    </div>
</div>