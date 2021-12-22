@extends('layouts.gantt')
@section('title','Project Gantt Chart')
@section('css')
<script src="{{asset('templates/gantt/codebase/dhtmlxgantt.js')}}"></script>
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
        background-color: #f0ad4e;
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

    .weekend{ background: #f4f7f4 !important;}
    .today{ background: #5bc0de !important;}
</style>
@endsection

@section('content')
<div class="section-header">
    <div class="section-header-back">
        <a href="{{route('admin.admin_projects.index')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Gantt Chart</h1>
</div>

<div class="section-body">
    <h2 class="section-title">Project {{$project->name}}</h2>
    <p class="section-lead">Description: {{$project->description}}</p>
    <div class="card">
    <div class="card-header">
        <h4>Project Version: {{$project->projectVersions()->where('project_id', $project->id)->orderBy('created_at', 'desc')->first()->version_number}}</h4>
    </div>
    <div class="card-body">
        <div id="gantt_here" style='width:100%; height:500px;'></div>
    </div>
    </div>
</div>
@endsection
@section('modal')
<div class="modal fade" tabindex="-1" role="dialog" id="modal">
    <div class="modal-dialog" role="document">
        <form id="form" action="" method="" enctype="multipart/form-data">
            @csrf
            <input id="method" type="hidden" name="_method" value=""/>
            <div class="modal-content" style="margin-bottom: 50%">
                <div class="modal-header">
                    <h5 id="title" class="modal-title">Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Status</label>
                        <select id="status" name="status" class="form-control">
                            <option value="not yet">Not Yet</option>
                            <option value="on progress">On Progress</option>
                            <option value="done">Done</option>
                        </select>
                        @error('status')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer bg-whitesmoke br">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Change Status</button>
                </div>
            </div>
        </form>
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
@if($errors->any())
    <script>
        var msg = "{{ implode(' \n', $errors->all(':message')) }}";
        swal("Error!", msg , "error");
    </script>
@endif
<script>
    var colHeader = 'Status';
    gantt.config.columns = [
        { name: "text", label: "Module name", width:150},
        { name: "start_date", label: "Start Date", align: "center", width:90},
        { name: "end_date", label: "End Date", align: "center", width:90},
        {name: "buttons", align:"center", label: colHeader,width: 75,template: function (task) {
return (
                    '<button id="btn-edit'+task.id+'" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal"><i class="fa fa-eye"></i></button>'
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

    gantt.config.drag_move     = false;
    gantt.config.drag_links    = false;
    gantt.config.drag_resize   = false;
    gantt.config.drag_progress = false;
    gantt.showDate(new Date());

    gantt.attachEvent("onTaskDblClick", function(){
        return false;
    });

    gantt.templates.scale_cell_class = function(date){
        if(date.getDay()==0||date.getDay()==6){
            return "weekend";
        }
    };

    gantt.templates.timeline_cell_class = function(task,date){
        if(date.getDay()==0||date.getDay()==6){ 
            return "weekend" ;
        }
    };
    
    gantt.init("gantt_here");
    gantt.templates.rightside_text = function(start, end, task){
        return "<b>Assignee: </b>" + task.assignee;
    };

    gantt.templates.task_text=function(start,end,task){
        return "<b>Module Name:</b> "+task.text+",<b> Status:</b> "+task.status;
    };

    gantt.templates.task_class  = function(start, end, task){
        switch (task.status){
            case "not yet":
                return "high";
                break;
            case "on progress":
                return "medium";
                break;
            case "done":
                return "low";
                break;
            }
    };
    
    gantt.attachEvent("onTaskClick", function(id,e){
        if(e.target.id.includes("btn-edit"+id)){
            var task   = gantt.getTask(id);
            var status = gantt.getTask(id).status;
            $('#method').val('PUT');
            $("#form").attr("method", "post");
            $('#form').attr('action', '{{route("admin.admin_projects.gantt_chart.update", ":id")}}'.replace(':id', task.id));
            $('#title').html('Change Status');
            $('#status').val(status);
        }
    });

    gantt.parse({!! json_encode($data) !!});
    
    
</script>
@endsection