@extends('layouts.admin')
@section('title','Roles')
@section('css')
<link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endsection

@section('content')
<div class="section-header">
    <h1>Role Management</h1>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Roles Data</h4>
                    <button data-action="{{route('admin.roles.store')}}" class="btn btn-primary btn-round ml-auto btn-add text-white" data-toggle="modal" data-target="#modal">
                        <i class="fa fa-plus"></i>
                        Add Role
                    </button>
                </div>
                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th style="width: 10%">
                                        No.
                                    </th>
                                    <th>Role Name</th>
                                    <th>Privilege</th>
                                    <th style="width: 20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($roles as $role)
                                    <tr>
                                        <td>
                                            {{$loop->iteration}}
                                        </td>
                                        <td>{{$role->name}}</td>
                                        <td>{{$role->privilege}}</td>
                                        <td>
                                            <a data-detail="{{route('admin.roles.show', $role)}}" data-action="{{route('admin.roles.update', $role)}}" href="#" class="btn btn-info btn-edit" data-toggle="modal" data-target="#modal"><i class="fa fa-pencil-alt"></i></a>
                                            <a href="#" onclick="deleteConfirm('del{{$role->id}}')" class="btn btn-danger text-white">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <form id="del{{$role->id}}" action="{{ route('admin.roles.delete', $role) }}" method="post">        
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
                    <h5 id="title" class="modal-title">Role Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Role</label>
                        <input id="roleName" name="name" value="" type="text" class="form-control" placeholder="Input Role Name">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Privilege</label>
                        <select id="privilege" name="privilege" class="form-control">
                            <option value="">Select privilege</option>
                            <option value="admin">Admin</option>
                            <option value="project_manager">Project Manager</option>
                            <option value="employee">Employee</option>
                        </select>
                        @error('privilege')
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