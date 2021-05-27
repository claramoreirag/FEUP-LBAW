

@extends('layouts.auth_header')
@section('content')


<div class="container fill">
    <div class="row layout align-items-center">
        <div class="col-md-3 col-lg-4 col-sm-2"></div>
        <div class="col-12 col-md-6 col-lg-4 col-sm-8">
            <div class="row login_form mt-5 shadow-lg" style="background-color: #fafffd">
                <div class="col-1 "></div>
                <div class="col-10 ">
                    <h1 class="title mt-5">Login</h1>
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

                        <button  type="submit" class="btn btn-block btn-primary mt-4">Login</button>
                    </form>
                    <div class="row align-items-center mt-4 pb-5">
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


