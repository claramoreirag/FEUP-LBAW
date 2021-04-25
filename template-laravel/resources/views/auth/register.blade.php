@extends('layouts.main_header')
@section('content')
<div class="container">
    <div class="row layout align-items-center">
        <div class="col-md-4 col-sm-2"></div>
        <div class="col-12 col-md-4 col-sm-8">
            <div class="row login_form">
                <div class="col-1"></div>
                <div class="col-10">
                    <h1 class="title">Sign Up</h1>
                    <form>
                        <div class="form-floating">
                            <input type="username" class="form-control" id="floatingUser" placeholder="Username" required>
                            <label for="floatingUser">Username *</label>
                        </div>
                        <div class="form-floating">
                            <input type="name" class="form-control" id="floatingName" placeholder="Name" required>
                            <label for="floatingName">Name *</label>
                        </div>
                        <div class="form-floating">
                            <input type="email" class="form-control" id="floatingEmail" placeholder="Email" required>
                            <label for="floatingEmail">Email *</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                            <label for="floatingPassword">Password *</label>
                        </div>
                        <div class="form-floating">
                            <input type="confirm_password" class="form-control" id="floatingCPassword" placeholder="Confirm Password" required>
                            <label for="floatingCPassword">Confirm Password *</label>
                        </div>

                        <button onclick="changePage()" type="submit" class="btn btn-primary">Sign Up</button>
                    </form>
                    <div class="row dividing align-items-center">
                        <div class="col-5">
                            <hr>
                        </div>
                        <div class="col-2">
                            <h5>or</h5>
                        </div>
                        <div class="col-5">
                            <hr>
                        </div>
                    </div>
                    <div class="row login_google">
                        <div class="col">
                            <button onclick="changePage()" type="submit" class="btn btn-primary">Sign Up with Google</button>
                        </div>
                    </div>
                    <div class="row align-items-center ">
                        <a class="login_link" href="../pages/login.php">Already have an account? Log In!</a>
                        <br>
                    </div>
                    <div class="col-1"></div>
                </div>

            </div>
            <div class="col-md-4 col-sm-2"></div>
        </div>
    </div>
    @endsection



<!-- @section('content')
<form method="POST" action="{{ route('register') }}">
    {{ csrf_field() }}

    <label for="name">Name</label>
    <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
    @if ($errors->has('name'))
      <span class="error">
          {{ $errors->first('name') }}
      </span>
    @endif

    <label for="email">E-Mail Address</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required>
    @if ($errors->has('email'))
      <span class="error">
          {{ $errors->first('email') }}
      </span>
    @endif

    <label for="password">Password</label>
    <input id="password" type="password" name="password" required>
    @if ($errors->has('password'))
      <span class="error">
          {{ $errors->first('password') }}
      </span>
    @endif

    <label for="password-confirm">Confirm Password</label>
    <input id="password-confirm" type="password" name="password_confirmation" required>

    <button type="submit">
      Register
    </button>
    <a class="button button-outline" href="{{ route('login') }}">Login</a>
</form> -->

