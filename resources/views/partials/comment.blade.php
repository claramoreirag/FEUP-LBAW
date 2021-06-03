    @php
      //$id='replies'.$comment['info']->id;
        $id=$comment['info']->id;
        $reply_id="reply".$comment['info']->id;
        use App\Http\Controllers\ReportController;
        $already_reported_comment=ReportController::commentAlreadyReported(Auth::id(),$comment['info']->id);
    @endphp

  <li id="entireComment{{$comment['info']->id}}" class="clearfix">
    <article class=" mb-3" >
        {{-- TODO change to profile pic --}}
        <img src="{{route('avatar',['user_id'=>$comment['info']->user->id])}}" class="rounded-circle img-fluid avatar" alt="">
        <div class="post-comments">
            <div class="comment_content" id="{{$id}}">
                <p class="mb-0" > <a  href="/user/{{$comment['info']->user->id}}"> @<span>{{$comment['info']->user->username}}
                </span></a> said: <span id="comment_info{{$comment['info']->id}}"> {{$comment['info']->body}}</span> </p>
              <form class="hidden" id="edit{{$comment['info']->id}}" action="{{ route("edit_comment",["comment_id"=>$comment["info"]->id]) }}" method="Post">
                        <div class="row"> 
                            <div class="col-10 pr-0">
                            <input type="text" class="form-control" value="{{$comment["info"]->body}}" name="body" id="inputComment{{$comment['info']->id}}">
                        </div> 
                        <input type="hidden" id="id"  name="id" value="{{$comment["info"]->id}}"> 
                        <input type="hidden" id="post_id"  name="post_id" value="{{$comment["info"]->post_id}}"> 
                        <div class="col-xs-2 col-md-1 px-0 "> 
                            <button type="submit" class="btn btn-success py-1" formaction="{{ route("edit_comment",["comment_id"=>$comment["info"]->id]) }}"><i class="fas fa-check"></i></button>
                            @method("PUT")@csrf
                        </div>
                        {{-- <div class="col-xs-2 col-md-1 px-0"> 
                            <button class="btn btn-secondary py-1" onclick="cancel("{{$id}}")"><i class="px-0 py-0 fas fa-times"></i></button> 
                        </div>  --}}
                    </div> </form>
            </div>
        
        <div class="row justify-content-between">
            <div class="col-md-7 col-sm-8">
               On {{$comment['info']->datetime}}
            
            </div>  
            <div class="col-md-3 col-sm-5 text-right">
                <div class="row justify-content-end">
                    @if($comment['info']->user->id==Auth::id())
                    <div class="col-3 col-xs-3 pr-1 icon" >
                        <form id="delete{{$comment['info']->id}}" action="{{ route("delete_comment",["comment_id"=>$comment["info"]->id]) }}" method="Post">
                            <input type="hidden" id="postId"  name="post_id" value="{{$comment["info"]->post_id}}"> 
                            <button type="submit"  class="hiddenbutton "><i class=" text-secodary green action-green fas fa-trash-alt"></i></button>
                          @method("delete")@csrf
                        </form>
                    </div>
                        <div class="col-3 col-xs-3 px-1 icon"  onclick="edit('{{$id}}')"><i class="fas fa-edit action-green text-primary "></i></div>
                        <div class="col-3 col-xs-3 pl-1" onclick="addReply('{{$reply_id}}')"><i class="text-primary action-green fa fa-reply"></i></div>
                    @endif
                    @if($comment['info']->user->id!=Auth::id() && Auth::check())
                        @if($already_reported_comment)
                            <div class="col-4 report action icon text-secondary" data-toggle="modal" data-target="#alreadyReportedComment" ><i class="fas fa-exclamation-circle"></i></div>
                        @endif
                        @if(!$already_reported_comment)
                            <div class="col-2 px-1 " data-toggle="modal" data-target="#reportComment{{$comment['info']->id}}"><i class="text-secondary action fas fa-exclamation-circle"></i></div>
                        @endif
                        <div class="col-3 col-xs-3 pl-1" onclick="addReply('{{$reply_id}}')"><i class="action-green text-primary fa fa-reply"></i></div>
                    @endif
                </div>
            </div> 
          
                
        </div>   
      
        </div>
        
    <ul class="replies" id="{{$reply_id}}">
    <form class="pb-3 mb-2 pt-0 hidden" id="formreply{{$comment['info']->id}}" action="{{ route("reply",["comment_id"=>$comment["info"]->id]) }}" method="POST">
            <div class="row"> 
                <div class="col-10 pr-0">
                <input type="text" class="form-control"  name="body" id="body{{$comment["info"]->id}}" >
                </div><input type="hidden" id="post_id{{$comment["info"]->id}}" name="post_id" value="{{$comment["info"]->post_id}}">
              <input type="hidden" id="comment_id{{$comment["info"]->id}}" name="comment_id" value="{{$comment["info"]->id}}">
                <div class="col-2 ">
                    <button type="submit" class="btn btn-success py-1" formaction="{{ route("reply",["comment_id"=>$comment["info"]->id]) }}">Reply</button>
                    @method("POST")@csrf
                </div>
            </div>
        </form>
        @if (count($comment['replies'])>0)
            
            @each('partials.reply', $comment['replies'], 'comment')
        @endif
        </ul>

    </article>
    </li>


    <div data-id="{{ $comment['info']->id }}" class="modal fade" id="reportComment{{$comment['info']->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Report</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              
            </div>
            <div class="modal-body">
              Are you sure you want to report this comment?
             
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <form action="{{route('report_comment',['comment_id'=>$comment['info']->id])}}" method="post">
                <button class="btn btn-primary" type="submit" value="Report" >Report</button>
                @method('post')
                @csrf
            </form>
             
            </div>
          </div>
        </div>
      </div>
    
    
    <script defer type="text/javascript" src="{{ URL::asset('js/comments.js') }}"></script>
    
    
    <div data-id="{{ $comment['info']->id }}" class="modal fade" id="alreadyReportedComment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                  You already reported this comment!
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                </div>
              </div>
        </div>
      </div>

<script defer type="text/javascript" src="{{ URL::asset('js/comments.js') }}"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

<script type="text/javascript">

 

 $('#formreply{{$comment['info']->id}}').off().on('submit',function(event){
   
     event.preventDefault();

     let body = $('#body{{$comment['info']->id}}').val();
     let post_id = $('#post_id{{$comment['info']->id}}').val();
     console.log(post_id);
     let comment_id = $('#comment_id{{$comment['info']->id}}').val();
     let url="/comment/"+comment_id+"/reply";

     $.ajax({
       url: url,
       type:"POST",
       data:{
         "_token": "{{ csrf_token() }}",
         body:body,
         comment_id:comment_id,
         post_id:post_id,
       },
       success:function(response){
      
         let query="#formreply"+comment_id;
            let rep  =document.querySelector(query);
            if(  rep.classList.contains("hidden") ){
                rep.classList.remove("hidden");
            }
            else{
                rep.classList.add("hidden");
            }
          let ul=document.querySelector("#reply"+comment_id);
          let newReply=document.createElement("div");
          console.log(newReply)
          newReply.innerHTML=response.comment
          
         ul.insertBefore(newReply,ul.childNodes[2]);
       },
      })
      .done(function(data) {
          
        });
        event.preventDefault();

     });





     $('#edit{{$comment['info']->id}}').off().on('submit',function(event){
     event.preventDefault();

     let body = $('#inputComment{{$comment['info']->id}}').val();
     let post_id = $('#post_id{{$comment['info']->id}}').val();
     let comment_id = $('#comment_id{{$comment['info']->id}}').val();
     let url="/comment/"+comment_id;
     console.log(comment_id);
    //  let comment= new Object();
    //  comment.body=body;
    //  comment.post_id=post_id;
    //  comment.comment_id=comment_id;
     $.ajax({
       url: url,
       type:"PUT",
       dataType:'json',
       data:{
        "_token": "{{ csrf_token() }}",
         body:body,
         comment_id:comment_id,
         post_id:post_id,
       }
       ,
       success:function(response){
      
         let query="#edit{{$comment['info']->id}}";
            let rep  =document.querySelector(query);
            if(  rep.classList.contains("hidden") ){
                rep.classList.remove("hidden");
            }
            else{
                rep.classList.add("hidden");
            }
            let element = document.getElementById("{{$comment['info']->id}}");
            let info=element.querySelector("#comment_info{{$comment['info']->id}}");
            info.innerHTML=response.comment;
            console.log(response);
        //   let ul=document.querySelector("#reply"+comment_id);
        //   let newReply=document.createElement("div");
        //   newReply.innerHTML=response.comment
          
        //  ul.insertBefore(newReply,ul.childNodes[2]);
       },
      })
      .done(function(data) {
          console.log('don')
        });
        event.preventDefault();

     });


     $('#delete{{$comment['info']->id}}').off().on('submit',function(event){
     event.preventDefault();
     let url="/comment/{{$comment['info']->id}}";
     $.ajax({
       url: url,
       type:"DELETE",
       dataType:'json',
       data:{
        "_token": "{{ csrf_token() }}",
        
       }
       ,
       success:function(response){
      
        let query="#entireComment{{$comment['info']->id}}";
        let rep  =document.querySelector(query);
        rep.remove();
        
       },
      })
      .done(function(data) {
       
        });
        event.preventDefault();

     });
   </script>