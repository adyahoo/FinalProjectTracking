@extends('layouts.admin')

@section('css')
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/bootstrap-daterangepicker/daterangepicker.css') }}"/>
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}"/>
@endsection

@section('content')
    <div class="section-header" style="display: block">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-12 col-sm-12">
                <h1>{{ $projectDetail->projectVersion->project->name }}</h1>
            </div>
            <div class="col-lg-4 col-md-4 col-12 col-sm-12 text-right">
                <p>Latest Version v{{ $projectDetail->projectVersion->version_number }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-12 col-sm-12">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.admin_projects.detail', $projectDetail->projectVersion->project) }}">Detail</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active-tab" href="{{ route('admin.admin_projects.project_module.index', $projectDetail->projectVersion->project) }}">Modules</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.admin_projects.version.index', $projectDetail->projectVersion->project) }}">Version</a>
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
        {{-- <div class="col-lg-8 col-md-8 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-dark">{{ $projectDetail->moduleable->name }}</h4>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <h6>Start Date</h6>
                            <p>{{ $projectDetail->start_date->format('d-m-Y') }} ({{ $projectDetail->start_date->format('H:i') }})</p>
                        </div>
                        <div class="col-6">
                            <h6>End Date</h6>
                            <p>{{ $projectDetail->end_date->format('d-m-Y') }} ({{ $projectDetail->end_date->format('H:i') }})</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <h6>Start Date Actual</h6>
                            @empty($projectDetail->start_date_actual)
                                <p>-</p>
                            @else
                                <p>{{ $projectDetail->start_date_actual->format('d-m-Y') }} ({{ $projectDetail->start_date_actual->format('H:i') }})</p>
                            @endempty
                        </div>
                        <div class="col-6">
                            <h6>End Date Actual</h6>
                            @empty($projectDetail->end_date_actual)
                                <p>-</p>
                            @else
                                <p>{{ $projectDetail->end_date_actual->format('d-m-Y') }} ({{ $projectDetail->end_date_actual->format('H:i') }})</p>
                            @endempty
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="col-lg-8 col-md-8 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Project Members</h4>
                    <div class="card-header-action">
                        <button data-action="{{ route('admin.admin_projects.project_module.member.store', $projectDetail) }}" title="Add Member" class="btn btn-primary btn-round ml-auto btn-add-member text-white" data-toggle="modal" data-target="#modalMember">
                            <i class="fa fa-plus"></i>
                            Add Member
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($projectDetail->userAssignments as $userAssignment)
                                    <tr>
                                        <td>
                                            <img alt="image" src="{{ asset('templates/stisla/assets/img/avatar/avatar-1.png') }}" class="rounded-circle mb-2 mr-2" width="35" data-toggle="tooltip" title="{{ $userAssignment->user->name }}">
                                            {{ $userAssignment->user->name }}
                                            <div class="table-links">
                                                <div class="bullet"></div>
                                                <a href="{{ route('admin.admin_projects.detail', $userAssignment->user) }}">View</a>
                                            </div>
                                        </td>
                                        <td>
                                            {{ $userAssignment->user->email }}
                                        </td>
                                        <td>
                                            <a href="#" onclick="deleteConfirm('del{{ $userAssignment->id }}')" class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <form id="del{{ $userAssignment->id }}" action="{{ route('admin.admin_projects.project_module.member.destroy', $userAssignment) }}" method="POST">
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
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="text-dark">{{ $projectDetail->moduleable->name }}</h5>
                    <p>{{ $projectDetail->moduleable->description }}</p>
                </div>
                <div class="card-body">
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <h6>Start Date</h6>
                            <p>{{ $projectDetail->start_date->format('d-m-Y') }} ({{ $projectDetail->start_date->format('H:i') }})</p>
                        </div>
                        <div class="col-6">
                            <h6>End Date</h6>
                            <p>{{ $projectDetail->end_date->format('d-m-Y') }} ({{ $projectDetail->end_date->format('H:i') }})</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <h6>Start Date Actual</h6>
                            @empty($projectDetail->start_date_actual)
                                <p>-</p>
                            @else
                                <p>{{ $projectDetail->start_date_actual->format('d-m-Y') }} ({{ $projectDetail->start_date_actual->format('H:i') }})</p>
                            @endempty
                        </div>
                        <div class="col-6">
                            <h6>End Date Actual</h6>
                            @empty($projectDetail->end_date_actual)
                                <p>-</p>
                            @else
                                <p>{{ $projectDetail->end_date_actual->format('d-m-Y') }} ({{ $projectDetail->end_date_actual->format('H:i') }})</p>
                            @endempty
                        </div>
                    </div>
                    <div class="row">
                        <button data-action="{{ route('admin.admin_projects.project_module.update', $projectDetail) }}" data-detail="{{ route('admin.admin_projects.project_module.edit', $projectDetail) }}" title="Add Actual Date" class="btn btn-primary btn-round ml-auto btn-add-actual-date text-white" data-toggle="modal" data-target="#modalDateActual">
                            @empty($projectDetail->start_date_actual)
                                <i class="fa fa-plus"></i>
                                Add Actual Date
                            @else
                                <i class="fa fa-edit"></i>
                                Update Actual Date
                            @endempty
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <div class="modal fade" tabindex="-1" role="dialog" id="modalMember">
        <div class="modal-dialog" role="document">
            <form id="formMember" action="" method="" enctype="multipart/form-data">
                @csrf
                <input id="methodMember" type="hidden" name="_method" value=""/>
                <div class="modal-content" style="margin-bottom: 50%">
                    <div class="modal-header">
                        <h5 id="titleMember" class="modal-title">Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Member</label>
                            <select id="member" name="user_id" class="form-control">
                                @foreach($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" tabindex="-1" role="dialog" id="modalDateActual">
        <div class="modal-dialog" role="document">
            <form id="formDateActual" action="" method="" enctype="multipart/form-data">
                @csrf
                <input id="methodDateActual" type="hidden" name="_method" value=""/>
                <div class="modal-content" style="margin-bottom: 50%">
                    <div class="modal-header">
                        <h5 id="titleDateActual" class="modal-title">Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Start Date Actual</label>
                            <input value="{{ old('start_date_actual') }}" type="text" id="startActual" name="start_date_actual" class="form-control datetimepicker">
                            @error('start_date_actual')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>End Date Actual</label>
                            <input value="{{ old('end_date_actual') }}" type="text" id="endActual" name="end_date_actual" class="form-control datetimepicker">
                            @error('end_date_actual')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">
                            @empty($projectDetail->start_date_actual)
                                <i class="fa fa-plus"></i>
                                Add
                            @else
                                <i class="fa fa-edit"></i>
                                Update
                            @endempty
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('templates/stisla/node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('templates/stisla/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('templates/stisla/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('templates/stisla/node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script src="{{ asset('templates/stisla/node_modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('templates/stisla/node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
    @if (Session::has('success'))
        <script>
            swal("Success!", "{{ Session::get('success') }}", "success");
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
        $(".btn-add-member").click(function(){
            let action = $(this).data('action');
            $('#titleMember').text('Add Member');
            $('#formMember').attr('action', action);
            $("#formMember").attr("method", "post");
        });

        $(".btn-add-actual-date").click(function(){
            let action = $(this).data('action');
            let detail = $(this).data('detail');
            $('#titleDateActual').text('Actual Date');
            $('#formDateActual').attr('action', action);
            $("#formDateActual").attr("method", "post");
            $("#methodDateActual").attr("value", "put");
            $.get(detail, function (data) {
                $('#startActual').val(data.start_date_actual.date);
                $('#endActual').val(data.end_date_actual.date);
            });
        });
    </script>
@endsection