@extends('layouts.employee')

@section('title','Project Version Create')

@section('content')
    @include('project.employee.include.project_page_tab_version', [
        'project'        => $project,
        'requestVersion' => $request->version
    ])
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <form action="{{ route('employee.projects.version.store', $project) }}" method="POST">
              @csrf

              <div class="card-header">
                <h4>Create Project Version</h4>
              </div>
              <div class="card-body">
                @error('version_number')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                @enderror
                <div class="form-row">
                    <div class="form-group col-md-4 col-lg-4">
                        <label>Major</label>
                        <input value="{{ $versionFetch[0] }}" type="number" class="form-control" name="major">
                    </div>
                    <div class="form-group col-md-4 col-lg-4">
                        <label>Minor</label>
                        <input value="{{ $versionFetch[1] }}" type="number" class="form-control" name="minor">
                    </div>
                    <div class="form-group col-md-4 col-lg-4">
                        <label>Patch</label>
                        <input value="{{ $versionFetch[2] + 1 }}" type="number"class="form-control" name="patch">
                    </div>
                </div>
                <div class="form-group">
                  <label>Description</label>
                  @error('description')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                  @enderror
                  <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                </div>
                <div class="form-group">
                  <label>Note</label>
                  @error('note')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                  @enderror
                  <textarea class="summernote" name="note">{{ old('note') }}</textarea>
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