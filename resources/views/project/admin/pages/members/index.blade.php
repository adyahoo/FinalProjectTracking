@extends('layouts.admin')
@section('title','Members')
@section('css')
<link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endsection

@section('content')
<div class="section-header">
    <h1>Member Management</h1>
</div>

<div class="section-body">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Members Data</h4>
                    <button data-action="{{route('admin.members.store')}}" class="btn btn-primary btn-round ml-auto btn-add text-white" data-toggle="modal" data-target="#modal">
                        <i class="fa fa-plus"></i>
                        Add Member
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Division</th>
                                    <th style="width: 20%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($members as $member)
                                    <tr>
                                        <td>
                                            {{$loop->iteration}}
                                        </td>
                                        <td>{{$member->name}}</td>
                                        <td>{{$member->email}}</td>
                                        <td>{{$member->role->name}}</td>
                                        <td>{{$member->division->name}}</td>
                                        <td>
                                            <a data-detail="{{route('admin.members.show', $member)}}" data-action="{{route('admin.members.update', $member)}}" href="#" class="btn btn-info btn-edit" data-toggle="modal" data-target="#modal"><i class="fa fa-pencil-alt"></i></a>
                                            <a href="#" onclick="deleteConfirm('del{{$member->id}}')" class="btn btn-danger text-white">
                                                <i class="fa fa-trash"></i>
                                            </a>
                                            <form id="del{{$member->id}}" action="{{ route('admin.members.delete', $member) }}" method="post">        
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
                    <h5 id="title" class="modal-title">Member Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Name</label>
                        <input id="memberName" name="name" value="" type="text" class="form-control" placeholder="Input Member Name">
                        @error('name')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input id="memberEmail" name="email" value="" type="email" class="form-control" placeholder="Input Member Email">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <select id="memberGender" name="gender" class="form-control">
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        @error('gender')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Role</label>
                        <select id="memberRole" name="role_id" class="form-control">
                            <option value="">Select Role</option>
                            @foreach($roles as $role)
                                <option value="{{$role->id}}">{{$role->name}}</option>
                            @endforeach
                        </select>
                        @error('role_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Division</label>
                        <select id="memberDivision" name="division_id" class="form-control">
                            <option value="">Select Division</option>
                            @foreach($divisions as $division)
                                <option value="{{$division->id}}">{{$division->name}}</option>
                            @endforeach
                        </select>
                        @error('division_id')
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
        $('#title').text('Add Member')
        $('#form').attr('action', action);
        $("#form").attr("method", "post");
    });

    $(".btn-edit").click(function(){
        let action = $(this).data('action');
        let detail = $(this).data('detail');
        $('#title').text('Edit Member')
        $('#form').attr('action', action);
        $("#form").attr("method", "post");
        $("#method").attr("value", "put");
        $.get(detail, function (data) {
            $('#memberName').val(data.name);
            $('#memberEmail').val(data.email);
            $('#memberGender').val(data.gender);
            $('#memberDivision').val(data.division_id);
            $('#memberRole').val(data.role_id);
        });
    });
</script>
@endsection