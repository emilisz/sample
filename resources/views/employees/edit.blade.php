@extends('adminlte::page')

@section('title', 'Edit employee')

@section('content_header')
    <h1>Edit employee</h1>
@stop

@section('content')
<div class="container border p-3">
  <form action="{{route('companies.employees.update',['ide'=> $company->id,'id'=> $employee->id])}}" method="POST" >
     @method('PUT')
  @csrf
  <input type="hidden" name="company" value="{{$employee->id}}">
  <div class="input-group flex-nowrap">
  <div class="input-group-prepend">
    <span class="input-group-text" id="addon-wrapping">Name</span>
  </div>
  <input type="text" name="first_name" class="form-control" placeholder="..." aria-label="Username" aria-describedby="addon-wrapping" value="{{$employee->first_name}}">
</div>

<div class="input-group mt-2">
  <div class="input-group-prepend">
    <span class="input-group-text" id="addon-wrapping">Last name</span>
  </div>
  <input type="text" name="last_name" class="form-control" placeholder="..." aria-label="Email" aria-describedby="addon-wrapping" value="{{$employee->last_name}}">
</div>

<div class="input-group mt-2">
  <div class="input-group-prepend">
    <span class="input-group-text" id="addon-wrapping">Email</span>
  </div>
  <input type="text" name="email" class="form-control" placeholder="..." aria-label="Email" aria-describedby="addon-wrapping" value="{{$employee->email}}">
</div>

<div class="input-group mt-2">
  <div class="input-group-prepend">
    <span class="input-group-text" id="addon-wrapping">Phone</span>
  </div>
  <input type="text" name="phone" class="form-control" placeholder="..." aria-label="Website" aria-describedby="addon-wrapping" value="{{$employee->phone}}">
</div>

<button type="submit" class="btn btn-success mt-3">Update</button>
</form>
</div>
   
@endsection
