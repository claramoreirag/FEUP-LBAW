@extends('layouts.main_header')
@include('partials.editprofile')
@section('content')

  @if ($errors->any())
  <div class="alert alert-danger">
     
          @foreach ($errors->all() as $error)
              <div>{{ $error }}</div>
          @endforeach
    
  </div>
@endif
<div class="row">
  <div class="col-lg-1 md-0"></div>
  <div class="col-lg-2 md-12" id="myInfo">
    <div class="container">
      <div class="row">
        <div class="col-12 d-flex justify-content-center" id="profileImg">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRBwgu1A5zgPSvfE83nurkuzNEoXs9DMNr8Ww&usqp=CAU" alt="profile picture">
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
      <div class="col-12" id="infoNumbers">
        <ul>
          <li> <span class="fas fa-user"></span> {{$followers}} followers </li>
          <li> <span class="fas fa-user"></span> {{$following}} following </li>
          <li> <span class="fas fa-newspaper"></span> {{$posts}} posts </li>
          <li> <span class="fas fa-arrow-up"></span> {{$upvotes}} upvotes </li>
        </ul>
      </div>
    </div>
    <div class="row">
      <div class="col-2"></div>
      <div class="col-8">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
          Edit Profile
        </button>
        <a class="btn btn-primary mt-2 ml-1 px-3" href="/post/new">New Post</a>
      </div>
      <div class="col-2"></div>
      <!--
          <a class="fas fa-edit editProfilePage" id="editProfilePage" href="../pages/editProfile.php">Edit profile</a>-->
    </div>
  </div>
  <div class="col-lg-8 md-12" id="myPosts">
    <div class="row" id="postOptions">
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" href="#posts"> My Posts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#savedposts">Saved Posts</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#upvotes">Upvotes</a>
        </li>
      </ul>
      <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active show" id="posts">
          @each('partials.ownpost', $ownposts, 'post')
        </div>
        <div class="tab-pane fade" id="savedposts">
          @each('partials.authpost', $savedPosts, 'post')
        </div>
        <div class="tab-pane fade" id="upvotes">
          @each('partials.authpost', $upvotedPosts, 'post')
        </div>
      </div>
    </div>
  </div>
  <div class="col-1"></div>
</div>
@endsection