
@extends('layouts.main_header')
@include('partials.editprofile')
@include('partials.managefollow')
@section('content')

  @if ($errors->any())
  <div class="alert alert-danger">
     
          @foreach ($errors->all() as $error)
              <div>{{ $error }}</div>
          @endforeach
    
  </div>
@endif


<script>
 $(document).ready(function() {
    

    const { search } = window.location;
    const postSuccess = (new URLSearchParams(search)).get('postSuccess');
    const n = (new URLSearchParams(search)).get('n');
    if (postSuccess === '1') {
        $('#toastPost').toast('show')
        document.getElementById("linkk").setAttribute('href',"../post/"+n);
    }
  });

  $(document).ready(function(){
    console.log();
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        $('#rowTab a[href="' + activeTab + '"]').tab('show');
    }
});
</script>

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
      <div class="d-flex justify-content-center">
        <h4 id="name">
          {{$user->name}}
        </h4>
      </div>
    </div>
    <div class="row">
      <div class="d-flex justify-content-center">
        <p style="margin-bottom:0">@<span>{{$user->username}}</span></p>
      </div>
    </div>
    <div class="row" style="padding-top:0 margin-top=0">
      <div class="d-flex" id="infoNumbers" style="padding-top:0 margin-top=0">
        <ul class="list-inline mx-auto justify-content-center" style="padding-top:0 margin-top=0">
          <li><span class="fas fa-user"></span>  {{$followers}} followers </li>
          <li> <span class="fas fa-user"></span>  {{$following}} following </li>
          <li> <span class="fas fa-newspaper"></span>  {{$posts}} posts </li>
          <li> <span class="fas fa-arrow-up"></span>  {{$upvotes}} upvotes </li>
        </ul>
      </div>
    </div>
    <div class="row mt-1 mb-2">
    <div class="col-2"></div>
      <div class="col-8 d-flex justify-content-center">
        <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#exampleModal">
          Edit Profile
        </button>
      </div>
      <div class="col-2"></div>
    </div>
    <div class="row mt=1">
      <div class="col-2"></div>
        <div class="col-8 d-flex justify-content-center">
          <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#manageFollowsModal">
            Manage Followings
          </button>
        </div>
        <div class="col-2"></div>
      </div>
    </div>

 
  <div class="col-lg-8 md-12" id="myPosts">
    <div class="row" id="postOptions">
      <ul class="nav nav-tabs" id="rowTab">
        <li class="nav-item active">
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
          <div class="d-flex justify-content-center">
          
        {!! $ownposts->links() !!}
        </div>
        </div>


        <div class="tab-pane fade" id="savedposts">
          <div id="savedposts_list">
            @each('partials.switchposts', $savedPosts, 'post')
          </div>

          
    <div class="d-flex justify-content-center">
      @if($savedPosts->hasMorePages())
    <button class="see-more btn btn-primary" data-page="2" data-link="/user/{{$user->id}}/?page=" data-div="#savedposts">See more</button> 
      @endif
    </div>
          
          <div class="d-flex justify-content-center">
        
            {!! $savedPosts->links() !!}
        </div>
        </div>
        <div class="tab-pane fade" id="upvotes">
          @each('partials.authpost', $upvotedPosts, 'post')
          <div class="d-flex justify-content-center">
            {!! $upvotedPosts->links() !!}
        </div>
        </div>
       
      </div>
    </div>
  </div>
  <div class="col-1"></div>
</div>


<div id="toastPost" class="toast" style="position: absolute; top: 20; right: 40;">
    <div class="toast-header">
      <img id="suc" src="https://cdn3.iconfinder.com/data/icons/flat-actions-icons-9/792/Tick_Mark_Dark-512.png" class="rounded mr-2" alt="..." style="width: 20">
      <strong class="mr-auto">Sucess</strong>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
      Your post was created with sucess. You can see the full post <a id="linkk" href="" >here</a>.
    </div>
</div>

<a href="/post/new" class="float btn btn-secondary" style="position:fixed;
	bottom:3rem;
	right:3rem;
	box-shadow: 2px 2px 3px #999;">
New Post
</a>

@endsection



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script defer type="text/javascript" src="{{ URL::asset('js/ownprofile.js') }}" ></script>


<script defer>


  
</script>
