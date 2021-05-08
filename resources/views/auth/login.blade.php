

@extends('layouts.main_header')
@section('content')


<div class="container">
    <div class="row layout align-items-center">
        <div class="col-md-3 col-lg-4 col-sm-2"></div>
        <div class="col-12 col-md-6 col-lg-4 col-sm-8">
            <div class="row login_form">
                <div class="col-1"></div>
                <div class="col-10">
                    <h1 class="title">Login</h1>
                    <form method="POST" action="{{ route('login') }}"  data-toggle="validator">
                        {{ csrf_field() }}
                        <div class="form-floating">
                            <input type="email" class="form-control" value="{{ old('email') }}" name="email" id="email" placeholder="Username" required>
                            <label for="email">Email *</label>
                            @if ($errors->has('email'))
                            <span class="error">
                                {{ $errors->first('email') }}
                            </span>
                            @endif
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                            <label for="password">Password *</label>
                            @if ($errors->has('password'))
                            <span class="error">
                                {{ $errors->first('password') }}
                            </span>
                            @endif
                        </div>

                        <button  type="submit" class="btn btn-primary">Login</button>
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
                            <button onclick="changePage()" class="btn btn-primary">Login with Google</button>
                        </div>
                    </div>
                    <div class="row align-items-center ">
                        <a class="signup_link" href="{{ route('register') }}">Don't have an account? Sign Up!</a>
                        <br>
                    </div>
                    <div class="col-1"></div>
                </div>

            </div>
            <div class="col-md-4 col-sm-2"></div>
        </div>
    </div>

    <script defer src="../js/login.js"></script>

    </body>


@endsection




<!-- @section('content')
<form method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}

    <label for="email">E-mail</label>
    <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>
    @if ($errors->has('email'))
        <span class="error">
          {{ $errors->first('email') }}
        </span>
    @endif

    <label for="password" >Password</label>
    <input id="password" type="password" name="password" required>
    @if ($errors->has('password'))
        <span class="error">
            {{ $errors->first('password') }}
        </span>
    @endif

    <label>
        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
    </label>

    <button type="submit">
        Login
    </button>
    <a class="button button-outline" href="{{ route('register') }}">Register</a>
</form>
@endsection -->
