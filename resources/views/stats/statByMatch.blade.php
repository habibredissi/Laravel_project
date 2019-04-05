@extends('layouts.app')

@section('content')
<div class="container">

<center>

<h2>{{ __('Stats for match')}} {{$match[0]->id}}</h2>
<h3 class='my-4'>{{$match[0]->name1}} vs {{$match[0]->name2}} , {{$match[0]->stadium}}, {{$match[0]->matchDate}}</h3>

<table class="table tablestats">
  <tbody>
    <tr>
      <td><img src="http://127.0.0.1:8000/img/stats/yellow-card.png" class="iconStats mx-2"> {{ __('Yellow  Cards')}} </td>
      <td>{{$match[0]->yellowCards}}</td>
    </tr>
    <tr>
      <td><img src="http://127.0.0.1:8000/img/stats/red-card.png" class="iconStats mx-2"> {{ __('Red Cards')}} </td>
      <td>{{$match[0]->redCards}}</td>
    </tr>
    <tr>
      <td><img src="http://127.0.0.1:8000/img/stats/goal.png" class="iconStats mx-2"> {{ __('Penalties')}} </td>
      <td>{{$match[0]->penalties}}</td>
    </tr>
    <tr>
      <td><img src="http://127.0.0.1:8000/img/stats/referee.png" class="iconStats mx-2"> {{ __('Faults')}}  </td>
      <td>{{$match[0]->faults}}</td>
    </tr>
    <tr>
      <td><img src="http://127.0.0.1:8000/img/stats/corner.png" class="iconStats mx-2"> {{ __('Corners')}}  </td>
      <td>{{$match[0]->corners}}</td>
    </tr>
    <tr>
      <td><img src="http://127.0.0.1:8000/img/stats/football.png" class="iconStats mx-2"> {{ __('Freekicks')}}  </td>
      <td>{{$match[0]->freekicks}}</td>
    </tr>
    <tr>
      <td><img src="http://127.0.0.1:8000/img/stats/soccer.png" class="iconStats mx-2"> {{ __('Shots')}}  </td>
      <td>{{$match[0]->shots}}</td>
    </tr>
    <tr>
      <td><img src="http://127.0.0.1:8000/img/stats/strategy.png" class="iconStats mx-2"> {{ __('Offsides')}}  </td>
      <td>{{$match[0]->offsides}}</td>
    </tr>
    <tr>
      <td><img src="http://127.0.0.1:8000/img/stats/soccer-player.png" class="iconStats mx-2"> {{ __('Passes')}}  </td>
      <td>{{$match[0]->passes}}</td>
    </tr>
  </tbody>
</table>

</center>

<a href="http://127.0.0.1:8000/matchs" class="btn btn-dark my-1">{{ __('Back to all matches')}} </a>


</div>
@endsection
