<article class="card mb-3"  data-id="{{ $post->id }}" >
    <div class="card-body ">
        <div class="row mb-2 justify-content-end">
            <div class="col-sm-3 col-md-3  " style="text-align:end">
                <span class="badge badge-primary tag p-1">{{$post->category}}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-1 " style="margin-right:1rem;">
            <a href="../pages/otherProfile.php"><img class="" src="https://writestylesonline.com/wp-content/uploads/2016/08/Follow-These-Steps-for-a-Flawless-Professional-Profile-Picture.jpg" alt="profile pic" width="40" height="40" style="border-radius: 50%;"></a>
            </div>
            <div class="col-10">
                <h4 class="card-title text-primary">{{$post->title}}</h4>
            </div>

        </div>

        <h6 class="card-subtitle mt-2 mb-2 text-muted">By<a href="../pages/otherProfile.php">@<span>{{$post->author->username}}</span></a> on <span>{{$post->datetime}}</span></h6>
        <div class="card-text">
            <div class="row">

                <div class="col-lg-8 col-md-9 col-sm-12 mb-2">
                    <p class="mb-0">{{$post->header}}</p>
                    <a href="/post/{{$post->id}}" class="read-more">Read More</a>
                    <br>
                </div>
                {{-- <div class="col-md-4 col-xs-6 post-pic">
                    <img class="img-fluid" src="data:image/jpeg;base64,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" alt="template pic">
                </div> --}}
            </div>

        </div>

        <div class="row">
            <!-- <div class="col-sm-1 col-sm-2 actions"></i>
                <div class=" share action"><i class="fas fa-share-alt"></i></div>
            </div> -->
            <div class="col-lg-2 col-md-3 col-sm-4 mt-2">
                <div class="row justify-content-end votes text-secondary">
                    <div class="col-6 upvote"><a class="text-secondary" href=""><i class="fas fa-arrow-up"></i></a> 10 </div>
                    <div class="col-6 downvote"><a class="text-secondary" href=""><i class="fas fa-arrow-down"></i></a> 3 </div>

                </div>
            </div>
        </div>

    </div>

</article>