    @php
        $id='replies'.$comment['info']->id;
    @endphp
@if(Auth::check())
    <li class="clearfix">
    <article class=" mb-3" >
        {{-- TODO change to profile pic --}}
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS_rB4VojlEI2f9u8bxiaLmoweo8oeAsROorA&usqp=CAU" class="rounded-circle avatar" alt="">
        <div class="post-comments">
        <p class="meta">{{$comment['info']->datetime}} <a  href="/user/{{$comment['info']->user->id}}"> @<span>{{$comment['info']->user->username}}</span></a> said:  <button  class="btn btn-primary pull-right px-1 py-0" onclick="addReply('{{$id}}')">Reply</button></p>
            <p>
                {{$comment['info']->body}}
            </p>
            @if($comment['info']->user->id==Auth::id())
                <div class="edit icon"><a class="text-secondary" href=""><i class="fas fa-trash-alt"></i></a></div>
            @endif
            @if($comment['info']->user->id!=Auth::id())
                <div class="report icon"><a class="text-secondary" href=""><i class="fas fa-exclamation-circle"></i></a></div>
            @endif
        </div>
        
    <ul class="replies" id="{{$id}}">
        @if (count($comment['replies'])>0)
            
            @each('partials.reply', $comment['replies'], 'comment')
        @endif
        </ul>

    </article>
    </li>
@endif

@if(!Auth::check())
    @php
        $id='replies'.$comment['info']->id;
    @endphp
    <li class="clearfix">
    <article class=" mb-3" >
        {{-- TODO change to profile pic --}}
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS_rB4VojlEI2f9u8bxiaLmoweo8oeAsROorA&usqp=CAU" class="rounded-circle avatar" alt="">
        <div class="post-comments">
        <p class="meta">{{$comment['info']->datetime}} <a  href="/user/{{$comment['info']->user->id}}"> @<span>{{$comment['info']->user->username}}</span></a> said: </p>
            <p>
                {{$comment['info']->body}}
            </p>
           
        </div>
        
    <ul class="replies" id="{{$id}}">
        @if (count($comment['replies'])>0)
            
            @each('partials.reply', $comment['replies'], 'comment')
        @endif
        </ul>

    </article>
    </li>
@endif


{{-- <script defer type="text/javascript" src="{{ URL::asset('js/reply.js') }}"></script> --}}
<script>
    function addReply(id) {
        var addto = "#"+id ;
       
       console.log(addto);
       let element = document.getElementById(id);
       if(  element.querySelector("#reply") == null){
       let li = document.createElement('li')
       li.innerHTML = ' <form id="reply" action="{{ route("reply",["comment_id"=>$comment["info"]->id]) }}" method="Post"><div class="row"> <div class="col-10"><input type="text" class="form-control" name="body" id="inputComment"></div><input type="hidden" id="custId" name="post_id" value="{{$comment["info"]->post_id}}"><input type="hidden" id="custId" name="comment_id" value="{{$comment["info"]->id}}"><div class="col-1"><button type="submit" class="btn btn-success py-1" formaction="{{ route("reply",["comment_id"=>$comment["info"]->id]) }}">Share</button>@method("POST")@csrf</div></div></form>';
       element.appendChild(li);
       }
       else{
           var rep= element.querySelector("#reply");
           rep.remove();
       }

    }
</script>