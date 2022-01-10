<div class="section-header" style="display: block">
    <div class="row mb-3">
        <div class="col-lg-8 col-md-8 col-12 col-sm-12">
            <img class="section-detail__profile-img rounded-circle mr-2" style="height: 50px;" src="{{ $project->logo != null ? asset(Storage::url('project_logo/'.$project->logo)) : asset('templates/stisla/assets/img/avatar/avatar-1.png') }}">
            <h1>{{ $project->name }}</h1>
        </div>
        <div class="col-lg-4 col-md-4 col-12 col-sm-12 d-flex justify-content-end">
            <span class="mr-2 mt-1">Selected Version</span>
            <form role="form" method="GET" id="selectedVersion">
                <div class="input-group">
                    <select name="version" class="form-control form-control-sm py-1" style="height: 32px;" onchange="selectedVersion.submit()">
                        @foreach($versions as $version)
                            <option value="{{ $version->id }}" @if($requestVersion == $version->id) selected @endif>{{ $version->version_number }}</option>
                        @endforeach
                        @isset($versions[0])
                            <option value="{{ $versions[0]->generalVersion['all_version'] }}" @if($requestVersion == $versions[0]->generalVersion['all_version']) selected @endif>{{ $versions[0]->generalVersion['all_version'] }}</option>
                        @endisset
                    </select>
                </div>
            </form>
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