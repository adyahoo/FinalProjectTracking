@extends('layouts.project_manager')

@section('title','Modules')

@section('style')
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endsection

@section('content')
    <div class="section-header">
        <h1>Modules Management</h1>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Modules Data</h4>
                        <button data-action="{{route('project_manager.modules.store')}}" class="btn btn-primary btn-round ml-auto btn-add text-white" data-toggle="modal" data-target="#modal">
                            <i class="fa fa-plus"></i>
                            Add Module
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
                                        <th>Module Name</th>
                                        <th>Description</th>
                                        <th>Time Estimation</th>
                                        <th style="width: 20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($modules as $module)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>
                                            <td>{{ $module->name }}</td>
                                            <td>{{ $module->description }}</td>
                                            <td>{{ $module->time_estimation }} hours</td>
                                            <td>
                                                <a data-detail="{{ route('project_manager.modules.show', $module) }}" data-action="{{ route('project_manager.modules.update', $module) }}" href="#" class="btn btn-info btn-edit" data-toggle="modal" data-target="#modal"><i class="fa fa-pencil-alt"></i></a>
                                                <a href="#" onclick="deleteConfirm('del{{ $module->id }}')" class="btn btn-danger text-white">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                                <form id="del{{ $module->id }}" action="{{ route('project_manager.modules.delete', $module) }}" method="post">
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
                        <h5 id="title" class="modal-title">Module Form</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Module Name</label>
                            <input id="moduleName" name="name" value="" type="text" class="form-control" placeholder="Input Module Name">
                            @error('name')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea style="height: 200px" id="moduleDescription" name="description" value="" type="text" class="form-control" placeholder="Input Description"></textarea>
                            @error('description')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Time Estimation (in hour)</label>
                            <input id="moduleTime" name="time_estimation" value="" type="number" min=0 step="0.01" class="form-control" placeholder="Input Module Time Estimation">
                            @error('time_estimation')
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

@section('script')
    <script src="{{ asset('templates/stisla/node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('templates/stisla/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('templates/stisla/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('templates/stisla/node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>
    <script>
        $(document).on('keydown', 'input[pattern]', function(e){
            var input = $(this);
            var oldVal = input.val();
            var regex = new RegExp(input.attr('pattern'), 'g');

            setTimeout(function(){
                var newVal = input.val();
                if(!regex.test(newVal)){
                input.val(oldVal); 
                }
            }, 1);
        });
    </script>
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
                $('#moduleName').val(data.name);
                $('#moduleDescription').val(data.description);
                $('#moduleTime').val(data.time_estimation);
            });
        });
    </script>
@endsection