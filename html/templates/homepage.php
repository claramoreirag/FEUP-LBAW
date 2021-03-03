<?php include_once('../templates/post.php');
?>


<head>
    <link rel="stylesheet" href="../style/homepage.css"">
</head>

<body>
<div class=" container text-center">
    <div class="row ">


        <div class="col-md-7 ">

            <div class="row justify-content-between">
                <header class="col-md-3 home">
                    <h1>Home</h1>
                </header>
                <div class="col-md-3">
                    <a class="btn btn-primary " id="new-post-btn" href=""><i class="fas fa-plus"></i> New Post</a>
                </div>
            </div>
            <div>
                <?php drawPost(0) ?>
                <?php drawPost(0) ?>
                <?php drawPost(0) ?>
            </div>

        </div>





        <div class="col-md-5">

            <div class="row">
                <div class="presentation">
                    <p>GreenNews is bla bla bla
                    </p>
                    <img class="" src="" alt="template pic" width="300" height="300">
                </div>
            </div>

            <div class="row">
                <div class="input-group rounded search-container">
                    <input type="search" class="form-control rounded" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                    <span class="input-group-text border-0" id="search-addon">
                        <i class="fas fa-search"></i>
                    </span>
                </div>
                
            </div>
        </div>


        </body>
        <php?>