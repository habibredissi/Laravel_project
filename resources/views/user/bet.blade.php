
@extends ('layouts.app')

@section('content')

  <div class="jumbotron jumbotron-fluid coverBet">
    <div class="container">
      <h1 class="display-4 text-white font-weight-bold">CodeAMax !</h1>
      <p class="lead text-white font-weight-bold">Only for soccer lovers !</p>
    </div>
  </div>
  <div class="container">

  {!! Form::open(['action' => 'BetController@store', 'method'=>'POST']) !!}

  <h3>{{ __('Bet for match')}} {{$match[0]->match_id}}</h3>
  <h4>{{$match[0]->name1}} vs {{$match[0]->name2}} , {{$match[0]->stadium}}, {{$match[0]->matchDate}}</h4>

  <div class="form-group">
    {{form::label('bet_amount', __('Bet amount'))}}
    {{form::number('bet_amount', '', ['class' => 'form-control'])}}
  </div>

  <div class="form-group">
    {{Form::label('bet', __('Chose team'))}}
    {{Form::select('bet',[
      '1' => $match[0]->name1,
      '2' => $match[0]->name2,
      '0' => __('Ex-aeqo')
    ],'0',['class' => 'form-control'])}}
  </div>

    {{ Form::hidden('user_id', Auth::user()->id) }}
    {{ Form::hidden('match_id', $match[0]->match_id) }}
    {{ Form::hidden('team1_id', $match[0]->team1_id) }}
    {{ Form::hidden('team2_id', $match[0]->team2_id) }}


  <div class="form-group">
    {{Form::submit( __('Make bet'),['class' => 'btn btn-primary'])}}
  </div>

  {!! Form::close() !!}


  </div>

@endsection
