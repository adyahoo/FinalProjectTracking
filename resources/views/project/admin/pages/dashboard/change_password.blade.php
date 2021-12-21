@extends('layouts.admin')
@section('title','Change Password')

@section('content')
<div class="section-header">
    <div class="section-header-back">
        <a href="{{route('admin.profile.profile')}}" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
    </div>
    <h1>Change Password</h1>
</div>

<div class="section-body">
    <form id="pass" action="{{route('admin.profile.change-password.submit')}}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
        <h2 class="section-title">Change Password Page</h2>
        <p class="section-lead">On this page, you can change your password as you pleased.</p>
        <div class="card">
            <div class="card-body">
                <div class="form-group">
                    <label>Old Password</label>
                    <input name="old_password" type="password" class="form-control" placeholder="Input Old Password">
                    @error('old_password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>New Password</label>
                    <input name="password" type="password" class="form-control" placeholder="Input New Password">
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input name="password_confirmation" type="password" class="form-control" placeholder="Input Password Confirmation">
                    @error('password_confirmation')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="form-group">
                    <a onclick="passChangeConfirm('pass')" class="btn btn-primary text-white"><i class="fas fa-lock"></i> Change Password</a>
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
            title: 'Password Change Confirmation',
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

@endsection