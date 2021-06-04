

@php
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
$already_reported=ReportController::postAlreadyReported(Auth::id(),$post->id);
$already_upvoted= UserController::alreadyUpvotedPost($post->id);
$already_downvoted= UserController::alreadyDownvotedPost($post->id);
$already_follow=  UserController::alreadyFollowCat($post->category);

@endphp

<div class="container" id="fullpost">
    
    <div class="row">
        <div class="col-1 "></div>
        
        <div class="col-10 ">
            
            <div class="row post-header mt-5">
                <div class="col-md-7 col-lg-1">
                   
                </div>
                <div class="col-md-5 col-lg-11"><p class="text-end">By <a  href="/user/{{$post->author->id}}"> @<span>{{$post->author->username}}</span></a> on <span>{{ date('d-m-Y', strtotime($post->datetime)) }}</p></div>
                <!--Imagem do avatar-->
                <!-- <div class="col-md-1 col-10"><img src="https://blog.unyleya.edu.br/wp-content/uploads/2017/12/saiba-como-a-educacao-ajuda-voce-a-ser-uma-pessoa-melhor.jpeg" class="rounded-circle avatar" alt=""></div>-->
                <hr/>
            </div>
            
            <div class="row justify-content-left">
                <div class="col-md-12 col-12">
                    <h2 class="row justify-content-between post-title"> {{$post->title}} </h2>
                  
                    <div class="row font-weight-bold mt-4 mb-4">{{$post->header}} </div>
                </div>
                
                
                    <p class="row">
                        <div class="col-md-12 ps-0 text-justify col-12"> 
                            @php
                            echo $post->body;
                            @endphp
                        </div>
                    </p>

                    
                    <h6 class="row"> Story Sources: </h6>
                    <div class="row post-font">  
                        @foreach($post->sources  as $s)
                            <a href="{{$s}}">{{$s}}</a>
                        @endforeach
                    </div>

                    <div class="row post-interactions justify-content-between mt-4">
                        <div class="col-md-2 col-sm-4 actions"></i>
                            <div class="row ">
                                <div class="col-4 share action"><i class="fas fa-share-alt"></i></div> 
                                @if($saved)
                                <div class="col-4 save action icon" id="save-post{{$post->id}}" onclick="savePost({{$post->id}})"><a class="text-secondary"  title="Save Post"><i id="bookmark{{$post->id}}" class="fas fa-bookmark"></i></a></div>
                                @endif
                                @if(!$saved)
                                <div class="col-4 save action icon" id="save-post{{$post->id}}" onclick="savePost({{$post->id}})"><a class="text-secondary"  title="Save Post"><i id="bookmark{{$post->id}}" class="far fa-bookmark"></i></a></div>
                                   
                                @endif
                            
                                @if($already_reported)
                                    <div class="col-4 report action icon text-secondary" data-toggle="modal" data-target="#ModalAlreadyReported" ><i class="fas fa-exclamation-circle"></i></div>
                                    @endif
                                    @if(!$already_reported)
                                <div class="col-4 report action icon text-secondary" data-toggle="modal" data-target="#exampleModalCenter{{$post->id}}" ><i class="fas fa-exclamation-circle"></i></div>
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


                    <script defer type="text/javascript" src="{{ URL::asset('js/comments.js') }}"></script>
                    <div class="row  post-comment">
                        <h3 class="comments-title">Comments</h3><hr/>
                        
                        <form id="comment" action="{{ route('comment',['post_id'=>$post->id]) }}" method="Post">
                            <label for="inputComment" class="form-label">Collaborate with a comment here</label>
                            <div class="row"> 
                                <div class="col-10">
                                    <input type="text" class="form-control" name="body" id="body">
                                </div>
                                <input type="hidden" id="post_id" name="post_id" value="{{$post->id}}">
                                <div class="col-2 pl-0">
                                    <button type="submit" class="btn btn-success ml-0 mb-3" formaction="{{ route('comment',['post_id'=>$post->id]) }}">Comment</button>
                                    @method('POST')
                                    @csrf
                                </div>
                            </div>
                        </form>
    
                    <div id="comments_holder">
                      <ul class="comments" id="comment_list">
                        @each('partials.comment', $comments, 'comment')    
                    </ul>
                    </div>
                    <div class="d-flex justify-content-center">
                     @if($comments->hasMorePages())
                          <button class="see-more btn btn-primary" data-page="2" data-link="/post/{{$post->id}}/?page=" data-div="#posts">See more</button> 
                    @endif
                        </div>
            </div>
        </div>
    </div>




    <div data-id="{{ $post->id }}" class="modal fade" id="ModalAlreadyReported" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
         
            <div class="modal-content">
                
                <div class="modal-body">
                  You already reported this post!
                  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                 
                  {{-- <a class="btn btn-primary" href="{{route('report_post',['post_id'=>$post->id])}}">Report</a> --}}
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
              Are you sure you want to report this user?
             
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
    
   


    <script defer type="text/javascript" src="{{ URL::asset('js/comments.js') }}"></script>
   
    <script defer type="text/javascript">
  
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

    $(".see-more").click(function() {
      $div = document.querySelector('#comments_holder') ; //div to append
       // console.log($div);
        $link = $(this).data('link'); //current URL
        console.log($link);
        $page = $(this).data('page'); //get the next page #
       
        $href = $link + $page; //complete URL
        $.get($href, function(response) { //append data
        let ul= document.createElement('ul');
          $html = $(response).find("#comment_list").html(); 
          ul.innerHTML=$html;
         $div.append(ul);
        });
      
        $(this).data('page', (parseInt($page) + 1)); //update page #
      });

        
         $('#comment').off().on('submit',function(event){
             event.preventDefault();
        
             let body = $('#body').val();
             let post_id = $('#post_id').val();
            
             let url="/post/"+post_id+"/comment";
        
             

          sendAjaxRequest('POST',url,{
                '_token': '{{csrf_token() }}',
                body:body,
                 post_id:post_id,
               
            },functionnnnn);

            function functionnnnn(){
              let response = JSON.parse(this.responseText);
            console.log(response);
                 let query="#comment_list";
                 $('#body').empty();
                  let ul=document.querySelector(query);
                  let newReply=document.createElement("div");
                  //console.log(newReply);
                  newReply.innerHTML=response.comment
                  console.log(ul);
                 ul.insertBefore(newReply,ul.firstChild);
            }

            
        
             });
    </script>

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
  
    checkVotes('{{$post->id}}');
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
     
  
    }
  
  </script>
  