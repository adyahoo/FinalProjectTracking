@extends('layouts.employee')

@section('title','Project Detail')

@section('content')
    @include('project.employee.include.project_page_tab', [
        'requestVersion' => $selectedVersion->id
    ])
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8 col-md-8 col-12 col-sm-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-block" style="padding-top: 20px">
                            <div class="row">
                                <div class="col-lg-8 col-md-9 col-sm-12 text-left">
                                    <h6 class="text-primary">Timeline</h6>
                                    <h6 class="text-dark">{{ $project->start_date->format('d F Y') }} - {{ $project->end_date->format('d F Y') }}</h6>
                                </div>
                                <div class="col-lg-4 col-md-3 col-sm-12 text-right">
                                    <h6 class="text-primary">Gantt Chart</h6>
                                    <a href="{{ route('employee.projects.gantt_chart.index', $project) }}" class="btn btn-outline-primary" style="border-radius:.25rem">View Gantt Chart <i class="fa fa-external-link-alt"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-header d-block">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <h6 class="text-primary">Progress</h6>
                                    <div class="progress mt-3">
                                        <div class="progress-bar" role="progressbar" data-width="{{ $progressPercentage }}%" aria-valuenow="{{ $progressPercentage }}" aria-valuemin="0" aria-valuemax="100" style="width: {{ $progressPercentage }}%;">{{ round($progressPercentage) }}%</div>
                                    </div>
                                    <p class="mt-2 mb-0 text-dark">Module done on latest version : <b><span class="text-primary">{{ $selectedVersion->projectDetails()->whereDone()->count() }}</span> / {{ $selectedVersion->projectDetails->count() }}</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Scope</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-11">
                                    <p class="text-limit">{{ strip_tags($project->scope) }}</p>
                                </div>
                                <div class="col-1 text-right">
                                </div>
                            </div>
                            <a href="{{ route('employee.projects.scope', $project) }}"><i class="fa fa-book-open mr-2"></i>Read More</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Credentials</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-11">
                                    <p class="text-limit">{{ strip_tags($project->credentials) }}</p>
                                </div>
                                <div class="col-1 text-right">
                                </div>
                            </div>
                            <a href="{{ route('employee.projects.credentials', $project) }}"><i class="fa fa-book-open mr-2"></i>Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Launch Date</h4>
                        </div>
                        <div class="card-body">
                            @empty($project->launch_date)
                                <p>No launch date created</p>
                            @else
                                <div class="row">
                                    <div class="col-9">
                                        <p class="text-dark"><b><i class="fa fa-calendar-day"></i> {{ $project->launch_date->format('d F Y') }}</b></p>
                                    </div>
                                    <div class="col-3 text-right">
                                    </div>
                                </div>
                            @endempty
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Members <span class="badge badge-secondary">{{ $selectedVersion->userAssignments->groupBy('user_id')->count() }}</span></h4>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled user-progress list-unstyled-border list-unstyled-noborder">
                                @foreach($selectedVersion->userAssignments->groupBy('user_id') as $userAssignment)
                                    <li class="media">
                                        <img alt="image" class="mr-3 rounded-circle" width="50"
                                            @empty($userAssignment[0]->user->profile_image)
                                                src="{{ asset('templates/stisla/assets/img/avatar/avatar-1.png') }}"
                                            @else
                                                src="{{ asset('storage/profile_images/' . $userAssignment[0]->user->profile_image) }}"
                                            @endempty
                                        >
                                        <div class="media-body">
                                            <div class="media-title">{{ $userAssignment[0]->user->name }}</div>
                                            <div class="text-job text-muted">{{ $userAssignment[0]->user->role->name }}</div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="section-body">
                <h2 class="section-title">
                    Latest Activities
                    <a href="{{ route('employee.projects.logs.all', $project) }}" class="btn btn-outline-primary ml-2">View All</a>
                </h2>
                <div class="row">
                    @foreach($logs as $log)
                        <div class="col-6">
                            <div class="activities">
                                <div class="activity">
                                    <div class="activity-icon bg-primary text-white shadow-primary">
                                        <i class="fas fa-history"></i>
                                    </div>
                                    <div class="activity-detail">
                                        <div class="mb-2">
                                            <span class="text-job text-primary">{{ $log->created_at->format('d F Y') }} ({{ $log->created_at->format('H:i') }})</span>
                                            <span class="bullet"></span>
                                            <span class="text-job" href=""><i class="fa fa-user-circle"></i> {{ $log->causer->name }}</span>
                                        </div>
                                        <p>
                                            {{ $log->description }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection