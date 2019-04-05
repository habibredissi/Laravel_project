@extends ('layouts.app')

@section('content')

    <div class="container">

    @if ($players->count() > 0)
    <h3 class=my-4>{{ __('Players in team')}} {{$players['0']->name}}</h3>

  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">{{ __('First Name')}} </th>
        <th scope="col">{{ __('Last Name')}} </th>
        <th scope="col">{{ __('Age')}} </th>
        <th scope="col">{{ __('Height')}} </th>
        <th scope="col">{{ __('Role')}} </th>
        <th scope="col">{{ __('Action')}} </th>
      </tr>
    </thead>
    <tbody>
      @foreach ($players as $item)
          <tr>
            <th scope="row">{{$item->id}}</th>
            <td>{{$item->firstName}}</td>
            <td>{{$item->lastName}}</td>
            <td>{{$item->birthdate}}</td>
            <td>{{$item->height}}</td>
            <td>{{$item->role}}</td>
              <td><a href="../{{$item->id}}/edit" class="btn btn-primary">{{ __('Edit')}} </a>
            {!! Form::open(['action' => ['AdminPlayersController@destroy', $item->id], 'method' => 'POST']) !!}
            {{Form::submit( __('DELETE'), ['class' => 'btn btn-danger my-1'])}}
            {{Form::hidden('_method', 'DELETE')}}
            {!! Form::close() !!} </td>
          </tr>

      @endforeach

    @else
      <h3 class=my-4>{{ __('Nothing to show.')}}</h3>
    @endif
    </tbody>
  </table>

  <a href="http://127.0.0.1:8000/admin/teams" class="btn btn-secondary my-1">{{ __('Back')}}</a>


  </div>

@endsection
