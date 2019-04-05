@extends ('layouts.app')

@section('content')

    <div class="container">

    @if ($players->count() > 0)
    <h3 class=my-4>Players in team {{$players['0']->name}}</h3>

  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">First Name</th>
        <th scope="col">Last Name</th>
        <th scope="col">Age</th>
        <th scope="col">Height</th>
        <th scope="col">Role</th>
        <th scope="col">Action</th>
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
          </tr>

      @endforeach

    @else
      <h3 class=my-4>Nothing to show.</h3>
    @endif
    </tbody>
  </table>

  <a href="javascript:history.back()" class="btn btn-secondary my-1">Back</a>


  </div>

@endsection
