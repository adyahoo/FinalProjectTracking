@extends('layouts.project_manager')

@section('style')
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/bootstrap-daterangepicker/daterangepicker.css') }}"/>
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}"/>
@endsection

@section('content')
    <div class="section-header" style="display: block">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-12 col-sm-12">
                <h1>{{ $project->name }}</h1>
            </div>
            <div class="col-lg-4 col-md-4 col-12 col-sm-12 text-right">
                <p>Latest Version v{{ $latestVersion->version_number }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-md-8 col-12 col-sm-12">
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('project_manager.projects.detail', $project) }}">Detail</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active-tab" href="{{ route('project_manager.projects.module.all', $project) }}">Modules</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('project_manager.projects.version.all', $project) }}">Version</a>
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
                    <h4>Project Modules</h4>
                    <div class="card-header-action">
                        <button data-action="{{ route('project_manager.projects.module.create', $project) }}" class="btn btn-primary btn-round ml-auto btn-add text-white" data-toggle="modal" data-target="#modal">
                            <i class="fa fa-plus"></i>
                            Add Module
                        </button>
                        <button data-action="{{ route('project_manager.projects.module.special.create', $project) }}" class="btn btn-outline-primary btn-round ml-auto btn-special-module" data-toggle="modal" data-target="#modalSpecial">
                            <i class="fa fa-plus"></i>
                            Add Special Module
                        </button>
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
                                @foreach($project->project_versions as $version)
                                    @foreach($version->project_details as $projectDetail)
                                        <tr>
                                            <td>
                                                <b>{{ $projectDetail->moduleable->name }}</b>
                                                <div class="mt-1">
                                                    <div class="bullet"></div>
                                                    <span>Added at : v{{ $version->version_number }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                {{ $projectDetail->status }}
                                            </td>
                                            <td>
                                                @empty($projectDetail->user_assigments)
                                                    @foreach($projectDetail->user_assigments as $user)
                                                        {{ $user->name }} ({{ $user->role->name }})
                                                    @endforeach
                                                @else
                                                    no one assigned
                                                @endempty
                                            </td>
                                            <td>
                                                {{ $projectDetail->start_date->format('d-m-Y') }} ({{ $projectDetail->start_date->format('H:i') }})
                                            </td>
                                            <td>
                                                {{ $projectDetail->end_date->format('d-m-Y') }} ({{ $projectDetail->end_date->format('H:i') }})
                                            </td>
                                            <td>
                                                @if($projectDetail->moduleable_type == $projectDetail->moduleType['special_module'])
                                                    <a data-detail="{{ route('project_manager.projects.module.show', $projectDetail) }}" data-action="{{ route('project_manager.projects.module.special.update', $projectDetail) }}" href="#" class="btn btn-primary btn-edit-special" data-toggle="modal" data-target="#modalSpecial"><i class="fa fa-pencil-alt"></i></a>
                                                    <a href="#" onclick="deleteConfirm('del{{ $projectDetail->id }}')" class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                    <form id="del{{ $projectDetail->id }}" action="{{ route('project_manager.projects.module.special.destroy', $projectDetail) }}" method="POST">
                                                        @method('delete')
                                                        @csrf
                                                    </form>
                                                @else
                                                    <a data-detail="{{ route('project_manager.projects.module.show', $projectDetail) }}" data-action="{{ route('project_manager.projects.module.update', $projectDetail) }}" href="#" class="btn btn-primary btn-edit" data-toggle="modal" data-target="#modal"><i class="fa fa-pencil-alt"></i></a>
                                                    <a href="#" onclick="deleteConfirm('del{{ $projectDetail->id }}')" class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete">
                                                        <i class="fa fa-trash"></i>
                                                    </a>
                                                    <form id="del{{ $projectDetail->id }}" action="{{ route('project_manager.projects.module.destroy', $projectDetail) }}" method="POST">
                                                        @method('delete')
                                                        @csrf
                                                    </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
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
                            <label>Module</label>
                            <select id="module" name="moduleable_id" class="form-control">
                                @foreach($modules as $module)
                                    <option value="{{ $module->id }}">{{ $module->name }}</option>
                                @endforeach
                            </select>
                            @error('module')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-lg-6">
                                <label>Start Date</label>
                                <input value="{{ old('start_date') }}" id="start" type="text" name="start_date" class="form-control datetimepicker">
                                @error('start_date')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 col-lg-6">
                                <label>End Date</label>
                                <input value="{{ old('end_date') }}" id="end" type="text" name="end_date" class="form-control datetimepicker">
                                @error('end_date')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
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

    <div class="modal fade" tabindex="-1" role="dialog" id="modalSpecial">
        <div class="modal-dialog" role="document">
            <form id="formSpecial" action="" method="" enctype="multipart/form-data">
                @csrf
                <input id="methodSpecial" type="hidden" name="_method" value=""/>
                <div class="modal-content" style="margin-bottom: 50%">
                    <div class="modal-header">
                        <h5 id="titleSpecial" class="modal-title">Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Module / Bugfix Name</label>
                            <input type="text" value="{{ old('name') }}" id="nameSpecial" name="name" class="form-control">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" rows="10" id="descriptionSpecial" name="description">{{ old('description') }}</textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6 col-lg-6">
                                <label>Start Date</label>
                                <input value="{{ old('start_date') }}" type="text" id="startSpecial" name="start_date" class="form-control datetimepicker">
                                @error('start_date')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 col-lg-6">
                                <label>End Date</label>
                                <input value="{{ old('end_date') }}" type="text" id="endSpecial" name="end_date" class="form-control datetimepicker">
                                @error('end_date')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
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

@section('script')
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
        $(".btn-add").click(function(){
            let action = $(this).data('action');
            $('#title').text('Add Module')
            $('#form').attr('action', action);
            $("#form").attr("method", "post");
        });

        $(".btn-edit").click(function(){
            let action = $(this).data('action');
            let detail = $(this).data('detail');
            $('#title').text('Edit Module')
            $('#form').attr('action', action);
            $("#form").attr("method", "post");
            $("#method").attr("value", "put");
            $.get(detail, function (data) {
                $('#module').val(data.moduleable.id);
                $('#start').val(data.start_date.date);
                $('#end').val(data.end_date.date);
            });
        });

        $(".btn-special-module").click(function(){
            let action = $(this).data('action');
            $('#titleSpecial').text('Add Special Module')
            $('#formSpecial').attr('action', action);
            $("#formSpecial").attr("method", "post");
        });

        $(".btn-edit-special").click(function(){
            let action = $(this).data('action');
            let detail = $(this).data('detail');
            $('#titleSpecial').text('Edit Special Module')
            $('#formSpecial').attr('action', action);
            $("#formSpecial").attr("method", "post");
            $("#methodSpecial").attr("value", "put");
            $.get(detail, function (data) {
                $('#nameSpecial').val(data.moduleable.name);
                $('#descriptionSpecial').val(data.moduleable.description);
                $('#startSpecial').val(data.start_date.date);
                $('#endSpecial').val(data.end_date.date);
            });
        });
    </script>
@endsection