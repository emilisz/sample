@extends('adminlte::page')

@section('title', 'Companies')

@section('content_header')
    <h1>All companies</h1>
@stop

@section('content')
<a class="btn btn-info" href="{{route('companies.create')}}">Create new company</a>
<hr>

    <table  id="company"  class="display table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Logo</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Website</th>
      <th scope="col">Show</th>
      <th scope="col">Edit</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
    @foreach($allCompanies as $company)
    <tr>
      <th scope="row">{{$company->id}}</th>
      <td><img width="100" height="100" src="{{url('storage/logos/'.$company->logo)}}"></td>
      <td>{{$company->first_name}}</td>
      <td>{{$company->email}}</td>
      <td>{{$company->website}}</td>
      <td><a class="btn btn-success" href="{{route('companies.show', ['id'=> $company->id])}}">Show <span class="badge badge-light">{{count($company->employees)}}</span></a></td>
      <td><a class="btn btn-warning" href="{{route('companies.edit', ['id'=> $company->id])}}">Edit</a></td>
      <td> <form class="float-right"   method="POST" action="{{route('companies.destroy', ['id'=> $company->id])}}">
            {!! method_field('delete') !!}
            @csrf
            <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger ">Delete</button>
        </form></td>
      
    </tr>
    @endforeach
  </tbody>
</table>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
             $('#company').DataTable();
        });
    </script>
@stop
