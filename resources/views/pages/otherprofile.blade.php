

@extends('layouts.main_header')

@section('content')
@if($user->state == 'Active')
<div class="row">
  <div class="col-lg-1 md-0"></div>
  <div class="col-lg-2 md-12" id="myInfo">
    <div class="container">
      <div class="row">
        <div class="col-12 d-flex justify-content-center" id="profileImg">
          <img src="{{route('avatar',['user_id'=>$user->id])}}" alt="profile picture">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 d-flex justify-content-center">
        <h5 id="name">
          {{$user->name}}
        </h5>
      </div>
    </div>
    <div class="row">
      <div class="col-12 d-flex justify-content-center">
        <p id="username">@<span>{{$user->username}}</span></p>
      </div>
    </div>
    @if(Auth::check())
    <div class="row">
      <div class="col-1"></div>
      
      <div class="col-10 d-flex justify-content-center" id="followButton">
        <form action="{{route('follow',['user_id'=>$user->id])}}" method="post">
          <input type="hidden" id="followuser_id" name="user_id" value="{{$user->id}}">
          <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
          @if($follows)
          <button type="button" id="follow-btn" onclick="follow()" class="btn btn-block btn-primary">Unfollow</button>
          @endif
          @if(!$follows)
          <button type="button" id="follow-btn" onclick="follow()" class="btn btn-block btn-primary">Follow</button>
          @endif
          @method('post')
          @csrf
      </form>
      </div>
      <div class="col-1"></div>
    </div>
    @endif
    <div class="row">
      <div class="d-flex" id="infoNumbers">
        <ul class="list-inline mx-auto justify-content-center" style="padding-top:0 margin-top=0">
          <li> <span class="fas fa-user"></span> {{$followers}} followers </li>
          <li> <span class="fas fa-user"></span> {{$following}} following </li>
          <li> <span class="fas fa-newspaper"></span> {{$posts}} posts </li>
          <li> <span class="fas fa-arrow-up"></span> {{$upvotes}} upvotes </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="col-lg-8 md-12" id="myPosts">
    <div class="row" id="postOptions">
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#posts">Posts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#upvotes">Upvotes</a>
        </li>
      </ul>
      <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active show" id="posts">
          @if(Auth::check())
          @each('partials.authpost',$otherposts,'post')
          @endif
          @if(!Auth::check())
          @each('partials.post',$otherposts,'post')
          @endif
          <div class="d-flex justify-content-center">
            {!! $otherposts->links() !!}
          </div>
        </div>
        <div class="tab-pane fade" id="upvotes">
          @if(Auth::check())
            @each('partials.authpost',$upvotedPosts,'post')
          @endif
          @if(!Auth::check())
            @each('partials.post',$upvotedPosts,'post')
          @endif
          <div class="d-flex justify-content-center">
            {!! $upvotedPosts->links() !!}
        </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-1"></div>
</div>
@endif

@if($user->state == 'Suspended')

<div class="row">
  <div class="col-lg-1 md-0"></div>
  <div class="col-lg-2 md-12" id="myInfo">
    <div class="container">
      <div class="row">
        <div class="col-12 d-flex justify-content-center" id="profileImg">
          <img src="{{route('avatar',['user_id'=>$user->id])}}" alt="profile picture">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 d-flex justify-content-center">
        <h5 id="name">
          {{$user->name}}
        </h5>
      </div>
    </div>
    <div class="row">
      <div class="col-12 d-flex justify-content-center">
        <p id="username">@<span>{{$user->username}}</span></p>
      </div>
    </div>
    <div class="row">
      <div class="d-flex" id="infoNumbers">
        <ul class="list-inline mx-auto justify-content-center" style="padding-top:0 margin-top=0">
          <li> <span class="fas fa-user"></span> {{$followers}} followers </li>
          <li> <span class="fas fa-user"></span> {{$following}} following </li>
          <li> <span class="fas fa-newspaper"></span> {{$posts}} posts </li>
          <li> <span class="fas fa-arrow-up"></span> {{$upvotes}} upvotes </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="col-lg-8 md-12" id="myPosts">
    <div class="row" id="postOptions">
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#posts">Posts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#upvotes">Upvotes</a>
        </li>
      </ul>
      <div id="myTabContent" class="tab-content">

      <div class="card border-primary mb-3" style="max-width: 100%;">
  <div class="card-header">Account suspended</div>
  <div class="card-body">
    <h4 class="card-title">Account suspended</h4>
    <p class="card-text">This account is suspended. GreeNews suspends accounts which violate the GreeNews Rules. There is no content to show here.</p>
    <a href="/home" class="card-link">Back to the homepage</a>
  </div>
</div>

     
      </div>
    </div>
  </div>
  <div class="col-1"></div>
</div>
@endif


@if($user->state == 'Banned')

<div class="row">
  <div class="col-lg-1 md-0"></div>
  <div class="col-lg-2 md-12" id="myInfo">
    <div class="container">
      <div class="row">
        <div class="col-12 d-flex justify-content-center" id="profileImg">
          <img src="{{route('avatar',['user_id'=>$user->id])}}" alt="profile picture">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12 d-flex justify-content-center">
        <h5 id="name">
          {{$user->name}}
        </h5>
      </div>
    </div>
    <div class="row">
      <div class="col-12 d-flex justify-content-center">
        <p id="username">@<span>{{$user->username}}</span></p>
      </div>
    </div>
    <div class="row">
      <div class="d-flex" id="infoNumbers">
        <ul class="list-inline mx-auto justify-content-center" style="padding-top:0 margin-top=0">
          <li> <span class="fas fa-user"></span> {{$followers}} followers </li>
          <li> <span class="fas fa-user"></span> {{$following}} following </li>
          <li> <span class="fas fa-newspaper"></span> {{$posts}} posts </li>
          <li> <span class="fas fa-arrow-up"></span> {{$upvotes}} upvotes </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="col-lg-8 md-12" id="myPosts">
    <div class="row" id="postOptions">
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#posts">Posts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#upvotes">Upvotes</a>
        </li>
      </ul>
      <div id="myTabContent" class="tab-content">
      <div class="card border-primary mb-3" style="max-width: 100%;">
  <div class="card-header">Account banned</div>
  <div class="card-body">
    <h4 class="card-title">Account banned</h4>
    <p class="card-text">This account was banned. GreeNews bannes accounts which violate the GreeNews Rules. There is no content to show here.</p>
    <a href="/home" class="card-link">Back to the homepage</a>
  </div>
</div>
      </div>
    </div>
  </div>
  <div class="col-1"></div>
</div>
@endif

@endsection







<div id="toast-follow" class="toast" style="position: absolute; top: 20; right: 40;">
  <div class="toast-header">
    <img id="suc" src="https://cdn3.iconfinder.com/data/icons/flat-actions-icons-9/792/Tick_Mark_Dark-512.png" class="rounded mr-2" alt="..." style="width: 20">
    <strong class="mr-auto">Sucess</strong>
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="toast-body">
    You started following <span>{{$user->username}}</span>!
  </div>
</div>



<div id="toast-unfollow" class="toast" style="position: absolute; top: 20; right: 40;">
  <div class="toast-header">
    <img id="suc" src="https://cdn3.iconfinder.com/data/icons/flat-actions-icons-9/792/Tick_Mark_Dark-512.png" class="rounded mr-2" alt="..." style="width: 20">
    <strong class="mr-auto">Sucess</strong>
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="toast-body">
    You stopped following <span>{{$user->username}}</span>!
  </div>
</div>

<script defer type="text/javascript" src="{{ URL::asset('js/app.js') }}" ></script>
<script defer type="text/javascript" src="{{ URL::asset('js/otherprofile.js') }}" ></script>
