@extends('layouts.layout')

@section('title', 'Home - Login')

@section('content')
  
<!-- Login -->
  
  <div class="container my-container-login">
    <h2 class="text-center mb-4">Sign In</h2>
    
    <form method="POST" action="{{ route('login.post')}}">
      @csrf
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="text" class="form-control" name="email" id="email" placeholder="Enter your email">
      </div>
      @if($errors->any())
        <div class="alert alert-danger">
        @foreach($errors->all() as $error)
          <p>{{ $error }}</p>
        @endforeach
        </div>
      @endif
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
      </div>

    <button type="submit" class="btn btn-primary btn-block" id="btnSignIn">
      <span class="btn-text">Sign In</span>
      <span class="spinner-border spinner-border-sm ml-2 d-none" role="status" aria-hidden="true"></span>
    </button>
      
      <div class="text-center mt-3">
        <a href="{{ route('index')}}">Forgot your password?</a>
      </div>
    </form>
  </div>

  <!-- fin de registro -->



  <!-- Nuevo usuario registro -->
  <div class="container my-container-register">
    <p class="text-center mb-3">You don’t have a user?</p>
    <div class="text-center">
      <a href="{{ route('register')}}" class="btn btn-success">Register here</a>
    </div>
  </div>

  <!-- fin de nuevo registro -->

@endsection
