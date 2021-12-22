@extends('layouts.admin')
@section('title','Project Index')
@section('css')
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="section-header">
        <h1>Projects</h1>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Project List</h4>
                    <div class="card-header-action">
                        <a href="{{ route('admin.admin_projects.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add</a>
                    </div>
                </div>
                <div class="card-body">
                    <form role="form" method="GET">
                        <div class="form-row">
                            <div class="form-group col-md-3 col-lg-3">
                                <label>Start Date</label>
                                <input type="date" class="form-control" name="start_date" value="{{ $request->start_date }}">
                            </div>
                            <div class="form-group col-md-3 col-lg-3">
                                <label>End Date</label>
                                <input type="date" class="form-control" name="end_date" value="{{ $request->end_date }}">
                            </div>
                            <div class="form-group col-md-3 col-lg-3">
                                <label>User Assignee</label>
                                <select class="form-control form-control-sm" name="user">
                                    <option value="no_filter">All</option>
                                    @foreach($employees as $user)
                                        <option value="{{ $user->id }}" @if($user->id == $request->user) selected @endif>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-3 col-lg-2">
                                <label>Role Assignee</label>
                                <select class="form-control form-control-sm" name="role">
                                    <option value="no_filter">All</option>
                                    @foreach($roles as $role)
                                        <option value="{{ $role->id }}" @if($role->id == $request->role) selected @endif>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4 col-lg-1">
                                <button type="submit" class="btn btn-lg btn-primary position-absolute" style="bottom: 0"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
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
                                @foreach($projects as $project)
                                    <tr>
                                        <td>
                                            {{ $project->name }}
                                            <div class="table-links">
                                                <div class="bullet"></div>
                                                <a href="{{ route('admin.admin_projects.detail', $project) }}">View</a>
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
                                        <td>
                                            <a href="{{ route('admin.admin_projects.edit', $project->id) }}" class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                            <a href="#" onclick="deleteConfirm('del{{ $project->id }}')" class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <form id="del{{ $project->id }}" action="{{ route('admin.admin_projects.destroy', $project) }}" method="POST">
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

@section('js')
    <script src="{{ asset('templates/stisla/node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('templates/stisla/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('templates/stisla/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
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
            $('#title').text('Add Role')
            $('#form').attr('action', action);
            $("#form").attr("method", "post");
        });

        $(".btn-edit").click(function(){
            let action = $(this).data('action');
            let detail = $(this).data('detail');
            $('#title').text('Edit Role')
            $('#form').attr('action', action);
            $("#form").attr("method", "post");
            $("#method").attr("value", "put");
            $.get(detail, function (data) {
                $('#roleName').val(data.name);
                $('#privilege').val(data.privilege);
            });
        });
    </script>
@endsection