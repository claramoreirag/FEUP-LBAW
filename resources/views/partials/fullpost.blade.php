

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
                    

                    <div class="row  post-comment">
                    <h3 class="comments-title">Comments</h3><hr/>
                    
                    <form>
                        <label for="inputComment" class="form-label">Collaborate with a comment here</label>
                        <div class="row"> 
                            <div class="col-11">
                                <input type="email" class="form-control" id="inputComment">
                            </div>
                            
                            <div class="col-1">
                                <button type="submit" class="btn btn-success mb-3">Share</button>
                            </div>
                        </div>
                    </form>

                    <ul class="comments">
                        <li class="clearfix">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS_rB4VojlEI2f9u8bxiaLmoweo8oeAsROorA&usqp=CAU" class="rounded-circle avatar" alt="">
                            <div class="post-comments">
                                <p class="meta">Dec 18, 2014 <a href="#" class="commentlink">JohnDoe</a> says : <i class="pull-right"><a href="#" class="commentlink"><small>Reply</small></a> </i></p>
                                <p>
                                    So interesting! Wow I love it!!!
                                </p>
                            </div>
                        </li>
                        <li class="clearfix">
                            <img src="https://blog.unyleya.edu.br/wp-content/uploads/2017/12/saiba-como-a-educacao-ajuda-voce-a-ser-uma-pessoa-melhor.jpeg" class="rounded-circle avatar" alt="">
                            <div class="post-comments">
                                <p class="meta">Dec 19, 2014 <a href="#" class="commentlink">JohnDoe</a> says : <i class="pull-right"><a href="#" class="commentlink"><small>Reply</small></a></i></p>
                                <p>
                                    I had no idea about this! Who else is with me?
                                </p>
                            </div>
                            <ul class="comments">
                                <li class="clearfix">
                                    <img src="https://engenharia360.com/wp-content/uploads/2019/05/esta-pessoa-nao-existe-engenharia-360-2.png" class=" rounded-circle avatar" alt="">
                                    <div class="post-comments">
                                        <p class="meta">Dec 20, 2014 <a href="#" class="commentlink">JohnDoe</a> says : <i class="pull-right"></i></p>
                                        <p>
                                            Me me me!!
                                        </p>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>

            </div>
        <div class="col-1"></div>
    </div>
</div>

</div>