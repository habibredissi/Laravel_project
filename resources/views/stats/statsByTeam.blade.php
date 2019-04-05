@extends('layouts.app')

@section('content')
<div class="jumbotron jumbotron-fluid coverIndex">
  <div class="container">
    <h1 class="display-4 text-white font-weight-bold">CodeAMax !</h1>
    <p class="lead text-white font-weight-bold">Only for soccer lovers !</p>
  </div>
</div>
<div class="container">

<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col">#</th>
      <th scope="col">{{ __('Team')}}</th>
      <th scope="col">{{ __('Matches Played')}} </th>
      <th scope="col">{{ __('Goals scored')}} </th>
      <th scope="col">{{ __('Goals Conceaded')}} </th>
      <th scope="col">{{ __('Matchs Won')}} </th>
      <th scope="col">{{ __('Matchs Lost')}} </th>
      <th scope="col">{{ __('Draw Game')}} </th>
      <th scope="col">{{ __('Number of players')}} </th>
      <th scope="col">{{ __('Points')}} </th>
    </tr>
  </thead>
  <tbody>
  @foreach ($datas as $key => $data)
    <tr>
      <th scope="row">{{$key+1}}</th>
      <td><img class="teamFlag mx-2" src="{{$data['flag']}}">  <a href="http://127.0.0.1:8000/stats/playersByTeam/{{$data['id']}}">{{$data['name']}}</a></td>
      <td>{{$data['matchs']}}</td>
      <td>{{$data['goals']}}</td>
      <td>{{$data['goalsConceaded']}}</td>
      <td>{{$data['won']}}</td>
      <td>{{$data['lost']}}</td>
      <td>{{$data['draw']}}</td>
      <td>{{$data['players']}}</td>
      <td>{{$data['points']}}</td>
    </tr>
  @endforeach
  </tbody>
</table>
<a href="javascript:history.back()" class="btn btn-secondary my-1">{{ __('Back')}}</a>
</div>
@endsection
