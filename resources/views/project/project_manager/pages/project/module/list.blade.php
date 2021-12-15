@extends('layouts.project_manager')

@section('style')
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
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
                        <a class="nav-link" href="{{ route('project_manager.projects.versions', $project) }}">Version</a>
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
                        <button data-action="{{route('project_manager.projects.module.create', $project)}}" class="btn btn-primary btn-round ml-auto btn-add text-white" data-toggle="modal" data-target="#modal">
                            <i class="fa fa-plus"></i>
                            Add Module
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($project->project_versions as $version)
                                    @foreach($version->project_details as $projectDetail)
                                        <tr>
                                            <td>
                                                @isset($projectDetail->special_module)
                                                    {{ $projectDetail->special_module }}
                                                @else
                                                    {{ $projectDetail->module->name }}
                                                @endisset
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
                                                <a href="{{ route('project_manager.projects.edit', $projectDetail->id) }}" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                                <a href="#" onclick="deleteConfirm('del{{ $projectDetail->id }}')" class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                <form id="del{{ $projectDetail->id }}" action="{{ route('project_manager.projects.destroy', $projectDetail) }}" method="POST">
                                                    @method('delete')
                                                    @csrf
                                                </form>
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
            <input id="method" type="hidden" name="_method" value="" />
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="title" class="modal-title">Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Module</label>
                        <select id="module" name="module_id" class="form-control">
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
                            <input value="{{ old('start_date') }}" type="date" name="start_date" class="form-control">
                            @error('start_date')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 col-lg-6">
                            <label>End Date</label>
                            <input value="{{ old('end_date') }}" type="date" name="end_date" class="form-control">
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

        // $(".btn-edit").click(function(){
        //     let action = $(this).data('action');
        //     let detail = $(this).data('detail');
        //     $('#title').text('Edit Role')
        //     $('#form').attr('action', action);
        //     $("#form").attr("method", "post");
        //     $("#method").attr("value", "put");
        //     $.get(detail, function (data) {
        //         $('#roleName').val(data.name);
        //         $('#privilege').val(data.privilege);
        //     });
        // });
    </script>
@endsection