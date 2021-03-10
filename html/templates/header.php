<?php function drawMainHeader()
{
?>

    <head>
        <meta charset='utf-8'>
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <title>GreeNews</title>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <link rel="stylesheet" href="../style/bootstrap.css">


        <!-- Bootstrap CSS -->

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

        <!-- Latest compiled JavaScript -->
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


        <script src='https://kit.fontawesome.com/a076d05399.js'></script>
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">


        <script src="https://cdn.tiny.cloud/1/up85hjw3nat4fck36d4b8sga07h0hs8y6j1nkiusyctbojab/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>


    </head>

    <body>
        <header>
            <div>
                <nav class="row navbar navbar-expand-md navbar-light fixed-top " id="nav">
                    <div class="col-1"></div>
                    <div class="col-10">
                        <div class="row justify-content-between ">
                            <div class="col-4 navbar-brand">
                                <a class="row" id="title" href="../pages/homepage.php">GreeNews</a>
                                <a class="row" id="aboutus" href="../pages/aboutUs.php">About Us</a>
                            </div>
                            <div class="col-3 justify-content-between">
                                <button class="navbar-toggler menu " id="nav-btn" style=" margin-top: 0.8rem; border-width:0.15em; border-color: rgb(27, 52, 68);" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                            </div>
                            </button>
                            <div class="col-2 collapse navbar-collapse justify-content-end" id="navbarNav">

                                <a class="log nav-item nav-link" href="../pages/login.php">Sign In</a>
                                <span class="d-none d-md-block separator"> | </span>
                                <a class="log nav-item nav-link " href="../pages/signup.php"> Log In</a>


                            </div>
                        </div>
                    </div>
                    <div class="col-1"></div>
            </div>
        </header>



    <?php } ?>



    <?php function drawAuthHeader()
    {
    ?>

        <head>
            <meta charset='utf-8'>
            <meta http-equiv='X-UA-Compatible' content='IE=edge'>
            <title>GreeNews</title>
            <meta name='viewport' content='width=device-width, initial-scale=1'>
            <link rel="stylesheet" href="../style/bootstrap.css">


            <!-- Bootstrap CSS -->

            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

            <!-- Latest compiled JavaScript -->
            <!-- Optional JavaScript -->
            <!-- jQuery first, then Popper.js, then Bootstrap JS -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


            <script src='https://kit.fontawesome.com/a076d05399.js'></script>
            <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">


            <script src="https://cdn.tiny.cloud/1/up85hjw3nat4fck36d4b8sga07h0hs8y6j1nkiusyctbojab/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>


        </head>

        <body>
            <header>
                <div>
                    <!--THIS IS NEW -->
                    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                        <a class="navbar-brand" href="#">GreeNews</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarColor01">
                            <ul class="navbar-nav mr-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="../pages/homepage.php">Home
                                <span class="sr-only">(current)</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../pages/aboutUs.php">About Us</a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                                <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Separated link</a>
                                </div>
                            </li>
                            </ul>
                            <form class="form-inline my-2 my-lg-0">
                            <input class="form-control mr-sm-2" type="text" placeholder="Search">
                            <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
                            </form>
                        </div>
                    </nav>
                    
                    <!--THIS IS OLD -->

                <!--<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                        <div class="col-1"></div>
                        <div class="col-10">
                            <div class="row justify-content-between ">
                                <div class="col-4 navbar-brand">
                                    <a class="row" id="title" href="../pages/homepage.php">GreeNews</a>
                                    <a class="row" id="aboutus" href="../pages/aboutUs.php">About Us</a>
                                </div>
                                <div class="col-3 justify-content-between">
                                    <button class="navbar-toggler menu " id="nav-btn" style=" margin-top: 0.8rem; border-width:0.15em; border-color: rgb(27, 52, 68);" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                        <span class="navbar-toggler-icon"></span>
                                </div>
                                </button>
                                <div class="col-2 collapse navbar-collapse justify-content-end" id="navbarNav">

                                    <a class="log nav-item nav-link " href="#"><i class="fas fa-bell"></i> </a>
                                    <a class="log nav-item nav-link d-none d-md-block" href="../pages/myProfilePage.php">@username</a>
                                    <a class="log nav-item nav-link d-md-none " href="../pages/myProfilePage.php"> My Profile</a>
                                    <span class="d-none d-md-block separator"> | </span>
                                    <a class="log nav-item nav-link " href="../pages/homepage.php"> Sign Out</a>

                                </div>

                            </div>
                        </div>
                        <div class="col-1"></div>
                </div>
            </header>-->


        <?php } ?>




        <?php function drawAboutUsHeader()
        {
        ?>

            <head>
                <meta charset='utf-8'>
                <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                <title>GreeNews</title>
                <meta name='viewport' content='width=device-width, initial-scale=1'>
                <link rel="stylesheet" href="../style/global.css">


                <!-- Bootstrap CSS -->

                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

                <!-- Latest compiled JavaScript -->
                <!-- Optional JavaScript -->
                <!-- jQuery first, then Popper.js, then Bootstrap JS -->
                <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>


                <script src='https://kit.fontawesome.com/a076d05399.js'></script>
                <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">


                <script src="https://cdn.tiny.cloud/1/up85hjw3nat4fck36d4b8sga07h0hs8y6j1nkiusyctbojab/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>


            </head>

            <body>
                <header>
                    <div>

                    

                        <nav class="row navbar navbar-expand-md navbar-light fixed-top " id="nav">
                            <div class="col-1"></div>
                            <div class="col-10">
                                <div class="row justify-content-between ">
                                    <div class="col-4 navbar-brand">
                                        <a class="row" id="title" href="../pages/homepage.php">GreeNews</a>

                                    </div>
                                    <div class="col-3 justify-content-between">
                                        <button class="navbar-toggler menu " id="nav-btn" style=" margin-top: 0.8rem; border-width:0.15em; border-color: rgb(27, 52, 68);" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                            <span class="navbar-toggler-icon"></span>
                                    </div>
                                    </button>
                                    <div class="col-2 collapse navbar-collapse justify-content-end" id="navbarNav">

                                        <a class="log nav-item nav-link" href="../pages/login.php">Sign In</a>
                                        <span class="d-none d-md-block separator"> | </span>
                                        <a class="log nav-item nav-link " href="../pages/signup.php"> Log In</a>


                                    </div>
                                </div>
                            </div>
                            <div class="col-1"></div>
                    </div>
                </header>



            <?php } ?>