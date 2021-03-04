<?php?>

<link rel="stylesheet" href="../style/admin.css">

<div class="row" style="margin: 4em;"></div>

<div class="row">
    <div class="col-1"></div>
    <div class="col-10">

        <h1 class="title">Reported Activity</h1>

        <!-- show reported things -->
        <?php drawReportedPost(0);?>
        <?php drawReportedComment(0);?>

    </div>
    <div class="col-1"></div>
</div>


</body>

<?php?>