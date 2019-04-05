@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ __('Add a match')}}</h1>
    {!! Form::open(['action' => 'AdminMatchsController@store', 'method' => 'POST']) !!}


    <div class="form-group">
        {{form::label('team1', __('Team 1 name'))}}
        {{form::select('team1', $data['teams'], null, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{form::label('team2', __('Team 2 name'))}}
        {{form::select('team2', $data['teams'], null, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{form::label('score1', __('Score 1'))}}
        {{form::number('score1', '', ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{form::label('score2', __('Score 2'))}}
        {{form::number('score2', '', ['class' => 'form-control'])}}
    </div>

    {{-- <div class="form-group">
        {{form::label('winner', 'Winner team')}}
        {{form::select('winner', $data['teams'], null, ['class' => 'form-control'])}}
    </div> --}}

    <div class="form-group">
        {{form::label('placement', __('Placement'))}}
        {{form::select('placement', $data['placements'], null, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{form::label('date', __('Match date'))}}
        {{Form::date('matchDate', \Carbon\Carbon::now(), ['class' => 'form-control'])}}
    </div>

    {{Form::submit( __('Submit'), ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
</div>
@endsection
