@extends('layouts.project_manager')

@section('title','Create Project')

@section('content')
    <div class="section-header">
        <h1>Projects</h1>
    </div>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <form action="{{ route('project_manager.projects.store') }}" enctype="multipart/form-data" method="POST">
              @csrf

              <div class="card-header">
                <h4>Create Project</h4>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" value="{{ old('name') }}" @error('name') class="form-control is-invalid" @else class="form-control" @enderror name="name">
                  @error('name')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="image-upload">Logo</label>
                  <div class="col-sm-12 col-md-7 mx-auto">
                      <input name="logo" class="form-control" value="{{ old('logo') }}" type="file" onchange="showPreview(event);" accept="image/jpg, image/jpeg, image/gif"/>
                      <img id="logo" class="img-fluid" id="propic" src="https://via.placeholder.com/480x480" alt="">
                  </div>
                  @error('logo')
                      <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="form-group">
                  <label>Description</label>
                  <textarea style="height: 200px" @error('description') class="form-control is-invalid" @else class="form-control" @enderror rows="10" name="description">{{ old('description') }}</textarea>
                  @error('description')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                  @enderror
                </div>
                <div class="form-row">
                      <div class="form-group col-md-6 col-lg-6">
                          <label>Start Date</label>
                          <input value="{{ old('start_date') }}" type="date" @error('start_date') class="form-control is-invalid" @else class="form-control" @enderror name="start_date">
                          @error('start_date')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                          @enderror
                      </div>
                      <div class="form-group col-md-6 col-lg-6">
                          <label>End Date</label>
                          <input value="{{ old('end_date') }}" type="date" @error('end_date') class="form-control is-invalid" @else class="form-control" @enderror name="end_date">
                          @error('end_date')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                          @enderror
                      </div>
                </div>
                <div class="form-group">
                  <label>Scope</label>
                  @error('scope')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                  @enderror
                  <textarea class="summernotes" name="scope">{{ old('scope') }}</textarea>
                </div>
                <div class="form-group">
                  <label>Credentials</label>
                  @error('credentials')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                  @enderror
                  <textarea class="summernotes" name="credentials">{{ old('credentials') }}</textarea>
                </div>
              </div>
              <div class="card-footer text-center">
                  <button class="btn btn-primary mr-1" type="submit">Save</button>
                  <button class="btn btn-secondary" type="reset">Reset</button>
              </div>

            </form>
          </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('templates/stisla/node_modules/jquery_upload_preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
    <script>
      function showPreview(event){
          if(event.target.files.length > 0){
              var src = URL.createObjectURL(event.target.files[0]);
              var preview = document.getElementById("logo");
              preview.src = src;
              preview.style.display = "block";
          }
      }
    </script>
    <script>
      $(".summernotes").summernote({
          dialogsInBody: true,
          minHeight: 250,
          toolbar: [
                  ['style', ['bold', 'italic', 'underline', 'clear']],
                  ['font', ['strikethrough']],
                  ['para', ['paragraph', 'ul', 'ol'],
              ]
          ]
      });
    </script>
@endsection