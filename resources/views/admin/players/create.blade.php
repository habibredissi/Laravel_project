
@extends ('layouts.app')

@section('content')

  <div class="container">

  {!! Form::open(['action' => 'AdminPlayersController@store', 'method'=>'POST']) !!}

  <div class="form-group">
    {{form::label('firstname', __('First Name'))}}
    {{form::text('firstname', '', ['class' => 'form-control'])}}
  </div>

  <div class="form-group">
    {{Form::label('lastname', __('Last Name'))}}
    {{Form::text('lastname','',['class' => 'form-control'])}}
  </div>

  <div class="form-group">
    {{Form::label('birthdate', __('Birthdate'))}}
    {{Form::date('birthdate','',['class' => 'form-control'])}}
  </div>

  <div class="form-group">
    {{Form::label('height', __('Height'))}}
    {{Form::number('height','',['class' => 'form-control'])}}
  </div>

  <div class="form-group">
    {{Form::label('urlpicture', __('Picture URL'))}}
    {{Form::text('urlpicture','',['class' => 'form-control'])}}
  </div>

  <div class="form-group">
    {{Form::label('team', __('Team'))}}
    {{Form::select('team',$data['teams'],null,['class' => 'form-control'])}}
  </div>

  <div class="form-group">
    {{Form::label('role', __('Role'))}}
    {{Form::select('role',$data['roles'],null,['class' => 'form-control'])}}
  </div>

  <div class="form-group">
    {{Form::submit( __('Add Player'),['class' => 'btn btn-primary'])}}
  </div>

  {!! Form::close() !!}

    </div>

@endsection
