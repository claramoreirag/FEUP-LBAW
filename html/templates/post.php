<?php function drawPost($postID)
{

?>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <link rel="stylesheet" href="../style/postPreview.css"">

    <div class=" container-fluid" id="post">
    <div class="row">

        <div class="col-12">
            <div class="row justify-content-between post-header">
                <div class="col-7">
                    <div class="row">
                        <div class="col-2" id="profile-pic"><img class="" src=".././img/actors.png" alt="template pic" width="40" height="40" style="border-radius: 50%;"></div>
                        <div class="col-10" id="title">Title</div>
                    </div>
                </div>
                <div class="col-2" id="tags">Tag</div>
            </div>

            <div class="row justify-content-between post-content ">
                <div class="col-8 ">
                    <p>jhhhhhhhhhhhhh <br> gggggggggfjfjfjfjffjfjfccccccccccjf<br>ccccccccccccccccccc</p>
                </div>
                <div class="col-3 post-pic">
                    <img class="" src="" alt="template pic" width="150" height="150">
                </div>
            </div>

            <div class="row post-interactions justify-content-between">
               
                <div class="col-1 share"><i class="fas fa-share-alt"></i></div>
               
                <div class="col-3" style="margin-right:0rem; padding-right:0rem ;margin-top:0.5rem">
                    <div class="row justify-content-end votes">
                        <div class="col-6"><i class="fas fa-arrow-up"></i> x </div>
                        <div class="col-6"><i class="fas fa-arrow-down"></i> y </div>
                         
                    </div>
                </div>
            </div>


        </div>

    </div>
    </div>

<?php } ?>