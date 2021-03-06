@extends('layouts.admin')
@section('title','Project Detail')
@section('content')
    @include('project.admin.include.project_page_tab', [
        'requestVersion' => $request->version
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
                            <a href="{{ route('admin.admin_projects.edit', $project) }}" class="h5" style="color: #78828a"><i class="fa fa-edit"></i></a>
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
                                    @empty($request->version)
                                        <a href="{{route('admin.admin_projects.gantt_chart.index', ['project'=>$project, 'version'=>$selectedVersion->id])}}" class="btn btn-outline-primary" style="border-radius:.25rem">View Gantt Chart <i class="fa fa-external-link-alt"></i></a>
                                    @else
                                        <a href="{{route('admin.admin_projects.gantt_chart.index', ['project'=>$project, 'version'=>$request->version])}}" class="btn btn-outline-primary" style="border-radius:.25rem">View Gantt Chart <i class="fa fa-external-link-alt"></i></a>
                                    @endempty
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
                                    <p class="mt-2 mb-0 text-dark">Module finished on selected version : <b><span class="text-primary">{{ $selectedVersion->projectDetails()->whereDone()->count() }}</span> / {{ $selectedVersion->projectDetails->count() }}</b></p>
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
                                    <a href="{{ route('admin.admin_projects.edit', $project) }}" class="h5" style="color: #78828a"><i class="fa fa-edit"></i></a>
                                </div>
                            </div>
                            <a href="{{ route('admin.admin_projects.scope', $project) }}"><i class="fa fa-book-open mr-2"></i>Read More</a>
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
                                    <a href="{{ route('admin.admin_projects.edit', $project) }}" class="h5" style="color: #78828a"><i class="fa fa-edit"></i></a>
                                </div>
                            </div>
                            <a href="{{ route('admin.admin_projects.credentials', $project) }}"><i class="fa fa-book-open mr-2"></i>Read More</a>
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
                                <a href="#" data-action="{{ route('admin.admin_projects.addLaunchDate', $project) }}" class="btn-add" data-toggle="modal" data-target="#modal">Add launch date</a>
                            @else
                                <div class="row">
                                    <div class="col-9">
                                        <p class="text-dark"><b><i class="fa fa-calendar-day"></i> {{ $project->launch_date->format('d F Y') }}</b></p>
                                    </div>
                                    <div class="col-3 text-right">
                                        <a href="#" data-action="{{ route('admin.admin_projects.addLaunchDate', $project) }}" data-detail="{{ $project->launch_date->format('Y-m-d') }}" class="btn-edit" data-toggle="modal" data-target="#modal" class="h5" style="color: #78828a"><i class="fa fa-edit"></i></a>
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
                            <h4>Members <span class="badge badge-secondary">{{ $project->userAssignments->groupBy('user_id')->count() }}</span></h4>
                            <div class="card-header-action">
                                <a href="{{ route('admin.admin_projects.project_module.index', $project) }}" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled user-progress list-unstyled-border list-unstyled-noborder">
                                @foreach($project->userAssignments->groupBy('user_id') as $userAssignment)
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
                    <a href="{{ route('project_manager.projects.logs.all', $project) }}" class="btn btn-outline-primary ml-2">View All</a>
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
</div>
@endsection

@section('modal')
    <div class="modal fade" tabindex="-1" role="dialog" id="modal">
        <div class="modal-dialog" role="document">
            <form id="form" action="" method="" enctype="multipart/form-data">
                @csrf
                <input id="method" type="hidden" name="_method" value=""/>
                <div class="modal-content" style="margin-bottom: 50%">
                    <div class="modal-header">
                        <h5 id="title" class="modal-title">Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Launch Date</label>
                            <input value="{{ old('launch_date') }}" id="launchDate" type="date" name="launch_date" class="form-control">
                            @error('launch_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('templates/stisla/node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>
    @if (Session::has('success'))
        <script>
            swal("Success!", "{{ Session::get('success') }}", "success").then(function(){
                window.location.reload(window.location.href)
            });
        </script>
    @endif
    @if($errors->any())
        <script>
            var msg = "{{ implode(' \n', $errors->all(':message')) }}";
            swal("Error!", msg , "error");
        </script>
    @endif
    <script>
        $(".btn-add").click(function(){
            let action = $(this).data('action');
            $('#title').text('Add Launch Date')
            $('#form').attr('action', action);
            $("#form").attr("method", "post");
            $("#method").attr("value", "put");
        });

        $(".btn-edit").click(function(){
            let action = $(this).data('action');
            let detail = $(this).data('detail');
            $('#title').text('Edit Launch Date')
            $('#form').attr('action', action);
            $("#form").attr("method", "post");
            $("#method").attr("value", "put");
            $('#launchDate').val(detail);
            console.log(detail);
        });
    </script>
@endsection