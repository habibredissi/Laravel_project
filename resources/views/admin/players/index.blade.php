@extends ('layouts.app')

@section('content')

    <div class="container">

    <a href="http://127.0.0.1:8000/admin/players/create" class="btn btn-secondary my-1">{{ __('Create a new player')}}</a>

  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">{{ __('First Name')}}</th>
        <th scope="col">{{ __('Last Name')}}</th>
        <th scope="col">{{ __('Birthdate')}}</th>
        <th scope="col">{{ __('Age')}}</th>
        <th scope="col">{{ __('Height')}}</th>
        <th scope="col">{{ __('Role')}}</th>
        <th scope="col">{{ __('Team')}}</th>
        <th scope="col">{{ __('Country')}}</th>
        <th scope="col">{{ __('Action')}}</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($players as $item)
          <tr>
            <th scope="row">{{$item->id}}</th>
            <td>{{$item->firstName}}</td>
            <td>{{$item->lastName}}</td>
            <td>{{$item->birthdate}}</td>
            <td>{{$item->age}}</td>
            <td>{{$item->height}}</td>
            <td>{{$item->role}}</td>
            <td>{{$item->name}}</td>
            <td>{{$item->country}}</td>
              <td><a href="players/{{$item->id}}/edit" class="btn btn-primary">{{ __('Edit')}}</a>
            {!! Form::open(['action' => ['AdminPlayersController@destroy', $item->id], 'method' => 'POST']) !!}
            {{Form::submit( __('DELETE'), ['class' => 'btn btn-danger my-1'])}}
            {{Form::hidden('_method', 'DELETE')}}
            {!! Form::close() !!} </td>
          </tr>

      @endforeach
    </tbody>
  </table>

  </div>

@endsection
