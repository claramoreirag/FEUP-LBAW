
<article class="card mb-3 shadow p-2 mb-3 bg-white rounded" data-id="{{ $post->id }}">
    <div class="card-body ">
        <div class="row pt-3 pb-2">
            <div class="col-1 " style="margin-right:1rem;">
                <img class="" src="{{route('avatar',['user_id'=>$post->author->id])}}" alt="profile pic" width="40" height="40" style="border-radius: 50%;">
            </div>
            <div class="col-8 align-self-center">
                <h4 class="card-title text-primary mb-0">{{$post->title}}</h4>
            </div>
            <div class="col align-self-center d-flex justify-content-end">
            <span class="badge badge-primary tag p-2">{{$post->category}}</span>
            </div>

        </div>

        <h6 class="card-subtitle mt-2 mb-2 text-muted">By you on <span id="date">{{ date('d-m-Y', strtotime($post->datetime) )}}</span></h6>
        
        <div class="card-text">
            <div class="row">
                @if($post->photo!=null)
                <div class="col-lg-8 col-md-8 col-sm-6 mb-2">
                    
                    <p class="mb-0">{{$post->header}} <a href="/post/{{$post->id}}" class="read-more">  Read More</a>
                    <br></p>
                    
                </div>
                <div class="col-md-4 col-xs-6 post-pic align-top" style="display: flex; justify-content: center; align-items: center; overflow: hidden">
                    <img class="img-thumbnail mt-2 mb-2" style="object-fit:cover; min-width: 100%; min-height: 100%;" src="{{route('previewpic',['post_id'=>$post->id])}}" alt="default.png">
                </div>
                @else
                <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                   
                    <p class="mb-0">{{$post->header}} <a href="/post/{{$post->id}}" class="read-more">  Read More</a>
                    <br> </p>
                    
                </div>
                @endif
            </div>

        </div>


        <div class="row post-interactions justify-content-between ">
            <div class="col-10 actions mt-2 text-secondary pb-3"></i>
               
                    <div class="col-md-6 col-xs-6 save action"><a href='/post/{{$post->id}}/edit'><i class="fas fa-edit"></i> Edit</a></div>

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