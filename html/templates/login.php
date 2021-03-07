<?php?>

<link rel="stylesheet" href="../style/login&signup.css">


<div class="container">
<div class="row layout align-items-center">
    <div class="col-md-4 col-sm-2"></div>
    <div class="col-12 col-md-4 col-sm-8">
        <div class="row login_form">
            <div class="col-1"></div>
            <div class="col-10">
                <h1 class="title">Login</h1>
                <form>
                    <div class="form-floating">
                        <input type="username" class="form-control" id="floatingInput" placeholder="Username">
                        <label for="floatingInput">Username</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>

                    <button type="submit" class="btn btn-outline-primary">Login</button>
                </form>
                <div class="row dividing align-items-center">
                    <div class="col-5">
                        <hr>
                    </div>
                    <div class="col-2">
                        <h5>or</h5>
                    </div>
                    <div class="col-5">
                        <hr>
                    </div>
                </div>
                <div class="row login_google">
                    <div class="col">
                        <button type="submit" class="btn btn-outline-primary">Login with Google</button>
                    </div>
                </div>
                <div class="row align-items-center ">
                    <a class="signup_link" href="../pages/signup.php">Don't have an account? Sign Up!</a>
                    <br>
                </div>
                <div class="col-1"></div>
            </div>

        </div>
        <div class="col-md-4 col-sm-2"></div>
    </div>
</div>
<div class="row lower"></div>

</body>
<?php?>