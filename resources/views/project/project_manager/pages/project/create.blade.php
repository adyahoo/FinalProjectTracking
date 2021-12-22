@extends('layouts.project_manager')

@section('title','Create Project')

@section('content')
    <div class="section-header">
        <h1>Projects</h1>
    </div>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <form action="{{ route('project_manager.projects.store') }}" method="POST">
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
                  <label>Description</label>
                  <textarea @error('description') class="form-control is-invalid" @else class="form-control" @enderror rows="10" name="description">{{ old('description') }}</textarea>
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
                  <textarea class="summernote" name="scope">{{ old('scope') }}</textarea>
                </div>
                <div class="form-group">
                  <label>Credentials</label>
                  @error('credentials')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                  @enderror
                  <textarea class="summernote" name="credentials">{{ old('credentials') }}</textarea>
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