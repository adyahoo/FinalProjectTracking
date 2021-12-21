@extends('layouts.project_manager')
@section('title','Profile')
@section('content')
<div class="section-header">
    <h1>Profile</h1>
</div>
<div class="section-body">
    <h2 class="section-title">Hi, {{Auth::user()->name}}!</h2>
    <p class="section-lead">
    Change information about yourself on this page.
    </p>

    <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-5">
            <div class="card profile-widget">
                <div class="profile-widget-header">
                    <img style="width:100px;height:100px;max-width: 100px;max-height: 100px" alt="image" src="{{Auth::user()->profile_image != null ? Storage::url('profile_images/'.Auth::user()->profile_image) : asset('templates/stisla/assets/img/avatar/avatar-1.png')}}" class="rounded-circle profile-widget-picture">
                    <div class="profile-widget-items">
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">Blog Posts</div>
                            <div class="profile-widget-item-value">{{$blogCount}}</div>
                        </div>
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">Total Views</div>
                            <div class="profile-widget-item-value">{{$blogViewCount}}</div>
                        </div>
                        <div class="profile-widget-item">
                            <div class="profile-widget-item-label">Total Module</div>
                            <div class="profile-widget-item-value">{{$assignmentCount}}</div>
                        </div>
                    </div>
                </div>
                <div class="profile-widget-description">
                    <div class="profile-widget-name">{{Auth::user()->name}} 
                        <div class="text-muted d-inline font-weight-normal">
                            <div class="slash"></div> {{Auth::user()->role->name}}</div>
                        </div>
                    @if(Auth::user()->bio != null)
                        {!! Auth::user()->bio !!}
                    @else
                        <p class="text-center">No bio yet</p>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12 col-md-12 col-lg-7">
            <div class="card">
                <form method="post" action="{{route('project_manager.profile.update', Auth::user()->id)}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-header">
                        <h4>Edit Profile</h4>
                    </div>
                    <div class="card-body">
                        <div class="card profile-widget">
                            <div class="profile-widget-header">
                                <img style="width:150px;height:150px;max-width: 150px;max-height: 150px" id="imgprev" alt="image" src="{{Auth::user()->profile_image != null ? Storage::url('profile_images/'.Auth::user()->profile_image) : asset('templates/stisla/assets/img/avatar/avatar-1.png')}}" class="rounded-circle profile-widget-picture">
                                <div class="profile-widget-items">
                                    <div class="profile-widget-item">
                                        <input type="file" name="profile_image" id="profile_image" onchange="readURL(this)" class="form-control" accept="image/jpg, image/jpeg, image/gif">
                                        @error('profile_image')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6 col-12">
                                <label>Name</label>
                                <input name="name" type="text" class="form-control" value="{{Auth::user()->name}}" required="">
                                @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Gender</label>
                                <select id="memberGender" name="gender" class="form-control">
                                    <option value="">Select Gender</option>
                                    <option value="male" {{Auth::user()->gender == 'male' ? 'selected' : ''}}>Male</option>
                                    <option value="female {{Auth::user()->gender == 'female' ? 'selected' : ''}}">Female</option>
                                </select>
                                @error('gender')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-7 col-12">
                                <label>Email</label>
                                <input name="email" type="email" class="form-control" value="{{Auth::user()->email}}" required="">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                            <div class="form-group col-md-5 col-12">
                                <label>Phone</label>
                                <input name="phone" type="number" class="form-control" value="{{Auth::user()->phone}}">
                                @error('phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label>Birth Date</label>
                                <input name="birth_date" type="date" class="form-control" value="{{Auth::user()->birth_date}}">
                                @error('birth_date')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12">
                                <label>Bio</label>
                                <textarea name="bio" class="form-control summernote-simple">{!! Auth::user()->bio !!}</textarea>
                                @error('bio')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
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
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imgprev')
                    .attr('src', e.target.result)
                    .width(200)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection