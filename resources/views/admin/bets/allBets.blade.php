
@extends ('layouts.app')

@section('content')

  <div class="container">

<h3>{{ __('All bets') }} </h3>
    <table class="table">
      <thead class="thead-dark">
        <tr>
          <th scope="col">#</th>
          <th scope="col">{{ __('User_id') }}</th>
          <th scope="col">{{ __('Team 1') }} </th>
          <th scope="col">{{ __('Team 2') }}</th>
          <th scope="col">{{ __('Date') }}</th>
          <th scope="col">{{ __('Bet on') }}</th>
          <th scope="col">{{ __('Bet Amount') }}</th>
          <th scope="col">{{ __('Action' )}}</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($bets as $bet)

            <tr>
              <th scope="row">{{$bet->id}}</th>
              <td>{{$bet->user_id}}</td>
              <td>{{$bet->team1}}</td>
              <td>{{$bet->team2}}</td>
              <td>{{$bet->matchDate}}</td>
              <td>@if ($bet->bet == 0)
                {{'Ex-aeqo'}}
              @elseif ($bet->bet == 1)
                {{$bet->team1}}
              @else
                {{$bet->team2}}
              @endif</td>
              <td>{{$bet->betAmount}}</td>
              <td>
              {!! Form::open(['action' => ['BetController@destroy', $bet->id], 'method' => 'POST']) !!}
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
