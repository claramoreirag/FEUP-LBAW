    @php
      //$id='replies'.$comment['info']->id;
        $id=$comment['info']->id;
        $reply_id="reply".$comment['info']->id;
        use App\Http\Controllers\ReportController;
        $already_reported_comment=ReportController::commentAlreadyReported(Auth::id(),$comment['info']->id);
    @endphp

    <li class="clearfix">
    <article class=" mb-3" >
        {{-- TODO change to profile pic --}}
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS_rB4VojlEI2f9u8bxiaLmoweo8oeAsROorA&usqp=CAU" class="rounded-circle img-fluid avatar" alt="">
        <div class="post-comments">
            <div class="comment_content" id="{{$id}}">
                <p class="mb-0" > <a  href="/user/{{$comment['info']->user->id}}"> @<span>{{$comment['info']->user->username}}
                </span></a> said: <span id=""> {{$comment['info']->body}}</span> </p>
                    <form class="hidden" id="edit" action="{{ route("edit_comment",["comment_id"=>$comment["info"]->id]) }}" method="Post">
                        <div class="row"> 
                            <div class="col-10 px-0">
                            <input type="text" class="form-control" value="{{$comment["info"]->body}}" name="body" id="inputComment">
                        </div> 
                        <input type="hidden" id="custId"  name="id" value="{{$comment["info"]->id}}"> 
                        <input type="hidden" id="postId"  name="post_id" value="{{$comment["info"]->post_id}}"> 
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
                        <form action="{{ route("delete_comment",["comment_id"=>$comment["info"]->id]) }}" method="Post">
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
        <form class="pb-2 hidden" id="reply" action="{{ route("reply",["comment_id"=>$comment["info"]->id]) }}" method="POST">
            <div class="row"> 
                <div class="col-10">
                    <input type="text" class="form-control" name="body" id="inputComment">
                </div><input type="hidden" id="custId" name="post_id" value="{{$comment["info"]->post_id}}">
                <input type="hidden" id="custId" name="comment_id" value="{{$comment["info"]->id}}">
                <div class="col-1">
                    <button type="submit" class="btn btn-success py-1" formaction="{{ route("reply",["comment_id"=>$comment["info"]->id]) }}">Share</button>
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
