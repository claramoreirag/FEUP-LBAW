@php
//$id='replies'.$comment['info']->id;
  $id=$comment->id;
use App\Http\Controllers\ReportController;
$already_reported_reply=ReportController::commentAlreadyReported(Auth::id(),$comment->id);


@endphp
<li id="entireComment{{$comment->id}}" class=" clearfix">
 
    <img src="{{route('avatar',['user_id'=>$comment->user->id])}}" class="rounded-circle avatar" alt="">
    <div class="post-comments " id="{{$id}}">
        <p class="mb-0"> <a  href="/user/{{$comment->user->id}}"> @<span>{{$comment->user->username}}</span></a> replied: <span id="comment_info{{$comment->id}}"> {{$comment->body}} </span></p>
        <form class="hidden" id="edit{{$comment->id}}" action="{{ route("edit_comment",["comment_id"=>$comment->id]) }}" method="Post">
            <div class="row"> 
                <div class="col-10 px-0">
                <input type="text" class="form-control" value="{{$comment->body}}" name="body" id="inputComment{{$comment->id}}">
            </div> 
            <input type="hidden" id="comment_id{{$comment->id}}"  name="id" value="{{$comment->id}}"> 
            <input type="hidden" id="post_id{{$comment->id}}"  name="post_id" value="{{$comment->post_id}}"> 
            <div class="col-xs-2 col-md-1 px-0 "> 
                <button type="submit" class="btn btn-success py-1" formaction="{{ route("edit_comment",["comment_id"=>$comment->id]) }}"><i class="fas fa-check"></i></button>
                @method("PUT")@csrf
            </div>
            {{-- <div class="col-xs-2 col-md-1 px-0"> 
                <button class="btn btn-secondary py-1" onclick="cancel("{{$id}}")"><i class="px-0 py-0 fas fa-times"></i></button> 
            </div> --}}
         </div> </form>
        <div class="row justify-content-between">
            <div class="col-md-5 col-sm-8">
               On {{$comment->datetime}}
            
            </div>  
            <div class="col-md-5 col-sm-5 text-right">
                <div class="row justify-content-end">
                    @if($comment->user->id==Auth::id())
                    <div class="col-3 col-xs-3  pr-1 icon" >
                        <form id="delete{{$comment->id}}" action="{{ route("delete_comment",["comment_id"=>$comment->id]) }}" method="Post">
                            <input type="hidden" id="postId"  name="post_id" value="{{$comment->post_id}}"> 
                        <button type="submit"  class="hiddenbutton">d<i class="action-green green fas fa-trash-alt"></i></button>
                          @method("delete")@csrf
                        </form>
                    </div>
                        <div class="col-3 col-xs-3 px-1 icon"  onclick="edit('{{$id}}')"><i class="fas action-green fa-edit text-primary "></i></div>
                        
                    @endif
                    @if($comment->user->id!=Auth::id() && Auth::check())
                    @if($already_reported_reply)
                        <div class="col-4 report action icon text-secondary" data-toggle="modal" data-target="#alreadyReportedComment" ><i class="fas fa-exclamation-circle"></i></div>
                    @endif
                    @if(!$already_reported_reply)
                        <div class="col-2 px-1 " data-toggle="modal" data-target="#reportReply{{$comment->id}}"><i class="text-secondary action fas fa-exclamation-circle"></i></div>
                    @endif
                    
                       
                    @endif
                </div>
            </div> 
            
            
        </div>   
    </div>
 

</li>


<div data-id="{{ $comment->id }}" class="modal fade" id="reportReply{{$comment->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Report</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          
        </div>
        <div class="modal-body">
          Are you sure you want to report this reply?
         
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <form action="{{route('report_comment',['comment_id'=>$comment->id])}}" method="post">
            <button class="btn btn-primary" type="submit" value="Report" >Report</button>
            @method('post')
            @csrf
        </form>
         
        </div>
      </div>
    </div>
  </div>


<script defer type="text/javascript" src="{{ URL::asset('js/comments.js') }}"></script>


<div data-id="{{ $comment->id }}" class="modal fade" id="alreadyReportedComment" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

  <script type="text/javascript">
  
   
  
   

       $('#edit{{$comment->id}}').off().on('submit',function(event){
       event.preventDefault();
  
       let body = $('#inputComment{{$comment->id}}').val();
       let post_id = $('#post_id{{$comment->id}}').val();
       let comment_id = $('#comment_id{{$comment->id}}').val();
       let url="/comment/"+comment_id;
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
        
           let query="#edit{{$comment->id}}";
              let rep  =document.querySelector(query);
              if(  rep.classList.contains("hidden") ){
                  rep.classList.remove("hidden");
              }
              else{
                  rep.classList.add("hidden");
              }
              let element = document.getElementById("{{$comment->id}}");
              let info=element.querySelector("#comment_info{{$comment->id}}");
              info.innerHTML=response.comment;
              console.log(response);
            let ul=document.querySelector("#reply"+comment_id);
            let newReply=document.createElement("div");
            newReply.innerHTML=response.comment
            
          //  ul.insertBefore(newReply,ul.childNodes[2]);
         },
        })
        .done(function(data) {
            console.log('don')
          });
          event.preventDefault();
  
       });

       $('#delete{{$comment->id}}').off().on('submit',function(event){
     event.preventDefault();
     let url="/comment/{{$comment->id}}";
     $.ajax({
       url: url,
       type:"DELETE",
       dataType:'json',
       data:{
        "_token": "{{ csrf_token() }}",
        
       }
       ,
       success:function(response){
      
        let query="#entireComment{{$comment->id}}";
        let rep  =document.querySelector(query);
        rep.remove();
        
       },
      })
      .done(function(data) {
       
        });
        event.preventDefault();

     });
     </script>