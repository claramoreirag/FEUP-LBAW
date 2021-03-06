@php
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
$already_reported=ReportController::postAlreadyReported(Auth::id(),$post->id);
$already_saved=UserController::alreadySavedPost($post->id);
$already_follow=  UserController::alreadyFollowCat($post->category);
$already_upvoted= UserController::alreadyUpvotedPost($post->id);
$already_downvoted= UserController::alreadyDownvotedPost($post->id);

// var_dump($already_upvoted);
// var_dump($already_downvoted);
@endphp

<div class="card mb-3 shadow p-2 bg-white rounded" data-id="{{ $post->id }}">
    <div class="card-body ">
        <div class="row pt-3 pb-2">
            <div class="col-1 " style="margin-right:1rem;">
                <img class=""  src="{{route('avatar',['user_id'=>$post->author->id])}}" alt="profile pic" width="40" height="40" style="border-radius: 50%;">
            </div>
            <div class="col-8 align-self-center">
                <h4 class="card-title text-primary mb-0">{{$post->title}}</h4>
            </div>

            <div class="col align-self-center d-flex justify-content-end">
              @if($already_follow)
              <span class="badge badge-primary action-bg-green tag p-2" data-toggle="modal" data-target="#unfollowTag{{$post->id}}" title="Unfollow"> {{$post->category}}  <i class="fas fa-bell"></i>
</span>
              @endif
              @if(!$already_follow)
              <span class="badge badge-primary action-bg-green tag p-2" data-toggle="modal" data-target="#followTag{{$post->id}}" title="Follow"> {{$post->category}}</span>
              @endif

                </ul>
            </div>

        </div>
        <h6 class="card-subtitle mt-2 mb-2 text-muted">By <a href="/user/{{$post->author->id}}"> @<span>{{$post->author->username}}</span></a> on <span>{{ date('d-m-Y', strtotime($post->datetime) )}}</span></h6>
        <div class="card-text">
            <div class="row">
                @if($post->photo!=null)
                <div class="col-lg-8 col-md-8 col-sm-6 ">
                    <p class="mb-0">{{$post->header}}  <a href="/post/{{$post->id}}" class="read-more">  Read More</a>
                    <br></p>
                   
                </div>
                <div class="col-md-4 col-xs-6 post-pic" style="display: flex; justify-content: center; align-items: center; overflow: hidden">
                    <img class="img-thumbnail mt-2 mb-2" style="object-fit:cover; flex-shrink: 0; min-width: 100%; min-height: 100%;" src="{{route('previewpic',['post_id'=>$post->id])}}" alt="default.png">
                </div>
                @else
                <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
    
                    <p class="mb-0">{{$post->header}} <a href="/post/{{$post->id}}" class="read-more">  Read More</a>
                    <br></p>
                    
                </div>
                @endif
            </div>

        </div>


        <div class="row justify-content-between text-center">
            <div class="col-md-3 col-sm-4 actions pt-3 pb-3"></i>
                <div class="row text-secondary actions">
                <div class="col-4 share action icon" data-toggle="modal" data-target="#sharebtn" title="Share Post"><i class="fas fa-share-alt"></i></div>
                    @if($already_saved)
                <div class="col-4 save action icon" id="save-post{{$post->id}}" onclick="savePost({{$post->id}})"><a class="text-secondary"  title="Save Post"><i id="bookmark{{$post->id}}" class="fas fa-bookmark"></i></a></div>
                    @endif
                    @if(!$already_saved)
                      <div class="col-4 save action icon" id="save-post{{$post->id}}" onclick="savePost({{$post->id}})"><a class="text-secondary"  title="Save Post"><i id="bookmark{{$post->id}}" class="far fa-bookmark"></i></a></div>
                   
                    @endif
                    @if($already_reported)
                    <div class="col-4 report action icon text-secondary" data-toggle="modal" data-target="#ModalAlreadyReported" title="Report Post"><i class="fas fa-exclamation-circle"></i></div>
                    @endif
                    @if(!$already_reported)
                    <div class="col-4 report action icon text-secondary" data-toggle="modal" data-target="#exampleModalCenter{{$post->id}}" title="Report Post"><i class="fas fa-exclamation-circle"></i></div>
                    @endif
                </div>
            </div>
            <div class="col-xl-2 col-md-3 col-sm-4 mt-2">
              <div class="row justify-content-end votes text-secondary">
               
                <div class="col-6 upvote">
                  <form id="upvote{{$post->id}}" action="{{ route("post_vote",["post_id"=>$post->id]) }}" method="Post">
                    <input type="hidden" id="postId{{$post->id}}" name="post_id" value="{{$post->id}}">
                    <input type="hidden" id="is_up{{$post->id}}" name="is_up" value="true">
                    <button id="upvote_arrow{{$post->id}}" class="btn text-secondary hiddenbutton"><i class="fas fa-arrow-up"></i> <span class="number">{{$post->upvotes}}</span></button>
      
                    @method("post")@csrf
                  </form>
                </div>
                <div class="col-6 downvote">
                  <form id="downvote{{$post->id}}" action="{{ route("post_vote",["post_id"=>$post->id]) }}" method="Post">
                    <input type="hidden" id="dpostId{{$post->id}}" name="post_id" value="{{$post->id}}">
                    <input type="hidden" id="dis_up{{$post->id}}" name="is_up" value="false">
                    <button id="downvote_arrow{{$post->id}}" class="btn text-secondary hiddenbutton"><i class="fas fa-arrow-down"></i><span class="number"> {{$post->downvotes}}</span> </div></button>
                    @method("post")@csrf
                  </form>
         
              </div>
            </div>
      
        </div>

    </div>

</div>


{{-- @include('partials.reportpost_modal') --}}

<div data-id="{{ $post->id }}" class="modal fade" id="ModalAlreadyReported" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
              You already reported this post!
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
            </div>
          </div>
    </div>
  </div>



<div data-id="{{ $post->id }}" class="modal fade" id="exampleModalCenter{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Report</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          
        </div>
        <div class="modal-body">
          Are you sure you want to report this post?
         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <form action="{{route('report_post',['post_id'=>$post->id])}}" method="post">
            <button class="btn btn-primary" type="submit" value="Report" >Report</button>
            @method('post')
            @csrf
        </form>
         
        </div>
      </div>
    </div>
  </div>
    





  <div id="sharebtn" class="modal fade" id="myModel" tabindex="-1" aria-labelledby="myModelLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModelLabel">Share this news</h4> 
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>

                </button>
            </div>
            <div class="modal-body">
                <h6 class="pb-1">Share this via</h6>
                <div class="d-flex align-items-center icons"> <a href="#" class="fs-5 d-flex align-items-center justify-content-center m-2"> <span class="fab fa-facebook-f"></span> </a> <a href="#" class="fs-5 d-flex align-items-center justify-content-center m-2"> <span class="fab fa-twitter"></span> </a> <a href="#" class="fs-5 d-flex align-items-center justify-content-center m-2"> <span class="fab fa-instagram"></span> </a> <a href="#" class="fs-5 d-flex align-items-center justify-content-center m-2"> <span class="fab fa-whatsapp"></span> </a> <a href="#" class="fs-5 d-flex align-items-center justify-content-center m-2"> <span class="fab fa-telegram-plane"></span> </a> </div>
                <h6 class="pt-4 pb-1">Or copy the link</h6>
                <div class="field d-flex align-items-center justify-content-between"> <input class="form-control mr-1" type="text" placeholder="Default input" value="/post/{{$post->id}}">
                <button id="copybtn" class="btn btn-secondary">Copy</button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="followTag{{$post->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        
        <div class="modal-body">
          Do you want to follow this tag?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <form action="{{route('follow_cat',['user_id'=>Auth::id()])}}" method="post">
            <input type="hidden" id="category"  name="category" value="{{$post->category}}"> 
            <button class="btn btn-primary" type="submit" value="Yes" >Yes</button>
            @method('post')
            @csrf
        </form>
        </div>
      </div>
    </div>
  </div>



  <div data-id="{{ $post->id }}" class="modal fade" id="unfollowTag{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
              You already follow this tag! Do you want to unfollow?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <form action="{{route('unfollow_cat',['user_id'=>Auth::id()])}}" method="post">
                <input type="hidden" id="category"  name="category" value="{{$post->category}}"> 
                <button class="btn btn-primary" type="submit" value="Yes" >Yes</button>
                @method('delete')
                @csrf
            </form>
            </div>
          </div>
    </div>
  </div>


  <div id="toast-save" class="toast" style="position: absolute; top: 20; right: 40;">
    <div class="toast-header">
      
      <strong class="mr-auto">Sucess</strong>
      <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="toast-body">
      The post was successfully added to your saved posts!
    </div>
</div>

  

<div id="toast-unsave" class="toast" style="position: absolute; top: 20; right: 40;">
  <div class="toast-header">
   
    <strong class="mr-auto">Sucess</strong>
    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  <div class="toast-body">
    The post was successfully removed from your saved posts!
  </div>
</div>

<script defer type="text/javascript">



function checkVotes(id){
   let isUp="{{$already_upvoted}}";
   let isDown="{{$already_downvoted}}";
   let arrow = document.querySelector("#upvote_arrow"+id);
   let darrow = document.querySelector("#downvote_arrow"+id);
   if(isUp)arrow.classList.add("voted");
   if(isDown)darrow.classList.add("voted");
   console.log(isUp==true);
   console.log(isDown);
  }
  checkVotes({{$post->id}});

  $('#upvote{{$post->id}}').off().on('submit', function(event) {
    event.preventDefault();

    let post_id = $('#postId{{$post->id}}').val();
    let is_up = $('#is_up{{$post->id}}').val();
    console.log(is_up);
    console.log('#is_up{{$post->id}}');
    let url = '/post/' + post_id + '/vote';

    sendAjaxRequest('POST', url, {
      "_token": "{{ csrf_token() }}",
      upvote:is_up,
      post_id: post_id
    }, votePostAction);

    event.preventDefault();

  });



  $('#downvote{{$post->id}}').off().on('submit', function(event) {
    event.preventDefault();

    let post_id = $('#dpostId{{$post->id}}').val();
    let is_up = $('#dis_up{{$post->id}}').val();
    console.log(is_up);

    let url = '/post/' + post_id + '/vote';

    sendAjaxRequest('POST', url, {
      "_token": "{{ csrf_token() }}",
      upvote:is_up,
      post_id: post_id
    }, votePostAction);

    event.preventDefault();

  });

  function votePostAction() {

  console.log(this.responseText)
  let response = JSON.parse(this.responseText);
  console.log(response.success)
  let arrow = document.querySelector("#upvote_arrow"+response.id);
  let number= arrow.querySelector('.number');
  let darrow = document.querySelector("#downvote_arrow"+response.id);
  let dnumber= darrow.querySelector('.number');
  let n=parseInt(number.innerHTML);
  let dn=parseInt(dnumber.innerHTML);
    switch(response.success){
      case "new_up":
        arrow.classList.add("voted");
        number.innerHTML=n+1;
        break;
      case "remove_up":
        arrow.classList.remove("voted");
        number.innerHTML=n-1;
        break;
        case "switch_up":
          darrow.classList.remove("voted");
          dnumber.innerHTML=dn-1;
          arrow.classList.add("voted");
          number.innerHTML=n+1;
        break;
        case "new_down":
          arrow.classList.add("voted");
          dnumber.innerHTML=dn+1;
        break;
        case "remove_down":
        darrow.classList.remove("voted");
        dnumber.innerHTML=dn-1;
        break;
        case "switch_down":
          arrow.classList.remove("voted");
          number.innerHTML=n-1;
          darrow.classList.add("voted");
          dnumber.innerHTML=dn+1;
        break;

    }
   
    function encodeForAjax(data) {
            if (data == null) return null;
            return Object.keys(data).map(function(k){
              return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
            }).join('&');
          }
          
          function sendAjaxRequest(method, url, data, handler) {
            let request = new XMLHttpRequest();
          
            request.open(method, url, true);
            request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            request.addEventListener('load', handler);
            request.send(encodeForAjax(data));
          }


        function savePost(id){
            
            let post_id = id;
          
            let url="/post/"+post_id+'/save';


            sendAjaxRequest('GET',url,{
                '_token': '{{csrf_token() }}',
                post_id:post_id,
               
            },savePostAction);



       
            
        }

        function savePostAction(){
            let response = JSON.parse(this.responseText);
            console.log(response.success);
            let b=document.querySelector('#bookmark'+response.id);
            if(response.success=='true'){
                b.classList.remove('far');
                b.classList.add('fas');
                console.log(b);
                $('#toast-save').toast('show');
            }
            else{
                b.classList.remove('fas');
                b.classList.add('far');
                $('#toast-unsave').toast('show');
            }
        }

  }

</script>
