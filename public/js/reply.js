
    function addReply(id) {
        var addto = "#"+id ;
       
       console.log(addto);
       let element = document.getElementById(id);
       if(  element.querySelector("#reply") == null){
       let li = document.createElement('li')
       li.innerHTML = ' <form id="reply" action="{{ route("reply",["comment_id"=>$comment["info"]->id]) }}" method="Post"><label for="inputComment" class="form-label">Collaborate with a comment here</label><div class="row"> <div class="col-11"><input type="text" class="form-control" name="body" id="inputComment"></div><input type="hidden" id="custId" name="post_id" value="{{$comment["info"]->post_id}}"><input type="hidden" id="custId" name="comment_id" value="{{$comment["info"]->id}}"><div class="col-1"><button type="submit" class="btn btn-success mb-3" formaction="{{ route("reply",["comment_id"=>$comment["info"]->id]) }}">Share</button>@method("POST")@csrf</div></div></form>';
       element.appendChild(li);
       }
       else{
           var rep= element.querySelector("#reply");
           rep.remove();
       }

    }

    
