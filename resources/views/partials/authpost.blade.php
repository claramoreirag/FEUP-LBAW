
@php
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
$already_reported=ReportController::postAlreadyReported(Auth::id(),$post->id);

$already_follow=  UserController::alreadyFollowCat($post->category);

@endphp


<div class="card mb-3 " data-id="{{ $post->id }}">
    <div class="card-body ">
        <div class="row mb-2 justify-content-end">
            <div class="col-sm-3 col-md-3  " style="text-align:end">
              @if($already_follow)
              <span class="badge badge-primary action-bg-green tag p-1" data-toggle="modal" data-target="#unfollowTag{{$post->id}}"> {{$post->category}}</span>
              @endif
              @if(!$already_follow)
              <span class="badge badge-primary action-bg-green tag p-1" data-toggle="modal" data-target="#followTag{{$post->id}}"> {{$post->category}}</span>
              @endif

                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-1 " style="margin-right:1rem;">
                <img class="" src="{{route('avatar',['user_id'=>$post->author->id])}}" alt="profile pic" width="40" height="40" style="border-radius: 50%;">
            </div>
            <div class="col-10">
                <h4 class="card-title text-primary">{{$post->title}}</h4>
            </div>

        </div>
        <h6 class="card-subtitle mt-2 mb-2 text-muted">By <a href="/user/{{$post->author->id}}"> @<span>{{$post->author->username}}</span></a> on <span>{{$post->datetime}}</span></h6>
        <div class="card-text">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                    {{$post->header}}
                    <a href="/post/{{$post->id}}" class="read-more">Read More</a>
                    <br>
                </div>
                {{-- <div class="col-md-4 col-xs-6 post-pic">
                    <img class="img-fluid" src="https://images.theconversation.com/files/374780/original/file-20201214-23-1dv2o1f.jpg?ixlib=rb-1.1.0&q=45&auto=format&w=496&fit=clip" alt="template pic">
                </div> --}}
            </div>

        </div>


        <div class="row justify-content-between text-center">
            <div class="col-md-3 col-sm-4 actions pt-3 pb-3"></i>
                <div class="row text-secondary actions">
                    <div class="col-4 share action icon"><a class="text-secondary" href="" title="Share Post"><i class="fas fa-share-alt"></i></a></div>
                    <div class="col-4 save action icon"><a class="text-secondary" href="" title="Save Post"><i class="fas fa-bookmark"></i></a></div>
                    @if($already_reported)
                    <div class="col-4 report action icon text-secondary" data-toggle="modal" data-target="#ModalAlreadyReported" title="Report Post"><i class="fas fa-exclamation-circle"></i></div>
                    @endif
                    @if(!$already_reported)
                <div class="col-4 report action icon text-secondary" data-toggle="modal" data-target="#exampleModalCenter{{$post->id}}" title="Report Post"><i class="fas fa-exclamation-circle"></i></div>
                    @endif
                </div>
            </div>
            <div class="col-xl-2 col-md-3 col-sm-4 mt-2">
                <div class="row justify-content-end votes text-secondary">
                    <div class="col-6 upvote"><a class="text-secondary" href="" title="Upvote"><i class="fas fa-arrow-up"></i></a> {{$post->upvotes}} </div>
                    <div class="col-6 downvote"><a class="text-secondary" href="" title=Downvote><i class="fas fa-arrow-down"></i></a> {{$post->downvotes}} </div>

                </div>
            </div>
        </div>

    </div>

</div>
{{-- @include('partials.reportpost_modal') --}}

<div data-id="{{ $post->id }}" class="modal fade" id="ModalAlreadyReported" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
              You already reported this post!
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" data-dismiss="modal">Ok</button>
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
          Are you sure you want to report this post?
         
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
  {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script> --}}



<div class="modal fade" id="followTag{{$post->id}}" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        
        <div class="modal-body">
          Do you want to follow this tag?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <form action="{{route('follow_cat',['user_id'=>Auth::id()])}}" method="post">
            <input type="hidden" id="category"  name="category" value="{{$post->category}}"> 
            <button class="btn btn-primary" type="submit" value="Yes" >Yes</button>
            @method('post')
            @csrf
        </form>
        </div>
      </div>
    </div>
  </div>



  <div data-id="{{ $post->id }}" class="modal fade" id="unfollowTag{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
              You already follow this tag! Do you want to unfollow?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <form action="{{route('unfollow_cat',['user_id'=>Auth::id()])}}" method="post">
                <input type="hidden" id="category"  name="category" value="{{$post->category}}"> 
                <button class="btn btn-primary" type="submit" value="Yes" >Yes</button>
                @method('delete')
                @csrf
            </form>
            </div>
          </div>
    </div>
  </div>