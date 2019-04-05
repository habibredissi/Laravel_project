@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('Add a team') }}</h1>
    {!! Form::open(['action' => 'AdminTeamsController@store', 'method' => 'POST']) !!}


    <div class="form-group">
        {{form::label('name', __('Team name'))}}
        {{form::text('name', '', ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{form::label('country', __('Country name'))}}
        {{form::text('country', '', ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{form::label('flag', __('Flag URL'))}}
        {{form::text('flag', '', ['class' => 'form-control'])}}
    </div>

        {{Form::submit(__('Submit'), ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
</div>
@endsection