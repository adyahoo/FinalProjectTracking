@extends('layouts.employee')

@section('title','Project Modules')

@section('style')
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/bootstrap-daterangepicker/daterangepicker.css') }}"/>
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}"/>
@endsection

@section('content')
    @include('project.employee.include.project_page_tab', [
        'project'             => $project,
        'latestVersionNumber' => $latestVersion->version_number
    ])
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Project Modules <span class="badge badge-secondary">{{ $project->projectDetails->count() }}</span></h4>
                    <div class="card-header-form mr-4">
                        <form action="{{ route('employee.projects.module.all', $project) }}">
                            <div class="input-group">
                                <select name="user" class="form-control form-control-sm py-1 mr-2" style="height: 32px; border-radius: 30px !important;">
                                    <option value="">All Module</option>
                                    <option value="{{ Auth::user()->id }}" @if($request->user == Auth::user()->id) selected @endif>Assigned to Me</option>
                                </select>
                                <select name="version" class="form-control form-control-sm py-1" style="height: 32px;">
                                    <option value="">All Version</option>
                                    @foreach($versions as $version)
                                        <option value="{{ $version->id }}" @if($request->version == $version->id) selected @endif>{{ $version->version_number }}</option>
                                    @endforeach
                                </select>
                                <div class="input-group-btn">
                                    <button class="btn btn-primary py-1" title="Search" type="submit" style="height: 32px; margin-top: 0;"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Assignee</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach($projectModules as $projectDetail)
                                        <tr>
                                            <td>
                                                <b>{{ $projectDetail->moduleable->name }}</b>
                                                <div class="mt-1">
                                                    <span>Added at : v{{ $projectDetail->projectVersion->version_number }}</span>
                                                </div>
                                                <div class="table-links">
                                                    <div class="bullet"></div>
                                                    <a href="{{ route('employee.projects.module.show', $projectDetail) }}">View</a>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="badge 
                                                    @if($projectDetail->status == $projectDetail->statusOption['not_yet'])
                                                        badge-danger
                                                    @elseif($projectDetail->status == $projectDetail->statusOption['on_progress'])
                                                        badge-warning
                                                    @elseif($projectDetail->status == $projectDetail->statusOption['done'])
                                                        badge-success
                                                    @endif
                                                ">{{ $projectDetail->status }}</div>
                                            </td>
                                            <td>
                                                @if($projectDetail->userAssignments->count() == 0)
                                                    no one assigned
                                                @else
                                                    @foreach($projectDetail->userAssignments->take(3) as $userAssignment)
                                                        <img alt="image" class="rounded-circle mb-2" width="35" data-toggle="tooltip" title="{{ $userAssignment->user->name }}"
                                                            @empty($userAssignment->user->profile_image)
                                                                src="{{ asset('templates/stisla/assets/img/avatar/avatar-1.png') }}"
                                                            @else
                                                                src="{{ asset('storage/profile_image/' . $userAssignment->user->profile_image) }}"
                                                            @endempty
                                                        >
                                                    @endforeach
                                                    @if($projectDetail->userAssignments->count() > 3)
                                                        <br><a href="{{ route('employee.projects.module.show', $projectDetail) }}">+ {{ $projectDetail->userAssignments->count() - 3 }} members</a>
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                {{ $projectDetail->start_date->format('d-m-Y') }}<br>
                                                ({{ $projectDetail->start_date->format('H:i') }})
                                            </td>
                                            <td>
                                                {{ $projectDetail->end_date->format('d-m-Y') }}<br>
                                                ({{ $projectDetail->end_date->format('H:i') }})
                                            </td>
                                            <td>
                                                @if($projectDetail->userAssignments->where('user_id', Auth::user()->id)->count() != 0)
                                                    @if($projectDetail->moduleable_type == $projectDetail->moduleType['special_module'])
                                                        <a data-detail="{{ route('employee.projects.module.edit', $projectDetail) }}" data-action="{{ route('employee.projects.module.special.update', $projectDetail) }}" href="#" class="btn btn-primary btn-change-status" data-toggle="modal" data-target="#modalChangeStatus" title="Change Status">Change Status</a>
                                                    @else
                                                        <a data-detail="{{ route('employee.projects.module.edit', $projectDetail) }}" data-action="{{ route('employee.projects.module.update', $projectDetail) }}" href="#" class="btn btn-primary btn-change-status" data-toggle="modal" data-target="#modalChangeStatus" title="Change Status">Change Status</a>
                                                    @endif
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

@section('modal')
    <div class="modal fade" tabindex="-1" role="dialog" id="modalChangeStatus">
        <div class="modal-dialog" role="document">
            <form id="formChangeStatus" action="" method="" enctype="multipart/form-data">
                @csrf
                <input id="methodChangeStatus" type="hidden" name="_method" value=""/>
                <div class="modal-content" style="margin-bottom: 50%">
                    <div class="modal-header">
                        <h5 id="titleChangeStatus" class="modal-title">Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Status</label>
                            <select id="status" name="status" class="form-control">
                                @foreach($statusOptions as $statusOption)
                                    <option value="{{ $statusOption }}">{{ $statusOption }}</option>
                                @endforeach
                            </select>
                            @error('status')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('templates/stisla/node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('templates/stisla/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('templates/stisla/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('templates/stisla/node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('templates/stisla/node_modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('templates/stisla/node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
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
        window.deleteConfirm = function(formId) {
            swal({
                title: 'Delete Confirmation',
                icon: 'warning',
                text: 'Do you want to delete this?',
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $('#'+formId).submit();
                }
            });
        }
    </script>
    <script>
        $("#table-1").dataTable({
            
        });
    </script>
    <script>
        $(".btn-change-status").click(function(){
            let action = $(this).data('action');
            let detail = $(this).data('detail');
            $('#titleChangeStatus').text('Change Module Status')
            $('#formChangeStatus').attr('action', action);
            $("#formChangeStatus").attr("method", "post");
            $("#methodChangeStatus").attr("value", "put");
            $.get(detail, function (data) {
                $('#module').val(data.moduleable.id);
                $('#status').val(data.status);
            });
        });
    </script>
@endsection