@extends('layouts.project_manager')

@section('title','Edit Project')

@section('style')
    <link rel="stylesheet" href="{{ asset('templates/stisla/node_modules/bootstrap-daterangepicker/daterangepicker.css') }}"/>
@endsection

@section('content')
    <div class="section-header">
        <h1>Projects</h1>
    </div>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <form action="{{ route('project_manager.projects.update', $project) }}" enctype="multipart/form-data" method="POST">
              @csrf
              @method('PUT')

              <div class="card-header">
                <h4>Edit Project</h4>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label>Name</label>
                  <input type="text" value="{{ $project->name }}" @error('name') class="form-control is-invalid" @else class="form-control" @enderror name="name">
                  @error('name')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="image-upload">Logo</label>
                  <div class="col-sm-12 col-md-7 mx-auto">
                      <input name="logo" class="form-control" value="{{ $project->logo }}" type="file" onchange="showPreview(event);" accept="image/jpg, image/jpeg, image/gif"/>
                      @if($project->logo)
                          <img id="logo" class="img-fluid" id="propic" src="{{ Storage::url('project_logo/'.$project->logo) }}" alt="Project Logo">
                      @else
                          <img id="logo" class="img-fluid" id="propic" src="https://via.placeholder.com/480x480" alt="">
                      @endif
                  </div>
                  @error('logo')
                      <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="form-group">
                  <label>Description</label>
                  <textarea @error('description') class="form-control is-invalid" @else class="form-control" @enderror rows="10" name="description">{{ $project->description }}</textarea>
                  @error('description')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label>Start - End Date</label>
                  <div class="input-group">
                      <div class="input-group-prepend">
                          <div class="input-group-text">
                              <i class="fas fa-calendar"></i>
                          </div>
                      </div>
                      <input
                          type="text"
                          name="start_end_date"
                          id="startEndDate"
                          class="form-control daterange-cus"
                          value="{{ $project->start_date }} - {{ $project->end_date }}"
                      />
                  </div>
                  @error('start_end_date')
                      <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
                <div class="form-group">
                  <label>Scope</label>
                  @error('scope')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                  @enderror
                  <textarea class="summernotes" name="scope">{{ $project->scope }}</textarea>
                </div>
                <div class="form-group">
                  <label>Credentials</label>
                  @error('credentials')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                  @enderror
                  <textarea class="summernotes" name="credentials">{{ $project->credentials }}</textarea>
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
  <script src="{{ asset('templates/stisla/node_modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
  <script>
      $(function() {
          $('#startEndDate').daterangepicker({
              timePicker: true,
              locale: {
                  format: 'YYYY-MM-DD HH:mm'
              }
          });
      });
  </script>
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