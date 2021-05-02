
    <article class="card mb-3"  data-id="{{ $post->id }}">
        <div class="card-body ">
            <div class="row mb-2 justify-content-end">
                <div class="col-sm-3 col-md-3  " style="text-align:end">
                    <span class="badge badge-primary tag p-1">{{$post->category}}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-1 " style="margin-right:1rem;">
                    <img class="" src="../images/profilepic1.jpg" alt="profile pic" width="40" height="40" style="border-radius: 50%;">
                </div>
                <div class="col-10">
                    <h4 class="card-title text-primary">{{$post->title}}</h4>
                </div>

            </div>

            <h6 class="card-subtitle mt-2 mb-2 text-muted">By you on <span>{{$post->datetime}}</span></h6>
            <div class="card-text">
                <div class="row">

                    <div class="col-lg-8 col-md-9 col-sm-12 mb-2">
                        <p class="mb-0">{{$post->header}}</p>
                        <a href="/posts/{{$post->id}}" class="read-more">Read More</a>
                        <br>
                    </div>
                    <div class="col-md-4 col-xs-6 post-pic">
                        <img class="img-fluid" src="../images/news1.jpg" alt="template pic">
                    </div>
                </div>

            </div>

        
            <div class="row post-interactions justify-content-between ">
                <div class="col-xs-4 col-sm-4 col-md-2 actions mt-2 text-secondary pb-3"></i>
                    <div class="row actions">
                        <div class="col-md-6 col-xs-6 save action"><a href='/post/{{$post->id}}/edit' ><span class="fas fa-edit"> edit</a></div>

                    </div>
                </div>
                <div class="col-xs-4 col-sm-4 col-md-2 mt-2 text-center" >
                    <div class="row justify-content-end votes">
                        <div class="col-6 upvote"><a class="text-secondary" href=""><i class="fas fa-arrow-up"></i></a> 10 </div>
                        <div class="col-6 downvote"><a class="text-secondary" href=""><i class="fas fa-arrow-down"></i></a> 3 </div>

                    </div>
                </div>
            </div>
        </div>

    </article>