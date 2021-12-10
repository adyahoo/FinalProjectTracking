@extends('layouts.project_manager')

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
                  <label>Title</label>
                  <input type="text" class="form-control" name="title">
                  @error('title')
                      <div class="invalid-feedback">
                        {{ $message }}
                      </div>
                  @enderror
                </div>
                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control" rows="10" name="description"></textarea>
                </div>
                <div class="form-row">
                      <div class="form-group col-md-6 col-lg-6">
                          <label>Start Date</label>
                          <input type="date" class="form-control" name="start_date">
                          @error('start_date')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                          @enderror
                      </div>
                      <div class="form-group col-md-6 col-lg-6">
                          <label>End Date</label>
                          <input type="date" class="form-control" name="end_date">
                          @error('end_date')
                              <div class="invalid-feedback">
                                {{ $message }}
                              </div>
                          @enderror
                      </div>
                </div>
                <div class="form-group">
                  <label>Scope</label>
                  <textarea class="summernote" name="scope"></textarea>
                </div>
                <div class="form-group">
                  <label>Credentials</label>
                  <textarea class="summernote" name="credentials"></textarea>
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