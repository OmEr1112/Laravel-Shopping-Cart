@extends('layouts.master')

@section('content')

<div class="row">
  <div class="col-md-4 col-md-offset-4">
  <h1>Sign Up</h1>

  @if(count($errors) > 0)
    <div class="alert alert-danger">
      @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
      @endforeach
    </div>
  @endif

  <form action="{{ route('user.signup') }}" method="post">
  {{ csrf_field() }}
    <div class="form-group">
      <label for="email">E-mail</label>
      <input class="form-control" type="email" name="email" id="email">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input class="form-control" type="password" name="password" id="password">
    </div>
    <button class="btn btn-primary" type="submit">Sign Up</button>
  </form>
  </div>
</div>

@endsection