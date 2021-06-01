

<div class="container" id="fullpost">
    
    <div class="row">
        <div class="col-1 "></div>
        
        <div class="col-10 ">
            
            <div class="row post-header mt-5">
                <div class="col-md-7 col-lg-1">
                    <a class="fas fa-arrow-left" href="{{ url('/authuserfeed') }}"></a>
                </div>
                <div class="col-md-5 col-lg-11"><p class="text-end">By <a  href="/user/{{$post->author->id}}"> @<span>{{$post->author->username}}</span></a> on <span>{{ date('d-m-Y', strtotime($post->datetime)) }}</p></div>
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
                    
                
                
                    <div id="comments_holder">
                        <ul class="comments" id="comment_list">
                          @each('partials.comment', $comments, 'comment')    
                      </ul>
                      </div>
                      <div class="d-flex justify-content-center">
                   
                            <button class="see-more btn btn-primary" data-page="2" data-link="/post/{{$post->id}}/?page=" data-div="#posts">See more</button> 
                      </div>
                </div>

            </div>
        <div class="col-1"></div>
    </div>
</div>

</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
<script type="text/javascript">

$(".see-more").click(function() {
  $div = document.querySelector('#comments_holder') ; //div to append
   // console.log($div);
    $link = $(this).data('link'); //current URL
    console.log($link);
    $page = $(this).data('page'); //get the next page #
   
    $href = $link + $page; //complete URL
    $.get($href, function(response) { //append data
    let ul= document.createElement('ul');
      $html = $(response).find("#comment_list").html(); 
      ul.innerHTML=$html;
     $div.append(ul);
    });
  
    $(this).data('page', (parseInt($page) + 1)); //update page #
  });

  </script>