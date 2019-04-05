@extends('layouts.app')

@section('content')
<div class="container">
<div><a href="http://127.0.0.1:8000/admin/teams/create" class="btn btn-success my-1">Add a team</a></div>
<table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">{{ __('Flag')}}</th>
      <th scope="col">{{ __('Name')}}</th>
      <th scope="col">{{ __('Country')}}</th>
      <th scope="col">{{ __('Actions')}}</th>
    </tr>
  </thead>
  <tbody>
        @if(count($data) > 0)
            @foreach ($data as $item)
            <tr>
                <th scope="row">{{$item->id}}</th>
                <td><img class="teamFlag" src="{{$item->flag}}"></td>
                <td>{{$item->name}}</td>
                <td>{{$item->country}}</td>
                {!! Form::open(['action' => ['AdminTeamsController@destroy', $item->id], 'method' => 'POST']) !!}
                <td><a href="teams/{{$item->id}}/edit" class="btn btn-primary">{{__('Edit')}}</a>
                {{Form::submit(__('DELETE'), ['class' => 'btn btn-danger my-1'])}}
                {{Form::hidden('_method', 'DELETE')}}
                {!! Form::close() !!}
                <a href="players/playersByTeam/{{$item->id}}" class="btn btn-secondary my-1">{{__('Show players')}}</a>
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
