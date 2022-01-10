@extends('layouts.project_manager')

@section('title','Edit Project Version')

@section('content')
    @include('project.project_manager.include.project_page_tab_version', [
        'project'        => $projectVersion->project,
        'requestVersion' => $request->version
    ])
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <form action="{{ route('project_manager.projects.version.update', $projectVersion) }}" method="POST">
              @csrf
              @method('PUT')

              <div class="card-header">
                <h4>Update Project Version</h4>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label>Description</label>
                  @error('description')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                  @enderror
                  <textarea style="height: 200px" name="description" class="form-control">{{ $projectVersion->description }}</textarea>
                </div>
                <div class="form-group">
                  <label>Note</label>
                  @error('note')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                  @enderror
                  <textarea class="summernote" name="note">{{ $projectVersion->note }}</textarea>
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
    <script src="{{ asset('templates/stisla/node_modules/sweetalert/dist/sweetalert.min.js') }}"></script>
    @if (Session::has('success'))
        <script>
            swal("Success!", "{{ Session::get('success') }}", "success");
        </script>
    @endif
    @if($errors->any())
        <script>
            var msg = "{{ implode(' \n', $errors->all(':message')) }}";
            swal("Error!", msg , "error");
        </script>
    @endif
    <script>
        $('.summernote').summernote({
            minHeight    : 300,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ]
        });
    </script>
@endsection