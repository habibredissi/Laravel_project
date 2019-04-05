@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('Add a new placement') }}</h1>
    {!! Form::open(['action' => 'AdminPlacementsController@store', 'method' => 'POST']) !!}


    <div class="form-group">
        {{form::label('stadium', __('Stadium name'))}}
        {{form::text('stadium', '', ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{form::label('country', __('Country'))}}
        {{form::text('country', '', ['class' => 'form-control'])}}
    </div>

        {{Form::submit( __('Submit'), ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
</div>
@endsection
