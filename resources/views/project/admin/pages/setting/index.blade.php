@extends('layouts.admin')
@section('title','Page Setting')

@section('content')
<div class="section-header">
    <h1>Page Setting</h1>
</div>

<div class="section-body">
    <form id="setting" action="{{route('admin.pagesetting.save')}}" enctype="multipart/form-data" method="POST">
        @csrf
        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
        <h2 class="section-title">Page Setting</h2>
        <p class="section-lead">On this page, you can change your web name or logo as you pleased.</p>
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label>Blog App Front Page Logo</label>
                    <input name="logo" style="width: 250px" class="form-control" value="{{ old('logo') }}" type="file" onchange="showPreview(event);" accept="image/jpg, image/jpeg, image/gif"/>
                    @if($pageSetting->logo)
                        <img id="logo" style="width: 250px; height: 250px;" class="img-fluid" src="{{Storage::url('app_logo/'.$pageSetting->logo)}}" alt="">
                    @else
                        <img id="logo" class="img-fluid" src="https://via.placeholder.com/250x250" alt="">
                    @endif
                    @error('logo')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Project Management App Name</label>
                    <input value="{{$pageSetting->title}}" name="title" type="text" class="form-control" placeholder="Input Name">
                    @error('title')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <a onclick="passChangeConfirm('setting')" class="btn btn-primary text-white">Change Setting</a>
                </div>
            </div>
        </div>
    </form>
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
    window.passChangeConfirm = function(formId) {
        swal({
            title: 'Page Setting Confirmation',
            icon: 'warning',
            text: 'Are You Sure Want to Change?',
            buttons: true,
            dangerMode: true,
        }).then((willChange) => {
            if (willChange) {
                $('#'+formId).submit();
            }
        });
    }
</script>
<script>
    function showPreview(event){
        if(event.target.files.length > 0){
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("logo");
            preview.src = src;
            preview.style.width   = "250px";
            preview.style.height  = "250px";
            preview.style.display = "block";
        }
    }
</script>
@endsection