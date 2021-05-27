@extends('layouts.auth_header')
@section('content')
<div class="container mt-5">
    <div class="row layout align-items-center ">
        <div class="col-md-3 col-sm-2"></div>
        <div class="col-12 col-md-6 col-sm-8 pt-5 pb-5 shadow-lg" style="background-color: #fafffd">
            <div class="row login_form">
                <div class="col-1"></div>
                <div class="col-10">
                    <h1 class="title">Sign Up</h1>
                    <form method="POST" action="{{ route('register') }}" class="text-start" data-toggle="validator">
                      {{ csrf_field() }}
                        <div class="form-floating mt-4">
                            <input type="username" name="username" class="form-control"  value="{{ old('username') }}" id="username" placeholder="Username" required>
                            <label for="username">Username *</label>
                            @if ($errors->has('username'))
                              <span class="error">
                                  {{ $errors->first('username') }}
                              </span>
                            @endif
                        </div>
                        <div class="form-floating">
                            <input type="name" name="name" class="form-control" value="{{ old('name') }}" id="name" placeholder="Name" required>
                            <label for="name">Name *</label>
                            @if ($errors->has('name'))
                              <span class="error">
                                  {{ $errors->first('name') }}
                              </span>
                            @endif
                        </div>
                        <div class="form-floating">
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" id="email" placeholder="Email" required>
                            <label for="email">Email *</label>
                            @if ($errors->has('email'))
                              <span class="error">
                                  {{ $errors->first('email') }}
                              </span>
                            @endif
                        </div>
                        <div class="form-floating">
                            <input type="password" name="password"  class="form-control" id="password" placeholder="Password" required>
                            <label for="password">Password *</label>
                            @if ($errors->has('password'))
                              <span class="error">
                                  {{ $errors->first('password') }}
                              </span>
                            @endif
                        </div>
                        <div class="form-floating">
                            <input type="password" name="password_confirmation" class="form-control" id="comfirmpassword" placeholder="Confirm Password" required>
                            <label for="confirmpassword">Confirm Password *</label>
                        </div>

                        <button type="submit" class="btn btn-block btn-primary mt-4">Sign Up</button>
                    </form>
                  
                    <div class="row align-items-center mt-4 ">
                        <a class="login_link" href="{{ route('login') }}">Already have an account? Log In!</a>
                        <br>
                    </div>
                    <div class="col-1"></div>
                </div>

            </div>
            <div class="col-md-3 col-sm-2"></div>
        </div>
    </div>
    @endsection


