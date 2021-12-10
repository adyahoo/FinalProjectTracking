@extends('layouts.project_manager')

@section('content')
    <div class="section-header">
        <h1>Projects</h1>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Project List</h4>
                    <div class="card-header-action">
                        <a href="#" class="btn btn-primary"><i class="fas fa-plus"></i> Add</a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Modules</th>
                                    <th>Members</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        Timedoor Internal Job Tracking
                                        <div class="table-links">
                                            <div class="bullet"></div>
                                            <a href="#">View</a>
                                        </div>
                                    </td>
                                    <td>
                                        3
                                    </td>
                                    <td>
                                        5
                                    </td>
                                    <td>
                                        08-07-2021
                                    </td>
                                    <td>
                                        <div class="badge badge-warning">In Progress</div>
                                    </td>
                                    <td>
                                        <a class="btn btn-primary btn-action mr-1" data-toggle="tooltip" title="Edit"><i class="fas fa-pencil-alt"></i></a>
                                        <a class="btn btn-danger btn-action" data-toggle="tooltip" title="Delete" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="alert('Deleted')"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection