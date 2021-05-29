@extends('layouts.main_header')

@section('content')
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
      <div class="col-3"></div>
      <div class="col-6 d-flex justify-content-center">
        <h3 id="name">
          {{$user->name}}
        </h3>
      </div>
      <div class="col-3"></div>
    </div>
    <div class="row">
      <div class="col-3"></div>
      <div class="col-6 d-flex justify-content-center">
        <h4 id="username">@<span>{{$user->username}}</span></h4>
      </div>
      <div class="col-3"></div>
    </div>
    <div class="row">
      <div class="col-1"></div>
      <div class="col-10 d-flex justify-content-center" id="followButton">
        <button type="button" class="btn btn-primary">Follow</button>
      </div>
      <div class="col-1"></div>
    </div>
    <div class="row">
      <div class="col-12" id="infoNumbers">
        <ul>
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
@endsection