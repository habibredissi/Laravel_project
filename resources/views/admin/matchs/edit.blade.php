@extends('layouts.app')

@section('content')
<div class="container">
    <h1> {{ __('Add a match')}}</h1>
    {!! Form::open(['action' => ['AdminMatchsController@update', $data['matchs']['0']->id], 'method' => 'POST']) !!}


    <div class="form-group">
        {{form::label('team1', __('Team 1 name'))}}
        {{form::select('team1', $data['listTeams'], $data['matchs']['0']->team1_id, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{form::label('team2', __('Team 2 name'))}}
        {{form::select('team2', $data['listTeams'], $data['matchs']['0']->team2_id, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{form::label('score1', __('Score 1'))}}
        {{form::number('score1', $data['matchs']['0']->score1, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{form::label('score2', __('Score 2'))}}
        {{form::number('score2', $data['matchs']['0']->score2, ['class' => 'form-control'])}}
    </div>

    {{-- <div class="form-group">
        {{form::label('winner', 'Winner team')}}
        {{form::select('winner', $data['listTeams'], $data['matchs']['0']->winner_id, ['class' => 'form-control'])}}
    </div> --}}

    <div class="form-group">
        {{form::label('placement', __('Placement'))}}
        {{form::select('placement', $data['listPlacements'], $data['matchs']['0']->placement_id, ['class' => 'form-control'])}}
    </div>

    <div class="form-group">
        {{form::label('date', __('Match date'))}}
        {{Form::date('matchDate', $data['matchs']['0']->matchDate, ['class' => 'form-control'])}}
    </div>
    {{form::hidden('_method', 'PUT')}}
    {{Form::submit( __('Submit'), ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
</div>
@endsection
