@extends('layouts.app')
@section('content')
<div class="container">
 <a href="/home" class="btn btn-warning">Upload</a>
 <a href="/users" class="btn btn-warning">User List</a>
</div>
<div class="container mt-2">
    <div class="row">
@forelse($images as $image)
<div class="col-xl-4 col-lg-4 col-md-6 col-xs-12">
<div class="card mb-3">
<img src="{{asset($image->image)}}" alt="Broken" class="card-img-top" height="220">
<div class="card-body">
    <div style="width:400px;">
     <div style="float: left; width: 130px"> 
<a href="/downloadImage/{{$image->id}}" class="btn btn-primary">Download</a>
</div>
@if(Auth::check())
@if($image->user_id == Auth::user()->id)
<form action="/image/{{$image->id}}" method="POST">
    @method('DELETE')
    @csrf
    <div style="float: right; width: 225px"> 
    <input type="submit" value="Delete" class="btn btn-danger">
</div>
</form>
@endif
@endif
</div>
</div>
</div>
   </div> 
@empty
<h1 class="text-danger">There is no uploads</h1>
@endforelse
</div>
<div class="row justify-content-center">
    {{$images->links()}}
    </div>
    
</div>
@endsection