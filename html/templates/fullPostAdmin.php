<?php function drawFullPostAdmin($postID)
{

?>
    <link rel="stylesheet" href="../style/bootstrap.css">

    <div class="row mt-5">
        <div class="col-3"></div>
        <div class="col-9">
            <button type="button" class="btn btn-outline-primary"><i class="far fa-trash-alt"></i> Delete</button>
            <button type="button" class="btn btn-outline-primary"><i class="fas fa-user-clock"></i> Suspend User</button>
            <button type="button" class="btn btn-outline-primary"><i class="fas fa-user-slash"></i> Ban User</button>
            <button type="button" class="btn btn-outline-primary"><i class="far fa-check-circle"></i> Dismiss</button>
        </div>
    </div>


    <div class="container" id="fullpost">

        <div class="row">
            <div class="col-1 "></div>

            <div class="col-10 ">

                <div class="row post-header mt-5">
                    <div class="col-md-7 col-2">
                        <a class="fas fa-arrow-left" href="../pages/adminDashboard.php"></a>
                    </div>
                    <div class="col-md-5 col-10">
                        <p class="text-end">22-03-2020 | 22:22h</p>
                    </div>
                    <!--Imagem do avatar-->
                    <!-- <div class="col-md-1 col-10"><img src="https://blog.unyleya.edu.br/wp-content/uploads/2017/12/saiba-como-a-educacao-ajuda-voce-a-ser-uma-pessoa-melhor.jpeg" class="rounded-circle avatar" alt=""></div>-->
                    <hr />
                </div>

                <div class="row justify-content-left">
                    <div class="col-md-12 col-12">
                        <h2 class="row justify-content-between post-title"> Low-level jets create winds of change for turbines </h2>
                        <div class="row font-weight-bold mt-4 mb-4">As one of the leading sources of clean and renewable energy, global wind power capacity has increased more than fivefold over the past decade, leading to larger turbines and pushing wind technology to its limits. </div>
                    </div>


                    <div class="row justify-content-center">
                        <p class="col-md-6 ps-0 text-justify col-12">These much larger turbines are operating in very different atmospheric layers than smaller turbines used 5-10 years ago," said Srinidhi Gadde, one of the authors of a paper in the Journal of Renewable and Sustainable Energy, from AIP Publishing, that examines the impacts of turbine height. "At these scales, local meteorology and extreme shear events, which frequently occur, can impact power production." <br>
                            Low-level jets, which are maxima in wind velocity in the lower atmosphere, are one cause for concern with growing turbines. <br>
                        </p>
                        <div class="col-md-6 align-self-center col-12"><img src="../images/news1.jpg" class="d-block w-100" alt="..."></img> </div>
                    </div>

                    <p class="row">
                    <div class="col-md-12 ps-0 text-justify col-12"> These strong, energetic wind flows can either have desirable or detrimental effects on the turbines, depending on how high the wind flows are in relation to the turbines. "A simple way to think about LLJs is to visualize them as high-velocity 'rivers' or 'streams' of wind within the atmosphere," Gadde said.<br>In their simulation of a wind farm with a 4-by-10 grid of turbines, Gadde and co-author Richard Stevens considered three different scenarios in which the LLJs were above, below, and in the middle of the turbine rotors. <br>
                        When the jets and the turbines were at the same height, the researchers found the front rows blocked wind access downstream, causing a reduction in power production in each successive row. Relative to this equal height scenario, a larger downstream energy capture was observed in both other cases, though by different mechanisms. <br>
                    </div>
                    </p>

                    <p class="row">
                    <div class="col-12 ps-0 text-justify"> For high jets, the turbulence generated in the wakes of the turbines pulls the wind from the upper atmosphere down toward the turbines in a process called downward vertical kinetic energy entrainment, leading to large amounts of power production. More surprisingly, when the jets are low, the reverse process occurs. High-velocity wind from the LLJ is pushed upward into the turbine, a previously unknown phenomenon, which the authors termed upward vertical kinetic energy entrainment. <br>
                        Gadde said he looks forward to applying this work to drive innovation and functionality to meet future power demands, which will require an even deeper understanding of events like LLJs and additional observations of these phenomena.
                        "As one of the leading renewable energy technologies, wind energy is expected to deliver major contributions to the expected growth in renewable energy production in the coming decades," he said.
                    </div>
                    </p>




                    <h6 class="row"> Story Source: </h6>
                    <div class="row post-font"> Materials provided by American Institute of Physics. Note: Content may be edited for style and length.</div>


                    <div class="row  post-comment">
                        <h3 class="comments-title">Comments</h3>
                        <hr />

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

<?php } ?>