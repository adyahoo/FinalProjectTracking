@extends('layouts.gantt')
@section('title','Project Gantt Chart')
@section('css')
<link rel="stylesheet" href="{{asset('templates/gantt/codebase/dhtmlxgantt.css')}}">
<style>
    /* common styles for overriding borders/progress color */
    .gantt_task_line{
        border-color: rgba(0, 0, 0, 0.25);
    }
    .gantt_task_line .gantt_task_progress {
        background-color: rgba(0, 0, 0, 0.25);
    }

    /* high */
    .gantt_task_line.high {
        background-color: #d9534f;
    }
    .gantt_task_line.high .gantt_task_content {
        color: #fff;
    }

    /* medium */
    .gantt_task_line.medium {
        background-color: #FFC107;
    }
    .gantt_task_line.medium .gantt_task_content {
        color: #fff;
    }

    /* low */
    .gantt_task_line.low {
        background-color: #5cb85c;
    }
    .gantt_task_line.low .gantt_task_content {
        color: #fff;
    }

    /* critical */
    .gantt_task_line.critical {
        background-color: #2196F3;
    }
    .gantt_task_line.critical .gantt_task_content {
        color: #fff;
    }

    /* urgent */
    .gantt_task_line.urgent {
        background-color: #6777ef;
    }
    .gantt_task_line.urgent .gantt_task_content {
        color: #fff;
    }

    .weekend{ 
        background: #f4f7f4 !important;
    }
    .today{ 
        background: #5bc0de !important;
    }
</style>
@endsection

@section('content')
<div class="section-header">
    <div class="section-header-back">
        <a href="{{route('project_manager.projects.all')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Gantt Chart</h1>
</div>

<div class="section-body">
    <h2 class="section-title">Project {{$project->name}}</h2>
    <p class="section-lead">Description: {{$project->description}}</p>
    <div class="card">
    <div class="card-header">
        <h4>Current Version: {{$project->projectVersions()->find($version)->version_number}}</h4>
    </div>
    <div class="card-body">
        <div class="mb-2">
            <span>Info: </span>
            <span class="badge badge-pill badge-danger">Open</span>
            <span class="badge badge-pill badge-primary mr-1">On Progress</span>
            <span class="badge badge-pill badge-warning mr-1">Pending</span>
            <span class="badge badge-pill badge-info mr-1">Testing</span>
            <span class="badge badge-pill badge-success mr-1">Finish</span>
        </div>
        <div id="gantt_here" style='width:100%; height:500px;'></div>
    </div>
    </div>
</div>
@endsection
@section('modal')
<div class="modal fade" tabindex="-1" role="dialog" id="modal2">
    <div class="modal-dialog" role="document">
        <form id="forms" action="" method="" enctype="multipart/form-data">
            @csrf
            <input id="methods" type="hidden" name="_method" value=""/>
            <input id="projects" type="hidden" name="project_detail_id" value=""/>
            <div class="modal-content" style="margin-bottom: 50%">
                <div class="modal-header">
                    <h5 id="titles" class="modal-title">Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Member</label>
                        <select id="member" name="user_id" class="form-control">
                            <option value="">Select Member</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                            @endforeach
                        </select>
                        @error('user_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                    @if($project->user_id == Auth::user()->id)
                        <button type="submit" class="btn btn-primary">Assign Member</button>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('js')
<script src="{{asset('templates/gantt/codebase/dhtmlxgantt.js')}}"></script>
<script src="{{ asset('templates/stisla/node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>
@if (Session::has('success'))
    <script>
        swal("Success!", "{{ Session::get('success') }}", "success").then(function(){
            window.location.reload(window.location.href)
        });
    </script>
@endif
@if (Session::has('error'))
    <script>
        swal("Error!", "{{ Session::get('error') }}", "error").then(function(){
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
    var colHeader2 = 'Assign To';
    gantt.config.columns = [
        { name: "text", label: "Module name", width:150},
        { name: "start_date", label: "Start Date", align: "center", width:90},
        { name: "end_date", label: "End Date", align: "center", width:90},
        {name: "buttons", align:"center", label: colHeader2, width: 75,template: function (task) {
            return (
                        '<button id="btn-assign'+task.id+'" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal2">Assign</button>'
                    );
        }}
    ];

    gantt.config.layout = {
        css: "gantt_container",
        cols:[
            {
                width: "400",
                minWidth: "400",
                rows:[
                    {view:"grid", scrollX: "gridScroll", scrollable: true, scrollY: "scrollVer"},
                    {view:"scrollbar", id:"gridScroll", group: "horizintal"},
                ]
            },
            {resizer: true, width: 1},
            {
                rows: [
                    {view: "timeline", scrollX: "scrollHor", scrollable: true, scrollY: "scrollVer"},
                    {view: "scrollbar", id:"scrollHor", group: "horizontal"},
                ]
            },
            {view: "scrollbar", id:"scrollVer"},
        ]
    };

    gantt.config.fit_tasks     = true; 
    gantt.config.drag_move     = false;
    gantt.config.drag_links    = false;
    gantt.config.drag_resize   = false;
    gantt.config.drag_progress = false;
    gantt.showDate(new Date());

    gantt.templates.scale_cell_class = function(date){
        if(date.getDay() == 0 || date.getDay() == 6){
            return "weekend";
        }
    };

    gantt.templates.timeline_cell_class = function(task,date){
        if(date.getDay() == 0 || date.getDay() == 6){ 
            return "weekend" ;
        }
    };
    
    gantt.init("gantt_here");

    gantt.templates.task_text=function(start,end,task){
        return "<b> Status:</b> "+task.status+", <b>Assignee: </b>" + task.assignee;
    };

    gantt.templates.task_class  = function(start, end, task){
        switch (task.status){
            case "Open":
                return "high";
                break;
            case "Pending":
                return "medium";
                break;
            case "Finish":
                return "low";
                break;
            case "On Progress":
                return "urgent";
                break;
            case "Testing":
                return "critical";
                break;
            }
    };

    gantt.attachEvent("onTaskDblClick", function(id, e){
        var task             = gantt.getTask(id);
        window.location.href = '{{ route("project_manager.projects.module.show", ":id") }}'.replace(':id', task.id);
    });

    gantt.attachEvent("onTaskClick", function(id,e){
        if(e.target.id.includes("btn-assign"+id)){
            var task   = gantt.getTask(id);
            var status = gantt.getTask(id).status;
            $('#methods').val('post');
            $('#projects').val(id);
            $("#forms").attr("method", "post");
            $('#forms').attr('action', '{{ route("project_manager.projects.module.member.store", ":id") }}'.replace(':id', task.id));
            $('#titles').html('Assign Member');
        }
    });

    gantt.parse({!! json_encode($data) !!});
    
    
</script>
@endsection