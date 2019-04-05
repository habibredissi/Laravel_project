@extends('layouts.app')

@section('content')
<div class="container">
<h1></h1>
<a href="http://127.0.0.1:8000/admin/matchs/create" class="btn btn-success my-1">{{ __('Add a new match') }}</a>
    <table class="table">
    <thead class="thead-dark">
        <tr>
        <th scope="col">#</th>
        <th scope="col">{{ __('Team 1') }}</th>
        <th scope="col">{{ __('Team 2') }}</th>
        <th scope="col">{{ __('Score') }}</th>
        <th scope="col">{{ __('Winner') }}</th>
        <th scope="col">{{ __('Placement') }}</th>
        <th scope="col">{{ __('Match Date') }}</th>
        <th scope="col">{{ __('Actions') }}</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($matchs as $match)
        <tr>
            <th scope="row">{{$match->id}}</th>
            <td><img src="{{$match->flag1}}" class="teamFlag"><a href="http://127.0.0.1:8000/admin/players/playersByTeam/{{$match['team1_id']}}"> {{$match->team1}}</a></td>
            <td><img src="{{$match->flag2}}" class="teamFlag"><a href="http://127.0.0.1:8000/admin/players/playersByTeam/{{$match['team2_id']}}"> {{$match->team2}}</a></td>
            @if($match->score1 >= 0)
              <td>{{$match->score1}} - {{$match->score2}}</td>
            @else <td> - </td>
            @endif
            @if($match->score1 > $match->score2)
            <td>{{$match->team1}}</td>
            @elseif($match->score1 < $match->score2)
            <td>{{$match->team2}}</td>
            @elseif (($match->score1 == $match->score2) && $match->score1 != -1)
            <td>{{ __('Ex-aeqo')}}</td>
            @else
              <td> - </td>
            @endif
            <td>{{$match->placement}}</td>
            <td>{{$match->matchDate}}</td>
            <td><a href="matchs/{{$match->id}}/edit" class="btn btn-primary">{{ __('Edit')}}</a>
              @if ($match->stat_id == NULL)
              <a href="stats/addStats/{{$match->id}}" class="btn btn-success">{{ __('Add stats')}}</a>
            @elseif ($match->stat_id != NULL)
              <a href="stats/statByMatch/{{$match->id}}" class="btn btn-secondary">{{ __('See stats')}}</a>
            @endif
                {!! Form::open(['action' => ['AdminMatchsController@destroy', $match->id], 'method' => 'POST']) !!}
                {{Form::submit( __('DELETE'), ['class' => 'btn btn-danger my-1'])}}
                {{Form::hidden('_method', 'DELETE')}}
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
    </table>
</div>
@endsection
