<?php function drawReportedPost($postID)
{
?>

    <div class=" row">

        <div class="col-10">

            <div class="row justify-content-end">
                <div class="col-3">
                    <p class="type_date">Post, 02/03/2021 12:57</p>
                </div>
            </div>


            <div class=" container-fluid" id="post">
                <div class="row">

                    <div class="col-12">

                        <div class="row justify-content-between post-header">
                            <div class="col-7">
                                <div class="row">
                                    <div class="col-1" id="profile-pic"><img class="" src=".././img/actors.png" alt="template pic" width="40" height="40" style="border-radius: 50%;"></div>
                                    <div class="col-11" id="title">The Earth is Flat. Change my mind.</div>
                                </div>
                            </div>
                            <div class="col-2" id="tags">3 x reported</div>
                        </div>

                        <div class="row justify-content-between post-content ">
                            <div class="col-8 ">
                                <p>Mauris consectetur vehicula facilisis. Etiam aliquet accumsan libero, et aliquam tortor tincidunt eget. Maecenas ut feugiat velit. Aenean fringilla fermentum eros, a efficitur nibh. Aenean vulputate erat et nisi tristique iaculis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut ligula purus, iaculis quis ipsum elementum, ullamcorper condimentum lacus.
                                    <br>In id enim efficitur dolor ornare tempus. Maecenas condimentum molestie volutpat. Phasellus sagittis erat metus, eu gravida metus lacinia ac.
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

        <div class="col-2 actions d-none d-sm-flex flex-column">
            <!-- TODO: mantenho a descrição dos botões ou ficam só os icones com botões pequeninos -->

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


<?php } ?>

<?php function drawReportedComment($commentID)
{
?>

    <div class="row">

        <div class="col-10">

            <div class="row justify-content-end">
                <div class="col-3">
                    <p class="type_date">Comment, 02/03/2021 12:57</p>
                </div>
            </div>


            <div class=" container-fluid" id="post">
                <div class="row">

                    <div class="col-12">

                        <div class="row justify-content-between post-header">
                            <div class="col-7">
                                <div class="row">
                                    <div class="col-1" id="profile-pic"><img class="" src=".././img/actors.png" alt="template pic" width="40" height="40" style="border-radius: 50%;"></div>
                                    <div class="col-11" id="title">@diesel_is_cool</div>
                                </div>
                            </div>
                            <div class="col-2" id="tags">5 x reported</div>
                        </div>

                        <div class="row justify-content-between comment-content ">
                            <div class="col">
                                <p>Mauris consectetur vehicula facilisis. Etiam aliquet accumsan libero, et aliquam tortor tincidunt eget. Maecenas ut feugiat velit. Aenean fringilla fermentum eros, a efficitur nibh. Aenean vulputate erat et nisi tristique iaculis. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Ut ligula purus, iaculis quis ipsum elementum, ullamcorper condimentum lacus.
                                    <br>In id enim efficitur dolor ornare tempus. Maecenas condimentum molestie volutpat. Phasellus sagittis erat metus, eu gravida metus lacinia ac.
                                </p>
                            </div>
                        </div>

                        <br>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-2 actions d-none d-sm-flex flex-column">
            <!-- TODO: mantenho a descrição dos botões ou ficam só os icones com botões pequeninos -->

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


<?php } ?>