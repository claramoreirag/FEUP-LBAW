

@extends('layouts.auth_header')
@section('content')


<div class="container fill">
    <div class="row layout align-items-center">
        <div class="col-md-3 col-lg-4 col-sm-2"></div>
        <div class="col-12 col-md-6 col-lg-4 col-sm-8">
            <div class="row login_form mt-5">
                <div class="col-1 "></div>
                <div class="col-10 ">
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


