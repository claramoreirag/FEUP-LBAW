

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
                        <div class="row text-sm-right fs-6" >
                        <a data-toggle="modal" data-target="#pass" class="" href="">Forgot your password?</a>
                    
                        </div>
                        <button  type="submit" class="btn btn-block btn-primary mt-4 font-weight-bold">Login</button>
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


    <div id="sus" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Your account has been suspended</h5>
        <form action="/login" method="get">
                        <button type="submit" class="btn-close" aria-label="Close" ></button>
                    </form>
      
      </div>
      <div class="modal-body d-flex">
        
          <img class="d-flex"src="https://www.seekpng.com/png/detail/15-159331_sad-faces-clip-art-sad-face-on-black.png" width=200></img>

          
        <p class="ml-3"> Your account has been suspended for a period of 21 days. For more information please contact us via greenews_official@gmail.com. </p>
       
      </div>
     
    </div>
  </div>
</div>


  
  <div id="ban" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">You have been banned</h5>
        <form action="/login" method="get">
        <button type="submit" class="btn-close" aria-label="Close" ></button>
                    </form>
      
      </div>
      <div class="modal-body d-flex">
        
          <img class="d-flex"src="https://www.seekpng.com/png/detail/15-159331_sad-faces-clip-art-sad-face-on-black.png" width=200></img>

          
        <p class="ml-3"> You have been banned from GreeNews due to inappropriate content. For more information please contact us via greenews_official@gmail.com.</p>
       
      </div>
     
    </div>
  </div>
</div>



<div id="pass" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Password Recovery</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <label for="inputNewsTitle">E-mail</label>
                    <input type="text-box" class="form-control" name="title" id="inputNewsTitle" placeholder="email@address.com">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-block btn-outline-secondary">Send Email</button>
      </div>
    </div>
  </div>
</div>


    </body>

@endsection


