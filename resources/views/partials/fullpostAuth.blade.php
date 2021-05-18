

@php
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
$already_reported=ReportController::postAlreadyReported(Auth::id(),$post->id);

$already_follow=  UserController::alreadyFollowCat($post->category);

@endphp

<div class="container" id="fullpost">
    
    <div class="row">
        <div class="col-1 "></div>
        
        <div class="col-10 ">
            
            <div class="row post-header mt-5">
                <div class="col-md-7 col-lg-1">
                    <a class="fas fa-arrow-left" href="{{ url('/authuserfeed') }}"></a>
                </div>
                <div class="col-md-5 col-lg-11"><p class="text-end">By <a  href="/user/{{$post->author->id}}"> @<span>{{$post->author->username}}</span></a> on <span>{{$post->datetime}}</p></div>
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
                                <div class="col-4 share action"><i class="fas fa-share-alt"></i></div>
                                <div class="col-4 save action"><i class="fas fa-bookmark"></i></div>
                                @if($already_reported)
                                    <div class="col-4 report action icon text-secondary" data-toggle="modal" data-target="#ModalAlreadyReported" ><i class="fas fa-exclamation-circle"></i></div>
                                    @endif
                                    @if(!$already_reported)
                                <div class="col-4 report action icon text-secondary" data-toggle="modal" data-target="#exampleModalCenter{{$post->id}}" ><i class="fas fa-exclamation-circle"></i></div>
                                    @endif
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-3 col-sm-4" style="margin: 0.5rem 0rem; padding:0rem ;">
                            <div class="row justify-content-end votes">
                                <div class="col-6 upvote"><i class="fas fa-arrow-up"></i>  {{$post->upvotes}} </div>
                                <div class="col-6 downvote"><i class="fas fa-arrow-down"></i> {{$post->downvotes}} </div>
                                
                            </div>
                        </div>
                    </div>


                    <div class="row  post-comment">
                        <h3 class="comments-title">Comments</h3><hr/>
                        
                        <form action="{{ route('comment',['post_id'=>$post->id]) }}" method="Post">
                            <label for="inputComment" class="form-label">Collaborate with a comment here</label>
                            <div class="row"> 
                                <div class="col-11">
                                    <input type="text" class="form-control" name="body" id="inputComment">
                                </div>
                                <input type="hidden" id="custId" name="post_id" value="{{$post->id}}">
                                <div class="col-1">
                                    <button type="submit" class="btn btn-success mb-3" formaction="{{ route('comment',['post_id'=>$post->id]) }}">Share</button>
                                    @method('POST')
                                    @csrf
                                </div>
                            </div>
                        </form>
    
                    
                        <ul class="comments">
                            @each('partials.comment', $comments, 'comment')    
                        </ul>
                    </div>
            </div>
        </div>
    </div>




    <div data-id="{{ $post->id }}" class="modal fade" id="ModalAlreadyReported" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
         
    
        
            <div class="modal-content">
                
                <div class="modal-body">
                  You already reported this post!
                  
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
                 
                  {{-- <a class="btn btn-primary" href="{{route('report_post',['post_id'=>$post->id])}}">Report</a> --}}
                </div>
              </div>
           
    
           
        </div>
      </div>
    
    <div data-id="{{ $post->id }}" class="modal fade" id="exampleModalCenter{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Report</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              
            </div>
            <div class="modal-body">
              Are you sure you want to report this user?
             
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <form action="{{route('report_post',['post_id'=>$post->id])}}" method="post">
                <button class="btn btn-primary" type="submit" value="Report" >Report</button>
                @method('post')
                @csrf
            </form>
             
            </div>
          </div>
        </div>
      </div>