@extends('layouts.project_manager')

@section('content')
    <div class="section-header">
        <h1>Projects</h1>
    </div>
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>Create Project</h4>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label>Title</label>
                <input type="text" class="form-control">
              </div>
              <div class="form-group">
                <label>Description</label>
                <textarea class="form-control" rows="10"></textarea>
              </div>
              <div class="form-row">
                    <div class="form-group col-md-6 col-lg-6">
                        <label>Start Date</label>
                        <input type="date" class="form-control">
                    </div>
                    <div class="form-group col-md-6 col-lg-6">
                        <label>End Date</label>
                        <input type="date" class="form-control">
                    </div>
              </div>
              <div class="form-group">
                <label>Scope</label>
                <textarea class="summernote"></textarea>
              </div>
              <div class="form-group">
                <label>Credentials</label>
                <textarea class="summernote"></textarea>
              </div>
            </div>
            <div class="card-footer text-center">
                <button class="btn btn-primary mr-1" type="submit">Save</button>
            </div>
          </div>
        </div>
    </div>
@endsection