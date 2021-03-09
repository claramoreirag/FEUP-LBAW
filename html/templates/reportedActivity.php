<?php function drawReportedPost($postID)
{
?>

    <div class="row">

        <div class="col-12 col-md-10">

            <div class="row justify-content-end">
                <div class="col">
                    <p class="type_date">Post, 02/03/2021 12:57</p>
                </div>
            </div>


            <div class=" container-fluid d-flex" id="post">
                <div class="row">

                    <div class="col-12 justify-content-sm-end">

                        <div class="row justify-content-between post-header">
                            <div class="col-7">
                                <div class="row">
                                    <div class="col-1" id="profile-pic"><img class="" src="../images/profilepic1.jpg" alt="template pic" width="40" height="40" style="border-radius: 50%;"></div>
                                    <div class="col" id="title">
                                        <p>The Earth is Flat. Change my mind.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-5 col-md-4 tag-holder ">
                                <p class="btn btn-primary tags">3 x reported</p>
                            </div>
                        </div>

                        <div class="row justify-content-between post-content ">
                            <div class="col-lg-8 col-md-9 col-sm-12">
                                <p>If the world was round, then how come when I look at the horizon I see a straight line? It is clearly because the world if FLAT and anyone who says otherwise is just making you believe in a lie the government is telling us!
                                    <br>They are teaching our children that the world is round when it's all wrong!! How can we trust our teachers when they teach us LIES?! The government has been hiding this for too long and I'm here to show you the TRUTH!!
                                </p>
                            </div>
                            <div class="col-3 post-pic">
                                <img class="" src="../images/newsPics/flat_earth.png" alt="template pic" width="150" height="150">
                            </div>
                        </div>

                        <br>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-2 actions d-none d-md-flex flex-column">

            <div class="row flex-grow-1"></div>

            <div class="row justify-content-center flex-grow-1">
                <button type="button" class="btn btn-light"><i class="far fa-trash-alt"></i> Delete</button>
            </div>

            <div class="row justify-content-center flex-grow-1">
                <button type="button" class="btn btn-light"><i class="fas fa-user-clock"></i> Suspend User</button>
            </div>

            <div class="row justify-content-center flex-grow-1">
                <button type="button" class="btn btn-light"><i class="fas fa-user-slash"></i> Ban User</button>
            </div>

            <div class="row justify-content-center flex-grow-1">
                <button type="button" class="btn btn-light"><i class="far fa-check-circle"></i> Dismiss</button>
            </div>

            <div class="row flex-grow-1"></div>

        </div>
    </div>

    <div class="row actions d-md-none">

        <div class="col-6 col-sm-3 justify-content-center">
            <button type="button" class="btn btn-light"><i class="far fa-trash-alt"></i> Delete</button>
        </div>

        <div class="col-6 col-sm-3 justify-content-center">
            <button type="button" class="btn btn-light"><i class="fas fa-user-clock"></i> Suspend User</button>
        </div>

        <div class="row mt-2 mt-md-0"></div>

        <div class="col-6 col-sm-3 justify-content-center">
            <button type="button" class="btn btn-light"><i class="fas fa-user-slash"></i> Ban User</button>
        </div>

        <div class="col-6 col-sm-3 justify-content-center">
            <button type="button" class="btn btn-light"><i class="far fa-check-circle"></i> Dismiss</button>
        </div>

    </div>


<?php } ?>

<?php function drawReportedComment($commentID)
{
?>

    <div class="row">

        <div class="col-12 col-md-10">

            <div class="row justify-content-end">
                <div class="col">
                    <p class="type_date">Comment, 04/02/2021 17:34</p>
                </div>
            </div>


            <div class="container-fluid" id="post">
                <div class="row">

                    <div class="col-12 justify-content-sm-end">

                        <div class="row justify-content-between post-header">
                            <div class="col-8">
                                <div class="row">
                                    <div class="col-1" id="profile-pic"><img class="" src="../images/profilepic1.jpg" alt="template pic" width="40" height="40" style="border-radius: 50%;"></div>
                                    <div class="col-11" id="title">@diesel_is_cool</div>
                                </div>
                            </div>
                            <div class="col-4 tag-holder ">
                                <p class="btn btn-primary tags">5 x reported</p>
                            </div>
                        </div>

                        <div class="row comment-content ">
                            <div class="col">
                                <p>I would NEVER drive electric! Only women drive electric! I need to feel the POWER of my car and those Prius are never gonna give that to me!
                                    <br>I need GAS in my life! Electric is for girls and not-so-manly men!! PETROL FOR THE WIN!
                                </p>
                            </div>
                        </div>

                        <br>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-2 actions d-none d-md-flex flex-column">

            <div class="row flex-grow-1"></div>

            <div class="row justify-content-center flex-grow-1">
                <button type="button" class="btn btn-light"><i class="far fa-trash-alt"></i> Delete</button>
            </div>

            <div class="row justify-content-center flex-grow-1">
                <button type="button" class="btn btn-light"><i class="fas fa-user-clock"></i> Suspend User</button>
            </div>

            <div class="row justify-content-center flex-grow-1">
                <button type="button" class="btn btn-light"><i class="fas fa-user-slash"></i> Ban User</button>
            </div>

            <div class="row justify-content-center flex-grow-1">
                <button type="button" class="btn btn-light"><i class="far fa-check-circle"></i> Dismiss</button>
            </div>

            <div class="row flex-grow-1"></div>

        </div>
    </div>

    <div class="row actions d-md-none">

        <div class="col-6 col-sm-3 justify-content-center">
            <button type="button" class="btn btn-light"><i class="far fa-trash-alt"></i> Delete</button>
        </div>

        <div class="col-6 col-sm-3 justify-content-center">
            <button type="button" class="btn btn-light"><i class="fas fa-user-clock"></i> Suspend User</button>
        </div>

        <div class="row mt-2 mt-md-0"></div>

        <div class="col-6 col-sm-3 justify-content-center">
            <button type="button" class="btn btn-light"><i class="fas fa-user-slash"></i> Ban User</button>
        </div>

        <div class="col-6 col-sm-3 justify-content-center">
            <button type="button" class="btn btn-light"><i class="far fa-check-circle"></i> Dismiss</button>
        </div>

    </div>


<?php } ?>