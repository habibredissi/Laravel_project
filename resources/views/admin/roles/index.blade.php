@extends('layouts.app')

@section('content')
<div class="container">
<div><a href="http://127.0.0.1:8000/admin/roles/create" class="btn btn-success my-1">Add a role</a></div>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">{{ __('Name') }}</th>
      <th scope="col">{{ __('Actions') }}</th>
    </tr>
  </thead>
  <tbody>
        @if(count($roles) > 0)
            @foreach ($roles as $role)
            <tr>
                <th scope="row">{{$role->id}}</th>
                <td>{{$role->role}}</td>
                {!! Form::open(['action' => ['AdminRolesController@destroy', $role->id], 'method' => 'POST']) !!}
                <td><a href="roles/{{$role->id}}/edit" class="btn btn-primary">{{ __('Edit') }}</a>
                {{Form::submit(__('DELETE'), ['class' => 'btn btn-danger my-1'])}}
                {{Form::hidden('_method', 'DELETE')}}
                {!! Form::close() !!}   
                </td>
            </tr>
            @endforeach
        @else
            No team found.
        @endif
  </tbody>
</table>
</div>
@endsection

