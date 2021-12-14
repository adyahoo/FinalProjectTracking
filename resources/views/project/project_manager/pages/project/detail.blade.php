@extends('layouts.project_manager')

@section('content')
    <div class="section-header" style="display: block">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-12 col-sm-12">
                <h1>{{ $project->name }}</h1>
            </div>
            <div class="col-lg-4 col-md-4 col-12 col-sm-12 text-right">
                <p>Latest Version v1.0.0</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-12 col-sm-12">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link active-tab" href="#">Detail</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Modules</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Version</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Logs</a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-4 col-12 col-sm-12 text-right">
                <a href="#" class="btn btn-icon btn-primary"><i class="fa fa-cog"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Description</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-11">
                            <p>{{ $project->description }}</p>
                        </div>
                        <div class="col-1 text-right">
                            <a href="{{ route('project_manager.projects.edit', $project) }}" class="h5" style="color: #78828a"><i class="fa fa-edit"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-md-8 col-12 col-sm-12">
            <div class="card">
                <div class="card-header d-block" style="padding-top: 20px">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-12 col-sm-12 text-left">
                            <h6 class="text-dark">Total Modules</h6>
                            <h3 class="text-primary">10</h3>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12 col-sm-12 text-center">
                            <h6 class="text-dark">Finished Modules</h6>
                            <h3 class="text-primary">10</h3>
                        </div>
                        <div class="col-lg-4 col-md-4 col-12 col-sm-12 text-right">
                            <h6 class="text-dark">Gantt Chart</h6>
                            <a href="">View Gantt Chart <i class="fa fa-external-link-alt"></i></a>
                        </div>
                    </div>
                </div>
                <div class="card-header d-block">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
                            <h6 class="text-dark">Progress</h6>
                            <div class="progress mt-3">
                                <div class="progress-bar" role="progressbar" data-width="100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">100%</div>
                            </div>
                            <p class="mt-2 mb-0">Timeline : 02/12/2021 - 30/12/2021</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h6 class="text-dark">Launch Date</h6>
                </div>
                <div class="card-body">
                    <p>No launch date created</p>
                    <a href="#">Add launch date</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Member List</h4>
                    <div class="card-header-action">
                        <a href="{{ route('project_manager.projects.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Assign Member</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Division</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Scope</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-11">
                            <p class="text-limit">{{ $project->scope }}</p>
                        </div>
                        <div class="col-1 text-right">
                            <a href="{{ route('project_manager.projects.edit', $project) }}" class="h5" style="color: #78828a"><i class="fa fa-edit"></i></a>
                        </div>
                    </div>
                    <a href="{{ route('project_manager.projects.scope', $project) }}"><i class="fa fa-book-open"></i> Read More</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Credentials</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-11">
                            <p class="text-limit">{{ $project->credentials }}</p>
                        </div>
                        <div class="col-1 text-right">
                            <a href="{{ route('project_manager.projects.edit', $project) }}" class="h5" style="color: #78828a"><i class="fa fa-edit"></i></a>
                        </div>
                    </div>
                    <a href="{{ route('project_manager.projects.credentials', $project) }}"><i class="fa fa-book-open"></i> Read More</a>
                </div>
            </div>
        </div>
    </div>
@endsection