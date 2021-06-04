

<div class="container mt-5">
 
 <div class="row">
 
     <div class="col-1 "></div>
     
     <div class="col-10 ">

     <div class="row post-comment" id="com">
            <div class="col-4">
                 <h3 >Reported Comment</h3>
            </div>
            <div class="col text-right">
                 <div class="d-flex flex-row-reverse bd-highlight">
                    <div class="m-1">
                        <button type="button" class="btn btn-outline-primary m-0" data-toggle="modal" data-target="#exampleModal"><i class="far fa-trash-alt"></i> Delete Comment</button>
                    </div>
                    <div class="m-1">
                 
                        <button type="button" class="btn btn-outline-secondary" data-dismis="examplemodal" data-toggle="modal" data-target="#susmodal" title="Suspend User"><i class="fas fa-user-clock"></i> Suspend User</button>
                    </div>
                    <div class="m-1">
                    <button type="button" class="btn btn-outline-secondary" data-dismis="examplemodal" data-toggle="modal" data-target="#banmodal" title="Ban User"><i class="fas fa-user-slash"></i> Ban User</button>
                    </div>
                </div>
                </div>
                 <ul class="comments" >
                     @each('partials.comment', $comment, 'comment')    
                 </ul>
    </div>

    <div class="col-1 "></div>
         
         <div class="row post-header mt-5">
             <div class="col-md-7 col-lg-1">
                 <a class="fas fa-arrow-left" href="/admin/reports"></a>
             </div>
             <div class="col-md-5 col-lg-11"><p class="text-end">By <a  href="/admin/users/{{$post->author->id}}"> @<span>{{$post->author->username}}</span></a> on <span>{{$post->datetime}}</p></div>
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
                             <div class="share action"><i class="fas fa-share-alt"></i></div>
                            
                         </div>
                     </div>
                     <div class="col-lg-2 col-md-3 col-sm-4" style="margin: 0.5rem 0rem; padding:0rem ;">
                         <div class="row justify-content-end votes">
                             <div class="col-6 upvote"><i class="fas fa-arrow-up"></i> 10 </div>
                             <div class="col-6 downvote"><i class="fas fa-arrow-down"></i> 3 </div>
                             
                         </div>
                     </div>
                 </div>
                 

                 <div class="row post-comment" id="com">
                 <h3 class="comments-title">Comments</h3><hr/>
             
                 <ul class="comments" >
                     @each('partials.comment', $comments, 'comment')    
                 </ul>
             </div>

         </div>
     <div class="col-1"></div>
 </div>
</div>

</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5>Are you sure?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Do you really want to delete this comment? You can undo this action on the handled reports list.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <form action="/admin/reports/posts/{{$post->id}}/{{$justcomment['info']->id}}" method="post">
             <button class="btn btn-outline-primary" type="submit"  > Delete</button>@method('post') @csrf
         </form>
      </div>
    </div>
  </div>
</div>


<div id="banmodal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Are you sure ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>The banishment of an user is not permenent, you can undo this action at any time. However all his content that was once reported will be deleted permenently. If you decide to reactivate this user again all his inoffensive will be public again. </p>
      </div>
      <div class="modal-footer">
      <form action="/admin/users/ban/{{$justcomment['info']->user_id}}" method="post">
                        <button type="submit" class="btn btn-outline-primary" title="Ban User" >Continue</button>@method('post') @csrf
                        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>


<div id="susmodal" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Are you sure?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>The suspension of an user for 21 days is not permenent, you can undo this action at any time. However all his content that was once reported will be deleted permenently. If you decide to reactivate this user again all his inoffensive will be public again. </p>
      </div>
      <div class="modal-footer">
     
      <form action="/admin/users/suspend/{{$justcomment['info']->user_id}}" method="post">
                        <button type="submit" class="btn btn-outline-primary" title="Suspend User" >Continue</button>@method('post') @csrf
                        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
  </div>
</div>
