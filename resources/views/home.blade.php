@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Upload Your Image Here!!</div>
                <div class="card-body">
                  <form action="/image" enctype="multipart/form-data" method="POST">
                    @csrf
                      <div class="form-group">
                        <input type="file" name="image[]" class="form-control-image" multiple>
                        <input type="submit" name="upload" value="upload" id="sub" class="btn btn-primary">
                      </div>
                  </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
