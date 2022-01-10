<div class="section-header" style="display: block">
    <div class="row mb-3">
        <div class="col-lg-8 col-md-8 col-12 col-sm-12">
            <img class="section-detail__profile-img rounded-circle mr-2" style="height: 50px;" src="{{ $project->logo != null ? asset(Storage::url('project_logo/'.$project->logo)) : asset('templates/stisla/assets/img/avatar/avatar-1.png') }}">
            <h1>{{ $project->name }}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-md-8 col-12 col-sm-12">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('employee/projects/detail*') ? 'active-tab' : '' }}" href="{{ route('employee.projects.detail', [$project, 'version' => $requestVersion]) }}">Detail</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('employee/projects/module/*') ? 'active-tab' : '' }}" href="{{ route('employee.projects.module.all', [$project, 'version' => $requestVersion]) }}">Modules</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('employee/projects/version/*') ? 'active-tab' : '' }}" href="{{ route('employee.projects.version.all', [$project, 'version' => $requestVersion]) }}">Version</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('employee/projects/logs/*') ? 'active-tab' : '' }}" href="{{ route('employee.projects.logs.all', [$project, 'version' => $requestVersion]) }}">Logs</a>
                </li>
            </ul>
        </div>
    </div>
</div>