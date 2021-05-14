@php
//$id='replies'.$comment['info']->id;
  $id=$comment->id;
 
@endphp

<li class="row clearfix justify-content-end">
    <div class="col-md-8 post-comments " id="{{$id}}">
        <p class=""> <a  href="/user/{{$comment->user->id}}"> @<span>{{$comment->user->username}}</span></a> said: {{$comment->body}} </p>
        <form class="hidden" id="edit" action="{{ route("edit_comment",["comment_id"=>$comment->id]) }}" method="Post">
            <div class="row"> 
                <div class="col-10 px-0">
                <input type="text" class="form-control" value="{{$comment->id}}" name="body" id="inputComment">
            </div> 
            <input type="hidden" id="custId"  name="id" value="{{$comment->id}}"> 
            <input type="hidden" id="postId"  name="post_id" value="{{$comment->post_id}}"> 
            <div class="col-xs-2 col-md-1 px-0 "> 
                <button type="submit" class="btn btn-success py-1" formaction="{{ route("edit_comment",["comment_id"=>$comment->id]) }}"><i class="fas fa-check"></i></button>
                @method("PUT")@csrf
            </div>
            <div class="col-xs-2 col-md-1 px-0"> 
                <button class="btn btn-secondary py-1" onclick="cancel("{{$id}}")"><i class="px-0 py-0 fas fa-times"></i></button> 
            </div> </div> </form>
        <div class="row justify-content-between">
            <div class="col-md-5 col-sm-5">
                {{$comment->datetime}}
            
            </div>  
            <div class="col-md-5 col-sm-5 text-right">
                <div class="row justify-content-end">
                    @if($comment->user->id==Auth::id())
                    <div class="col-2 pr-1 icon" >
                        <form action="{{ route("delete_comment",["comment_id"=>$comment->id]) }}" method="Post">
                            <input type="hidden" id="postId"  name="post_id" value="{{$comment->post_id}}"> 
                            <button type="submit"  class="hiddenbutton"><i class="fas fa-trash-alt"></i></button>
                          @method("delete")@csrf
                        </form>
                    </div>
                        <div class="col-2 px-1 icon"  onclick="edit('{{$id}}')"><i class="fas fa-edit text-primary "></i></div>
                        
                    @endif
                    @if($comment->user->id!=Auth::id() && Auth::check())
                        <div class="col-2 px-1 " ><a class="text-secondary" href=""><i class="fas fa-exclamation-circle"></i></a></div>
                       
                    @endif
                </div>
            </div> 
            
            
        </div>   
    </div>
    <div class="col-md-2">

        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS_rB4VojlEI2f9u8bxiaLmoweo8oeAsROorA&usqp=CAU" class="d-none d-md-block img-responsive rounded-circle avatar" alt="">
    </div>

</li>

<script defer type="text/javascript" src="{{ URL::asset('js/comments.js') }}"></script>
