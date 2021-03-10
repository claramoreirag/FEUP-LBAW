<?php function drawFullPost($postID)
{

?>
    <link rel="stylesheet" href="../style/bootstrap.css">
    <div class="container" id="fullpost">
       
        <div class="row">
            <div class="col-md-1 col-xs-0"></div>

            <div class="col-md-10 col-xs-12">

                <div class="row post-header">
                    <div class="col-md-7 col-xs-2">
                        <a class="btn icon-arrow-left btn-back" href="../pages/homepage.php"></a>
                    </div>
                    <div class="col-md-5 col-xs-8"><p class="text-end">22-03-2020 | 22:22h</p></div><hr/>
                </div>

                <div class="row justify-content-between post-all">

                    <div class="col-md-6 col-xs-12">
                        <h2 class="row justify-content-between post-title"> Low-level jets create winds of change for turbines </h2>
                        <p class="post-newsheader">As one of the leading sources of clean and renewable energy, global wind power capacity has increased more than fivefold over the past decade, leading to larger turbines and pushing wind technology to its limits. </p>
                    </div>

                    <div class="col-md-6 col-xs-12">
                        <div class="row justify-content-between post-images"> 
                            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                                </div>
                                <div class="carousel-inner">
                                    <div class="carousel-item active">
                                        <img src="../images/news1.jpg" class="d-block w-100" alt="...">
                                    </div>
                                    <div class="carousel-item">
                                        <img src="../images/news2.jpg" class="d-block w-100 " alt="...">
                                    </div>
                                </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"  data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"  data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <p class="post-newsbody">"These much larger turbines are operating in very different atmospheric layers than smaller turbines used 5-10 years ago," said Srinidhi Gadde, one of the authors of a paper in the Journal of Renewable and Sustainable Energy, from AIP Publishing, that examines the impacts of turbine height. "At these scales, local meteorology and extreme shear events, which frequently occur, can impact power production." <br>
                                                Low-level jets, which are maxima in wind velocity in the lower atmosphere, are one cause for concern with growing turbines. These strong, energetic wind flows can either have desirable or detrimental effects on the turbines, depending on how high the wind flows are in relation to the turbines. <br>
                                                "A simple way to think about LLJs is to visualize them as high-velocity 'rivers' or 'streams' of wind within the atmosphere," Gadde said.<br>
                                                In their simulation of a wind farm with a 4-by-10 grid of turbines, Gadde and co-author Richard Stevens considered three different scenarios in which the LLJs were above, below, and in the middle of the turbine rotors. <br>
                                                When the jets and the turbines were at the same height, the researchers found the front rows blocked wind access downstream, causing a reduction in power production in each successive row. Relative to this equal height scenario, a larger downstream energy capture was observed in both other cases, though by different mechanisms. <br>
                                                For high jets, the turbulence generated in the wakes of the turbines pulls the wind from the upper atmosphere down toward the turbines in a process called downward vertical kinetic energy entrainment, leading to large amounts of power production. More surprisingly, when the jets are low, the reverse process occurs. High-velocity wind from the LLJ is pushed upward into the turbine, a previously unknown phenomenon, which the authors termed upward vertical kinetic energy entrainment. <br>
                                                Gadde said he looks forward to applying this work to drive innovation and functionality to meet future power demands, which will require an even deeper understanding of events like LLJs and additional observations of these phenomena.
                                                "As one of the leading renewable energy technologies, wind energy is expected to deliver major contributions to the expected growth in renewable energy production in the coming decades," he said. 
                        </p>

                        <div class="row post-font-title"> Story Source: </div>
                        <div class="row post-font">  Materials provided by American Institute of Physics. Note: Content may be edited for style and length.</div>

                

                        <div class="row post-interactions justify-content-between">
                            <div class="col-md-2 col-sm-4 actions"></i>
                                <div class="row ">
                                    <div class="col-4 share action"><i class="fas fa-share-alt"></i></div>
                                    <div class="col-4 save action"><i class="fas fa-bookmark"></i></div>
                                    <div class="col-4 report action"><i class="fas fa-exclamation-circle"></i></div>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-3 col-sm-4" style="margin: 0.5rem 0rem; padding:0rem ;">
                                <div class="row justify-content-end votes">
                                    <div class="col-6 upvote"><i class="fas fa-arrow-up"></i> 10 </div>
                                    <div class="col-6 downvote"><i class="fas fa-arrow-down"></i> 3 </div>
                                    
                                </div>
                            </div>
                        </div>


                    <div class="container post-comment">
                        <h3 class="comments-title">Comments</h3><hr/>

                        <form>
                            <label for="inputComment" class="form-label">Collaborate with a comment here</label>
                            <div class="row"> 
                                <div class="col-10">
                                    <input type="email" class="form-control" id="inputComment">
                                </div>
                                <div class="col-2">
                                    <button type="submit" class="btn btn-success ">Share</button>
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
                                            <p class="meta">Dec 20, 2014 <a href="#" class="commentlink">JohnDoe</a> says : <i class="pull-right"><a href="#" class="commentlink"><small>Reply</small></a></i></p>
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
    
<?php } ?>
