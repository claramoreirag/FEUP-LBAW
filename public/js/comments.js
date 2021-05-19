
    function addReply(id) {
       
        let element = document.getElementById(id);
        console.log(element);
        let rep  =element.querySelector("#form"+id);
            if(  rep.classList.contains("hidden") ){
                rep.classList.remove("hidden");
            }
            else{
                rep.classList.add("hidden");
            }
        };


        function edit(id) {
        
            let element = document.getElementById(id);
            console.log(element);
            let rep  =element.querySelector("#edit");
                 if(  rep.classList.contains("hidden") ){
                     rep.classList.remove("hidden");
                 }
                 else{
                     rep.classList.add("hidden");
                 }
         //    if(element.querySelector("#edit") == null){
         
         //    element.innerHTML = '<form id="edit" action="{{ route("edit_comment",["comment_id"=>$comment["info"]->id]) }}" method="Post"><div class="row"> <div class="col-10 px-0"><input type="text" class="form-control" value="{{$comment["info"]->id}}" ame="body" id="inputComment"></div> <input type="hidden" id="custId" name="id" value="{{$comment["info"]->id}}"> <div class="col-xs-2 col-md-1 px-0 "> <button type="submit" class="btn btn-success py-1" formaction="{{ route("edit_comment",["comment_id"=>$comment["info"]->id]) }}"><i class="fas fa-check"></i></button>@method("PUT")@csrf</div><div class="col-xs-2 col-md-1 px-0"> <button class="btn btn-secondary py-1" onclick="cancel("{{$id}}")"><i class="px-0 py-0 fas fa-times"></i></button> </div> </div> </form>';
           
         //    }
           
         };




        // var xhttp = new XMLHttpRequest();
        // xhttp.onreadystatechange = function() {
        //     if (this.readyState == 4 && this.status == 200) {
        //         let res= xhttp.responseText;
        //         let comment=JSON.parse(res);
        //         let element = document.getElementById(id);
        //     if(  element.querySelector("#reply") == null){
        //     let li = document.createElement('li')
        //     li.innerHTML = ' <form id="reply" action="{{ route("reply",["comment_id"=>$comment["info"]->id]) }}" method="Post"><div class="row"> <div class="col-10"><input type="text" class="form-control" name="body" value="{{$comment["info"]->id}}" id="inputComment"></div><input type="hidden" id="custId" name="post_id" value="{{$comment["info"]->post_id}}"><input type="hidden" id="custId" name="comment_id" value="{{$comment["info"]->id}}"><div class="col-1"><button type="submit" class="btn btn-success py-1" formaction="{{ route("reply",["comment_id"=>$comment["info"]->id]) }}">Share</button>@method("POST")@csrf</div></div></form>';
        //     let form =li.querySelector("#reply");
        //     let btn =form.querySelector("button");
        //     let route='{{ route("reply",["comment_id"=>'+comment.id+']) }}';
        //     form.setAttribute('action', route);
        //     btn.setAttribute('action',route);
        //     element.appendChild(li);
        //     }
        //     else{
        //         var rep= element.querySelector("#reply");
        //         rep.remove();
        //     }
        //     }
        // };
        // let url= "/get_comment/"+id;
        // xhttp.open("GET", url, true);
        // //xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')
        // xhttp.send();
       
       
