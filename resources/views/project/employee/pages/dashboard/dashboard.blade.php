@extends('layouts.employee')

@section('title','Dashboard')

@section('content')
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-project-diagram"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Projects</h4>
                    </div>
                    <div class="card-body">
                        {{ $projects->count() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-rocket"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Projects Launched</h4>
                    </div>
                    <div class="card-body">
                        {{ $launchedProjects }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Blog Post</h4>
                    </div>
                    <div class="card-body">
                        {{ $totalBlogs }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Latest Projects</h4>
                    <div class="card-header-action">
                        <a href="{{ route('employee.projects.all') }}" class="btn btn-primary">View All</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($projects->take(3) as $project)
                                    <tr>
                                        <td>
                                            {{ $project->name }}
                                            <div class="table-links">
                                                <div class="bullet"></div>
                                                <a href="{{ route('employee.projects.detail', $project) }}">View</a>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $project->start_date->format('d-m-Y') }}
                                        </td>
                                        <td>
                                            {{ $project->end_date->format('d-m-Y') }}
                                        </td>
                                        <td>
                                            @if($project->projectVersions->count() > 1)
                                                <div class="badge badge-info">Maintenance</div>
                                            @elseif(!empty($project->launch_date))
                                                <div class="badge badge-success">Launch</div>
                                            @elseif($project->projectVersions->last()->projectDetails()->whereDoneOrOnProgress()->count() > 0)
                                                <div class="badge badge-warning">Development</div>
                                            @else
                                                <div class="badge badge-danger">Listed</div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection