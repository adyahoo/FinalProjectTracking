@extends('layouts.employee')

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
                        {{ $totalProjects }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-check-double"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Finished Projects</h4>
                    </div>
                    <div class="card-body">
                        {{ $finishedProjects }}
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($userAssignments as $userAssignment)
                                    <tr>
                                        <td>
                                            {{ $userAssignment->projectDetail->projectVersion->project->name }}
                                            <div class="table-links">
                                                <div class="bullet"></div>
                                                <a href="{{ route('employee.projects.detail', $userAssignment->projectDetail->projectVersion->project) }}">View</a>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $userAssignment->projectDetail->projectVersion->project->start_date->format('d-m-Y') }}
                                        </td>
                                        <td>
                                            {{ $userAssignment->projectDetail->projectVersion->project->end_date->format('d-m-Y') }}
                                        </td>
                                        <td>
                                            @if($userAssignment->projectDetail->projectVersion->project->projectVersions->count() > 1)
                                                <div class="badge badge-info">Maintenance</div>
                                            @elseif(!empty($userAssignment->projectDetail->projectVersion->project->launch_date))
                                                <div class="badge badge-success">Launch</div>
                                            @elseif($userAssignment->projectDetail->projectVersion->project->projectVersions->last()->projectDetails()->whereDoneOrOnProgress()->count() > 0)
                                                <div class="badge badge-warning">Development</div>
                                            @else
                                                <div class="badge badge-danger">Listed</div>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('employee.projects.edit', $userAssignment->projectDetail->projectVersion->project->id) }}" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="#" onclick="deleteConfirm('del{{ $userAssignment->projectDetail->projectVersion->project->id }}')" class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <form id="del{{ $userAssignment->projectDetail->projectVersion->project->id }}" action="{{ route('employee.projects.destroy', $userAssignment->projectDetail->projectVersion->project) }}" method="POST">
                                                @method('delete')
                                                @csrf
                                            </form>
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