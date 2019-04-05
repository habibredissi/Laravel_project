{{-- @foreach($matchs as $match)

@if($match->matchDate >  Carbon\Carbon::today())
      if
@else
      else
@endif

@endforeach --}}

@extends('layouts.app')
@section('content')
<div class="jumbotron jumbotron-fluid coverIndex">
  <div class="container">
    <h1 class="display-4 text-white font-weight-bold">CodeAMax !</h1>
    <p class="lead text-white font-weight-bold">Only for soccer lovers !</p>
  </div>
</div>
<div class="container">
<h1>{{ __('List of matchs') }}</h1>
    <table class="table">
    <thead class="thead-dark">
        <tr>
        <th scope="col">#</th>
        <th scope="col">{{ __('Team 1') }} </th>
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
            <td><img src="{{$match->flag1}}" class="teamFlag"> <a href="stats/playersByTeam/{{$match['team1_id']}}">{{$match->team1}}</a></td>
            <td><img src="{{$match->flag2}}" class="teamFlag"> <a href="stats/playersByTeam/{{$match['team2_id']}}">{{$match->team2}}</a></td>
            @if($match->score1>=0)
            <td>{{$match->score1}} - {{$match->score2}}</td>
            @else
            <td>-</td>
            @endif
            @if($match->score1 > $match->score2)
            <td>{{$match->team1}}</td>
            @elseif($match->score1 < $match->score2)
            <td>{{$match->team2}}</td>
            @elseif(($match->score1 == $match->score2) && ($match->score1 != -1))
            <td>{{ __('Ex-aeqo')}}</td>
            @else
            <td>-</td>
            @endif
            <td>{{$match->placement}}</td>
            <td>{{$match->matchDate}}</td>
            <td>
            @if (Auth::check())
                @php
                    $userID = Auth::user()->id
                @endphp
            @else
                @php
                    $userID = -1
                @endphp
            @endif
            @if(($match->matchDate >  Carbon\Carbon::today()) && ($match->user_id != $userID ))
                <a href="http://127.0.0.1:8000/user/bet/{{$match->id}}" class="btn btn-success">{{ __('Make a bet')}}</a>
            @elseif($match->user_id == $userID)
                <a href="user/allBets/{{$userID}}" class="btn btn-primary">{{ __('See my bets')}}</a>
            @endif
            @if ($match->stat_id != NULL && ($match->matchDate <  Carbon\Carbon::today()))
                    <a href="stats/statByMatch/{{$match->id}}" class="btn btn-secondary">{{ __('See stats')}}</a>
            @endif
            </td>
        </tr>
    @endforeach
    </tbody>
    </table>

    <a href="http://127.0.0.1:8000/stats/teams/" class="btn btn-secondary">{{ __('See all teams')}}</a>
</div>
@endsection
