@extends('layouts.app')

@section('content')
<div class="container">

    <h1>{{ __('Edit a player')}}</h1>
    {!! Form::open(['action' => ['AdminPlayersController@update', $data['player']->id], 'method' => 'POST']) !!}


    <div class="form-group">
        {{form::label('firstname', __('First Name'))}}
        {{form::text('firstname', $data['player']->firstName, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{form::label('lastname', __('Last Name'))}}
        {{form::text('lastname', $data['player']->lastName, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{form::label('birthdate', __('Birthdate'))}}
        {{form::date('birthdate', $data['player']->birthdate, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{form::label('height', __('Height'))}}
        {{form::number('height', $data['player']->height, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{form::label('urlpicture', __('Picture URL'))}}
        {{form::text('urlpicture', $data['player']->urlPicture, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
      {{Form::label('team', __('Team'))}}
      {{Form::select('team',$data['teams'],$data['player_team'],['class' => 'form-control'])}}
    </div>

    <div class="form-group">
      {{Form::label('role', __('Role'))}}
      {{Form::select('role',$data['roles'],$data['player_role'],['class' => 'form-control'])}}
    </div>

        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit( __('Validate changes'), ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}

    {!! Form::open(['action' => ['AdminPlayersController@destroy', $data['player']->id], 'method' => 'POST']) !!}
    {{Form::submit( __('DELETE'), ['class' => 'btn btn-danger my-1 pull-right'])}}
    {{Form::hidden('_method', 'DELETE')}}
    {!! Form::close() !!}
</div>
@endsection
