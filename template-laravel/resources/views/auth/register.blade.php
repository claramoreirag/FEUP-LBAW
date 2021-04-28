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
                    <form method="POST" action="{{ route('register') }}" class="text-start" data-toggle="validator">
                      
                      {{ csrf_field() }}
                        <div class="form-floating">
                            <input type="username" class="form-control" id="username" placeholder="Username" required>
                            <label for="username">Username *</label>
                            @if ($errors->has('username'))
                              <span class="error">
                                  {{ $errors->first('username') }}
                              </span>
                            @endif
                        </div>
                        <div class="form-floating">
                            <input type="name" class="form-control" id="name" placeholder="Name" required>
                            <label for="name">Name *</label>
                            @if ($errors->has('name'))
                              <span class="error">
                                  {{ $errors->first('name') }}
                              </span>
                            @endif
                        </div>
                        <div class="form-floating">
                            <input type="email" class="form-control" id="email" placeholder="Email" required>
                            <label for="email">Email *</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" id="password" placeholder="Password" required>
                            <label for="password">Password *</label>
                        </div>
                        <div class="form-floating">
                            <input type="password" class="form-control" id="comfirmpassword" placeholder="Confirm Password" required>
                            <label for="confirmpassword">Confirm Password *</label>
                        </div>

                        <button type="submit" class="btn btn-primary">Sign Up</button>
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


