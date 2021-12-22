@extends('layouts.admin')
@section('title', 'Dashboard')
@section('content')
    <div class="section-header">
        <h1>Dashboard</h1>
    </div>
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-project-diagram"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Projects</h4>
                    </div>
                    <div class="card-body">
                        {{ $totalProjects }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="fas fa-check-double"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Finished Projects</h4>
                    </div>
                    <div class="card-body">
                        {{ $finishedProjects }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                    <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Blog Post</h4>
                    </div>
                    <div class="card-body">
                        {{ $totalBlogs }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h4>Latest Projects</h4>
                    <div class="card-header-action">
                        <a href="{{ route('admin.admin_projects.index') }}" class="btn btn-primary">View All</a>
                    </div>
                </div>
                <div class="card-body p-0">
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
                                @foreach($latestProjects as $project)
                                    <tr>
                                        <td>
                                            {{ $project->name }}
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
                                            <a href="{{ route('admin.admin_projects.detail', $project) }}" class="btn btn-light mr-1" data-toggle="tooltip" title="View"><i class="fas fa-eye"></i></a>
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
        <div class="col-lg-8 col-md-12 col-12 col-sm-12">
            <div class="card">
            <div class="card-header">
                <h4>Latest Blogs</h4>
                <div class="card-header-action">
                <a href="{{route('admin.review.index')}}" class="btn btn-primary">View All</a>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th style="width: 40%">Title</th>
                            <th style="width: 50%">Author</th>
                            <th style="width: 10%" class="text-center">Published At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($blogs as $blog)
                            <tr>
                                <td>
                                    {{$blog->title}}
                                </td>
                                <td>
                                    @if($blog->user->profile_image == null)
                                        <span class="font-weight-600"><img src="{{asset('templates/stisla/assets/img/avatar/avatar-1.png')}}" alt="avatar" width="30" class="rounded-circle mr-1"> {{$blog->user->name}}</span>
                                    @else
                                        <span class="font-weight-600"><img src="{{Storage::url('profile_images/'.$blog->user->profile_image)}}" alt="avatar" style="height: 30px;width: 30px;max-height: 30px; max-width: 30px;" class="rounded-circle mr-1"> {{$blog->user->name}}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($blog->published_at == null)
                                        <span class="badge badge-warning">Not Yet Published</span>
                                    @else
                                        <span >{{date('d M Y', strtotime($blog->published_at))}}</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12 col-12 col-sm-12">
            <div class="card">
            <div class="card-header">
                <h4>Recent Activities Logs</h4>
            </div>
            <div class="card-body">
                <ul class="list-unstyled list-unstyled-border">
                    @foreach($logs as $log)
                        <li class="media">
                            @if($log->causer->profile_image == null)
                                <img class="mr-3 rounded-circle" width="50" src="{{asset('templates/stisla/assets/img/avatar/avatar-1.png')}}" alt="avatar">
                            @else
                                <img style="height: 50px;width: 50px;max-height: 50px; max-width: 50px;" class="mr-3 rounded-circle" src="{{Storage::url('profile_images/'.$log->causer->profile_image)}}" alt="avatar">
                            @endif
                            <div class="media-body">
                                <div class="float-right text-primary text-small">{{$log->created_at->diffForHumans()}}</div>
                                <div class="media-title">{{$log->causer->name}}</div>
                                <span class="text-small text-muted">{{$log->description}}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <div class="text-center pt-1 pb-1">
                    <a href="{{route('admin.logs.index')}}" class="btn btn-primary btn-lg btn-round">
                        View All
                    </a>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script src="{{ asset('templates/stisla/node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>
@if (Session::has('success'))
        <script>
            swal("Success!", "{{ Session::get('success') }}", "success").then(function(){
                window.location.reload(window.location.href)
            });
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
@endsection