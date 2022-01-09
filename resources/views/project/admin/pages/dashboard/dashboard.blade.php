@extends('layouts.admin')
@section('title', 'Dashboard')

@section('css')
<link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/fullcalendar/dist/fullcalendar.min.css') }}">
<style>
    .fc-event{
        text-align: center;
    }
</style>
@endsection

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
                    <i class="fas fa-rocket"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Launched Projects</h4>
                    </div>
                    <div class="card-body">
                        {{ $launchedProjects }}
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
                                @forelse($latestProjects as $project)
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
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">No data available</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-12 col-12 col-sm-12">
            <div class="card">
            <div class="card-header">
                <h4>Project Calendar</h4>
            </div>
            <div class="card-body">
                <div class="fc-overflow">
                <div id="myEvent"></div>
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
                    @forelse($logs as $log)
                        <li class="media">
                            @if(!isset($log->causer->profile_image))
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
                    @empty
                        <li class="media">
                            <div class="media-body">
                                <div class="media-title text-center">No Recent Activity</div>
                            </div>
                        </li>
                    @endforelse
                </ul>
                @if($logs->count() > 1)
                    <div class="text-center pt-1 pb-1">
                        <a href="{{route('admin.logs.index')}}" class="btn btn-primary btn-lg btn-round">
                            View All
                        </a>
                    </div>
                @endif
            </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
<script src="{{ asset('templates/stisla/node_modules/fullcalendar/dist/fullcalendar.min.js') }}"></script>
<script src="{{ asset('templates/stisla/node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>
<script>
$("#myEvent").fullCalendar({
    height: 'auto',
    header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay,listWeek'
    },
    editable: false,
    events: {!! $data !!},
    eventRender: function(event, element) {
        element.find('.fc-title').append("<br/>" + event.description);
    },
    eventClick: function(event) {
        if (event.url) {
            window.open(event.url);
            return false;
        }
    },
    eventMouseover: function(event, jsEvent, view) {
        var tooltip = '<div class="tooltipevent" style="width:auto;height:auto;background:#000;color:#fff;position:absolute;z-index:10001;padding:10px border-radius:5px;font-size:12px;">' + event.description + '</div>';
        var $tooltip = $(tooltip).appendTo('body');
    },
    

});
</script>
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