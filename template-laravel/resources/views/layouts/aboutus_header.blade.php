<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>GreeNews</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    

    <!-- Bootstrap Css -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

<!-- Styles -->
<link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">

<!-- Bootstrap script -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous" defer></script>
    <!-- Bootstrap CSS -->


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
            <nav class="row mx-0 navbar navbar-expand-md navbar-dark bg-primary fixed-top">
                <div class="col-1"></div>
                <div class="col-10 ">
                    <div class="row justify-content-between">
                        <div class="col-4 ">
                            <h4><a class="row text-white nav-title mt-2" id="title" href="../pages/homepage.php">GreeNews</a></h4>

                                    </div>
                                    <div class="col-md-1 px-0">
                                        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                                            <span class="navbar-toggler-icon"></span>
                                    </div>


                                    <div class="col-md-5  collapse navbar-collapse justify-content-end" id="navbarNav">

                                        <a class="text-white log nav-item nav-link" href="../pages/login.php">Log In</a>
                                        <span class="text-white d-none d-md-block separator"> | </span>
                                        <a class="text-white log nav-item nav-link " href="../pages/signup.php"> Sign Up</a>


                                    </div>

                                </div>


                            </div>
                            <div class="col-1"></div>

                        </nav>

                </header>

    <section id="content">
        @yield('content')
    </section>
    
</body>

</html>