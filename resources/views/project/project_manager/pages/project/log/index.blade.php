@extends('layouts.project_manager')

@section('title','Project Logs')

@section('style')
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/bootstrap-daterangepicker/daterangepicker.css') }}"/>
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}"/>
@endsection

@section('content')
    @include('project.project_manager.include.project_page_tab', [
        'requestVersion' => $selectedVersion->id
    ])
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Project Logs</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th>Causer</th>
                                    <th>Description</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($logs as $log)
                                    <tr>
                                        <td>
                                            <img alt="image" 
                                            @empty($log->causer->profile_image)
                                                src="{{ asset('templates/stisla/assets/img/avatar/avatar-1.png') }}"
                                            @else
                                                src="{{ asset('storage/profile_images/' . $log->causer->profile_image) }}"
                                            @endempty
                                            class="rounded-circle mb-2 mr-2" width="35" data-toggle="tooltip" title="{{ $log->causer->name }}">
                                            {{ $log->causer->name }}
                                        </td>
                                        <td>
                                            {{ $log->description }}
                                        </td>
                                        <td>
                                            {{ $log->created_at->format('d-m-Y') }} ({{ $log->created_at->format('H:i') }})
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
@endsection

@section('script')
    <script src="{{ asset('templates/stisla/node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('templates/stisla/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $("#table-1").dataTable({
            
        });
    </script>
@endsection