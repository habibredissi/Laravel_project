@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('Add a role') }}Add a role</h1>
    {!! Form::open(['action' => 'AdminRolesController@store', 'method' => 'POST']) !!}


    <div class="form-group">
        {{form::label('name', __('Role name'), [], false)}}
        {{form::text('name', '', ['class' => 'form-control'])}}
    </div>

        {{Form::submit(__('Submit'), ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
</div>
@endsection