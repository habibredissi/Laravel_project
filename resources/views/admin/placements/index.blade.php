@extends('layouts.app')

@section('content')
<div class="container">
<div><a href="http://127.0.0.1:8000/admin/placements/create" class="btn btn-success my-1">{{ __('Add a placement') }}</a></div>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">{{ __('Stadium') }}</th>
      <th scope="col">{{ __('Country') }}</th>
      <th scope="col">{{ __('Actions') }}</th>
    </tr>
  </thead>
  <tbody>
        @if(count($placements) > 0)
            @foreach ($placements as $placement)
            <tr>
                <th scope="row">{{$placement->id}}</th>
                <td>{{$placement->stadium}}</td>
                <td>{{$placement->country}}</td>
                <td><a href="{{$placement->id}}/edit" class="btn btn-primary">{{ __('Edit')}}</a>
                {!! Form::open(['action' => ['AdminPlacementsController@destroy', $placement->id], 'method' => 'POST']) !!}
                {{Form::submit( __('DELETE'), ['class' => 'btn btn-danger my-1'])}}
                {{Form::hidden('_method', 'DELETE')}}
                {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        @else
            {{ __('No team found.')}}
        @endif
  </tbody>
</table>
</div>
@endsection
