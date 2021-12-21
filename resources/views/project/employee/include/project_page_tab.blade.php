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
                    <a class="nav-link {{ Request::is('project_manager/projects/detail*') ? 'active-tab' : '' }}" href="{{ route('project_manager.projects.detail', $project) }}">Detail</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('project_manager/projects/module/*') ? 'active-tab' : '' }}" href="{{ route('project_manager.projects.module.all', $project) }}">Modules</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('project_manager/projects/version/*') ? 'active-tab' : '' }}" href="{{ route('project_manager.projects.version.all', $project) }}">Version</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('project_manager/projects/logs/*') ? 'active-tab' : '' }}" href="{{ route('project_manager.projects.logs.all', $project) }}">Logs</a>
                </li>
            </ul>
        </div>
        <div class="col-lg-4 col-md-4 col-12 col-sm-12 text-right">
            <a href="#" class="btn btn-icon btn-primary"><i class="fa fa-cog"></i></a>
        </div>
    </div>
</div>