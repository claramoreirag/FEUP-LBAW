
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
            let info=element.querySelector("#comment_info"+id);
            let innerinfo=document.getElementById("inputComment"+id).value;
            console.log(innerinfo);
            let rep  =element.querySelector("#edit"+id);
                 if(  rep.classList.contains("hidden") ){
                     rep.classList.remove("hidden");
                     info.innerHTML="";
                 }
                 else{
                     rep.classList.add("hidden");
                     info.innerHTML=innerinfo;
                 }


            
         //    if(element.querySelector("#edit") == null){
         
         //    element.innerHTML = '<form id="edit" action="{{ route("edit_comment",["comment_id"=>$comment["info"]->id]) }}" method="Post"><div class="row"> <div class="col-10 px-0"><input type="text" class="form-control" value="{{$comment["info"]->id}}" ame="body" id="inputComment"></div> <input type="hidden" id="custId" name="id" value="{{$comment["info"]->id}}"> <div class="col-xs-2 col-md-1 px-0 "> <button type="submit" class="btn btn-success py-1" formaction="{{ route("edit_comment",["comment_id"=>$comment["info"]->id]) }}"><i class="fas fa-check"></i></button>@method("PUT")@csrf</div><div class="col-xs-2 col-md-1 px-0"> <button class="btn btn-secondary py-1" onclick="cancel("{{$id}}")"><i class="px-0 py-0 fas fa-times"></i></button> </div> </div> </form>';
           
         //    }
           
         };



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


        