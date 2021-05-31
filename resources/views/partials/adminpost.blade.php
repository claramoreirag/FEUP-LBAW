<article class="card mb-3" data-id="{{ $post->id }}">
    <div class="card-body ">
        <div class="row mb-2 justify-content-end">
            <div class="col-sm-3 col-md-3  " style="text-align:end">
                <span class="badge badge-primary tag p-1">{{$post->category}}</span>
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

        <h6 class="card-subtitle mt-2 mb-2 text-muted">By {{$post->author->username}} on <span>{{$post->datetime}}</span></h6>
        <div class="card-text">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                    <p class="mb-0">{{$post->header}}</p>
                    <a href="/admin/reports/posts/{{$post->id}}" class="read-more">Read More</a>
                    <br>
                </div>
                <div class="col-md-4 col-xs-6 post-pic">
                    <!--  <img class="img-fluid" src="" alt="template pic">-->
                </div>
            </div>

        </div>


        <div class="row post-interactions justify-content-between ">
            <div class="col-10 actions mt-2 text-secondary pb-3"></i>
               
                   

            </div>
            <div class="col-2 mt-2 text-center">
                <div class="row justify-content-end votes">
                    <div class="col-6 upvote text-secondary"><i class="fas fa-arrow-up"></i> {{$post->upvotes}} </div>
                    <div class="col-6 downvote text-secondary"><i class="fas fa-arrow-down"></i> {{$post->downvotes}} </div>

                </div>
            </div>
        </div>
    </div>

</article>