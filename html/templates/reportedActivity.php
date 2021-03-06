<?php function drawReportedPost($postID)
{
?>

    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="stylesheet" href="../style/postPreview.css"">
    
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
                                <div class="col-11" id="title">Title</div>
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
                            <img class="" src="" alt="template pic" width="150" height="150">
                        </div>
                    </div>

                    <br>
                </div>
            </div>
        </div>

    </div>

    <div class="col-2 actions">
        <div class="row" style="margin: 2em;"></div>

        <div class="row justify-content-center" style="margin: 2em;">
            <i class="far fa-trash-alt"></i>
        </div>

        <div class="row justify-content-center" style="margin: 2em;">
            <i class="fas fa-user-clock"></i>
        </div>

        <div class="row justify-content-center" style="margin: 2em;">
            <i class="fas fa-user-slash"></i>
        </div>

        <div class="row justify-content-center" style="margin: 2em;">
            <i class="far fa-check-circle"></i>
        </div>
    </div>
    </div>


<?php } ?>

<?php function drawReportedComment($commentID)
{
?>




<?php } ?>