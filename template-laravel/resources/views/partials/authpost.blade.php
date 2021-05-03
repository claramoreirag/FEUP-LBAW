

<div class="card mb-3 " data-id="{{ $post->id }}">
    <div class="card-body ">
        <div class="row mb-2 justify-content-end">
            <div class="col-sm-3 col-md-3  " style="text-align:end">
                <span class="badge badge-primary tag p-1"> {{$post->category}}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-1 " style="margin-right:1rem;">
                <img class="" src="https://expertphotography.com/wp-content/uploads/2018/10/cool-profile-pictures-retouching-1.jpg" alt="profile pic" width="40" height="40" style="border-radius: 50%;">
            </div>
            <div class="col-10">
                <h4 class="card-title text-primary">{{$post->title}}</h4>
            </div>

        </div>

    <h6 class="card-subtitle mt-2 mb-2 text-muted">By <a  href="/ownprofile/{{$post->author->id}}"> @<span>{{$post->author->username}}</span></a> on <span>{{$post->datetime}}</span></h6>
        <div class="card-text">
            <div class="row">

                <div class="col-lg-8 col-md-9 col-sm-12 mb-2">
                    {{$post->header}}
                    <a href="/post/{{$post->id}}" class="read-more">Read More</a>
                    <br>
                </div>
                <div class="col-md-4 col-xs-6 post-pic">
                    <img class="img-fluid" src="https://images.theconversation.com/files/374780/original/file-20201214-23-1dv2o1f.jpg?ixlib=rb-1.1.0&q=45&auto=format&w=496&fit=clip" alt="template pic">
                </div>
            </div>

        </div>

    
        <div class="row justify-content-between text-center">
            <div class="col-md-3 col-sm-4 actions pt-3 pb-3"></i>
                <div class="row text-secondary actions">
                    <div class="col-4 share action icon"><a class="text-secondary" href=""><i class="fas fa-share-alt"></i></a></div>
                    <div class="col-4 save action icon"><a class="text-secondary" href=""><i class="fas fa-bookmark"></i></a></div>
                    <div class="col-4 report action icon"><a class="text-secondary" href=""><i class="fas fa-exclamation-circle"></i></a></div>
                </div>
            </div>
            <div class="col-xl-2 col-md-3 col-sm-4 mt-2">
                <div class="row justify-content-end votes text-secondary">
                    <div class="col-6 upvote"><a class="text-secondary" href=""><i class="fas fa-arrow-up"></i></a> {{$post->upvotes}} </div>
                    <div class="col-6 downvote"><a class="text-secondary" href=""><i class="fas fa-arrow-down"></i></a> {{$post->downvotes}} </div>

                </div>
            </div>
        </div>

    </div>

</div>