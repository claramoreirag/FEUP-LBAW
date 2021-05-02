@extends('layouts.auth_header')
@include('partials.editprofile')
@section('content')
<div class="row">
    <div class="col-lg-1 md-0"></div>
    <div class="col-lg-2 md-12" id="myInfo">
      <div class="container">
        <div class="row">
          <div class="col-12 d-flex justify-content-center" id="profileImg">
            <img src="../images/profilepic1.jpg" alt="profile picture">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-3"></div>
        <div class="col-6 d-flex justify-content-center">
          <h3 id="name">
            Alexander
          </h3>
        </div>
        <div class="col-3"></div>
      </div>
      <div class="row">
        <div class="col-3"></div>
        <div class="col-6 d-flex justify-content-center">
          <h4 id="username">
            @alex_turner505
          </h4>
        </div>
        <div class="col-3"></div>
      </div>
      <div class="row">
        <div class="col-12" id="infoNumbers">
          <ul>
            <li> <span class="fas fa-user"></span> 12 followers </li>
            <li> <span class="fas fa-user"></span> 11 following </li>
            <li> <span class="fas fa-newspaper"></span> 3 posts </li>
            <li> <span class="fas fa-arrow-up"></span> 256 upvotes </li>
          </ul>
        </div>
      </div>
      <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Edit Profile
          </button>
          <a class="btn btn-primary mt-2 ml-1 px-3" href="../pages/newPostPage.php">New Post</a>
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
            @each('partials.ownpost',$ownposts,'post')
          
          </div>
          <div class="tab-pane fade" id="savedposts">
            {{-- @include('partials.authpost')
            @include('partials.authpost')
            @include('partials.authpost')
            @include('partials.authpost') --}}
          </div>
          <div class="tab-pane fade" id="upvotes">
            {{-- @include('partials.authpost')
            @include('partials.authpost')
            @include('partials.authpost')
            @include('partials.authpost') --}}
          </div>
        </div>
      </div>
    </div>
    <div class="col-1"></div>
  </div>
@endsection
