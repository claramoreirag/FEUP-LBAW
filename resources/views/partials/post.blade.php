
<article class="card mb-3 shadow p-2 bg-white rounded"  data-id="{{ $post->id }}" >
    <div class="card-body ">
    
        <div class="row pt-3 pb-2">
            <div class="col-1 " style="margin-right:1rem;">
            <a href="../pages/otherProfile.php"><img class="" src="{{route('avatar',['user_id'=>$post->author->id])}}" alt="profile pic" width="40" height="40" style="border-radius: 50%;"></a>
            </div>
            <div class="col-8 align-self-center">
                <h4 class="card-title text-primary mb-0">{{$post->title}}</h4>
            </div>
            <div class="col align-self-center d-flex justify-content-end">
            <span class="badge badge-primary tag p-2">{{$post->category}}</span>
            </div>
        </div>

        <h6 class="card-subtitle mt-2 mb-2 text-muted">By<a  href="/user/{{$post->author->id}}">@<span>{{$post->author->username}}</span></a> on <span>{{ date('d-m-Y', strtotime($post->datetime) )}}</span></h6>
        <div class="card-text">
            <div class="row">

            @if($post->photo!=null)
                <div class="col-lg-8 col-md-8 col-sm-6 mb-2">
              
                    <p class="mb-0">{{$post->header}}  <a href="/post/{{$post->id}}" class="read-more"> Read More</a>
                    <br></p>
                   
                </div>
                <div class="col-md-4 col-xs-6 post-pic" style="display: flex; justify-content: center; align-items: center; overflow: hidden">
                    <img class="img-thumbnail mt-2 mb-2" style="object-fit:cover; flex-shrink: 0; min-width: 100%; min-height: 100%;" src="{{route('previewpic',['post_id'=>$post->id])}}" alt="default.png">
                </div>
                @else
                <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                    
                    <p class="mb-0">{{$post->header}} <a href="/post/{{$post->id}}" class="read-more"> Read More</a>
                    <br></p>
                    
                </div>
                @endif
            </div>

        </div>

        <div class="row">
            <!-- <div class="col-sm-1 col-sm-2 actions"></i>
                <div class=" share action"><i class="fas fa-share-alt"></i></div>
            </div> -->
            <div class="col-lg-2 col-md-3 col-sm-4 mt-2">
                <div class="row justify-content-end votes text-secondary">
                    <div class="col-6 upvote"><a class="text-secondary" href="" title="Upvote"><i class="fas fa-arrow-up"></i></a> {{$post->upvotes}} </div>
                    <div class="col-6 downvote"><a class="text-secondary" href="" title="Downvote"><i class="fas fa-arrow-down"></i></a> {{$post->downvotes}} </div>

                </div>
            </div>
        </div>

    </div>

</article>