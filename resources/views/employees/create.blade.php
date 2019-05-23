@extends('adminlte::page')

@section('title', 'Create employee')

@section('content_header')
    <h1>Add new employee to "{{$company->first_name}}</h1>
@stop

@section('content')
<div class="container border p-3">
  <form action="{{route('companies.employees.store',['id'=> $company->id])}}" method="POST" enctype="multipart/form-data">
  @csrf
  <input type="hidden" name="company" value="{{$company->id}}">
  <div class="input-group flex-nowrap">
  <div class="input-group-prepend">
    <span class="input-group-text" id="addon-wrapping">Name</span>
  </div>
  <input type="text" name="first_name" class="form-control" placeholder="..." aria-label="Username" aria-describedby="addon-wrapping" value="{{old('first_name')}}">
</div>

<div class="input-group mt-2">
  <div class="input-group-prepend">
    <span class="input-group-text" id="addon-wrapping">Last name</span>
  </div>
  <input type="text" name="last_name" class="form-control" placeholder="..." aria-label="Email" aria-describedby="addon-wrapping" value="{{old('last_name')}}">
</div>

<div class="input-group mt-2">
  <div class="input-group-prepend">
    <span class="input-group-text" id="addon-wrapping">Email</span>
  </div>
  <input type="text" name="email" class="form-control" placeholder="..." aria-label="Email" aria-describedby="addon-wrapping" value="{{old('email')}}">
</div>

<div class="input-group mt-2">
  <div class="input-group-prepend">
    <span class="input-group-text" id="addon-wrapping">Phone</span>
  </div>
  <input type="text" name="phone" class="form-control" placeholder="..." aria-label="Website" aria-describedby="addon-wrapping" value="{{old('phone')}}">
</div>

<button type="submit" class="btn btn-success mt-3">Create</button>
</form>
</div>
   
@endsection
