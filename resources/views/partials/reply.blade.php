<li class="clearfix">

    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS_rB4VojlEI2f9u8bxiaLmoweo8oeAsROorA&usqp=CAU" class="rounded-circle avatar" alt="">
    <div class="post-comments">
        <p class="meta">{{$comment->datetime}} <a  href="/user/{{$comment->user->id}}"> @<span>{{$comment->user->username}}</span></a> replied: </p>
        <p>
            {{$comment->body}}
            @if($comment->user->id==Auth::id())
                <div class="edit icon"><a class="text-secondary" href=""><i class="fas fa-trash-alt"></i></a></div>
            @endif
            @if($comment->user->id!=Auth::id() && Auth::check())
                <div class="report icon"><a class="text-secondary" href=""><i class="fas fa-exclamation-circle"></i></a></div>
            @endif
           
        </p>
    </div>

</li>