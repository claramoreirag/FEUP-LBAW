<?php?>

<link rel="stylesheet" href="../style/admin.css">
<link rel="stylesheet" href="../style/bootstrap.css">


<div class=" row" style="margin: 3em;">
</div>

<div class="row">
    <div class="col-1"></div>
    <div class="col-10">

        <h1 class="title">Reported Activity</h1>

        <div class="table-responsive">

            <!-- show reported things -->
            <table class="table table-hover mt-4">
                <thead>
                    <tr>
                        <th scope="col">Type</th>
                        <th scope="col">x Reported</th>
                        <th scope="col">Date</th>
                        <th scope="col">User</th>
                        <th scope="col">Content</th>
                        <th scope="col">Options</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php drawReportedPost(0); ?>
                    <?php drawReportedComment(0); ?>
                    <?php drawReportedPost(0); ?>
                    <?php drawReportedComment(0); ?>
                    <?php drawReportedPost(0); ?>
                    <?php drawReportedComment(0); ?>
                    <?php drawReportedPost(0); ?>
                    <?php drawReportedComment(0); ?>
                    <?php drawReportedPost(0); ?>
                    <?php drawReportedComment(0); ?>
                </tbody>
            </table>
        </div>

    </div>
    <div class=" col-1"></div>
</div>


<?php?>