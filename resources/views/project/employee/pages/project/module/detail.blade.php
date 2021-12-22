@extends('layouts.employee')

@section('title','Project Module Detail')

@section('style')
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/datatables.net-select-bs4/css/select.bootstrap4.min.css') }}">
@endsection

@section('content')
    @include('project.employee.include.project_page_tab', [
        'project'             => $projectDetail->projectVersion->project,
        'latestVersionNumber' => $projectDetail->projectVersion->version_number
    ])
    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Project Members <span class="badge badge-secondary">{{ $projectDetail->userAssignments->count() }}</span></h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped" id="table-1">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($projectDetail->userAssignments as $userAssignment)
                                    <tr>
                                        <td>
                                            <img alt="image" class="rounded-circle mb-2 mr-2" width="35" data-toggle="tooltip" title="{{ $userAssignment->user->name }}"
                                                @empty($userAssignment->user->profile_image)
                                                    src="{{ asset('templates/stisla/assets/img/avatar/avatar-1.png') }}"
                                                @else
                                                    src="{{ asset('storage/profile_images/' . $userAssignment->user->profile_image) }}"
                                                @endempty
                                            >
                                            {{ $userAssignment->user->name }}
                                        </td>
                                        <td>
                                            {{ $userAssignment->user->email }}
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
                <div class="card-body text-center">
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <h6>Start Plan</h6>
                            <p>{{ $projectDetail->start_date->format('d-m-Y') }} ({{ $projectDetail->start_date->format('H:i') }})</p>
                        </div>
                        <div class="col-6">
                            <h6>End Plan</h6>
                            <p>{{ $projectDetail->end_date->format('d-m-Y') }} ({{ $projectDetail->end_date->format('H:i') }})</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-6">
                            <h6>Actual Start</h6>
                            @empty($projectDetail->start_date_actual)
                                <p>-</p>
                            @else
                                <p>{{ $projectDetail->start_date_actual->format('d-m-Y') }} ({{ $projectDetail->start_date_actual->format('H:i') }})</p>
                            @endempty
                        </div>
                        <div class="col-6">
                            <h6>Actual End</h6>
                            @empty($projectDetail->end_date_actual)
                                <p>-</p>
                            @else
                                <p>{{ $projectDetail->end_date_actual->format('d-m-Y') }} ({{ $projectDetail->end_date_actual->format('H:i') }})</p>
                            @endempty
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('templates/stisla/node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('templates/stisla/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('templates/stisla/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
    <script>
        $("#table-1").dataTable({
        });
    </script>
@endsection