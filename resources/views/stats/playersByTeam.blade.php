@extends ('layouts.app')

@section('content')

  <div class="container">

    @if ($players->count() > 0)
    <h3 class=my-4>{{ __('Players in team')}} {{$players['0']->name}}</h3>

    <div class="row">

      @foreach ($players as $item)
      <div class="col-md-3 my-2">
        <div class="card profile-card-2">
          <div class="card-img-block">
            <img class="img-fluid" src="http://127.0.0.1:8000/img/football-field.jpeg" alt="Card image cap" />
          </div>
          <div class="card-body pt-5">
            <img src={{$item->urlPicture}} alt="profile-image" class="profile"/>
            <h5 class="card-title">{{$item->firstName}} {{$item->lastName}}</h5>
            <p><span class='font-weight-bold'>{{ __('Age')}}: </span>{{$item->age}}</br>
            <span class='font-weight-bold'>{{ __('Height')}}: </span>{{$item->height}}</br>
            <span class='font-weight-bold'>{{ __('Role')}}: </span>{{$item->role}}</p>
          </div>
        </div>
      </div>
    @endforeach

  @else
    <h3 class=my-4>{{ __('Nothing to show.')}}</h3>
  @endif

    </div>


  </div>

@endsection
