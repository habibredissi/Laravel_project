@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('Edit a placement') }}</h1>
    {!! Form::open(['action' => ['AdminPlacementsController@update', $placement->id] , 'method' => 'POST']) !!}


    <div class="form-group">
        {{form::label('stadium', __('Stadium name'))}}
        {{form::text('stadium', $placement->stadium, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{form::label('country', __('Country'))}}
        {{form::text('country', $placement->country, ['class' => 'form-control'])}}
    </div>

        {{Form::hidden('_method', 'PUT')}}
        {{Form::submit( __('Submit'), ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}

    {!! Form::open(['action' => ['AdminPlacementsController@destroy', $placement->id], 'method' => 'POST']) !!}
        {{Form::submit( __('DELETE'), ['class' => 'btn btn-danger my-1'])}}
        {{Form::hidden('_method', 'DELETE')}}
    {!! Form::close() !!}
</div>
@endsection
