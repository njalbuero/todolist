<?php

session_start();

//logged_in

if (isset($_SESSION['logged_in']) == true) {
    header("Location: index.php");
}

?>

<html>

<head>
    <title>To-do List</title>
    <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/login_style.css">
</head>

<body>

    <div class="container">
        <div id="login-options">
            <h1 class="display-1">Personal To Do List</h1>
            <p>
                <button class="btn green" type="button" data-toggle="collapse" data-target="#register" aria-expanded="false" aria-controls="collapseExample">
                    Register
                </button>
                <button class="btn purple" type="button" data-toggle="collapse" data-target="#login" aria-expanded="false" aria-controls="collapseExample">
                    Login
                </button>
            </p>
        </div>

        <div class="row">
            <div class="col-md-4 offset-md-4">
                <div class="collapse" id="register">
                    <div class="card card-body">
                        <form class = "no-margin-bottom" action="register_submit.php" method="POST">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="uName" />
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="pass" />
                            </div>
                            <div class="form-group">
                                <label>Email Address</label>
                                <input type="email" class="form-control" name="email" />
                            </div>
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" class="form-control" name="fName" />
                            </div>

                            <input type="submit" class="btn green inside-card" />
                        </form>
                    </div>
                </div>

                <div class="collapse" id="login">
                    <div class="card card-body">
                        <form class = "no-margin-bottom" action="login_submit.php" method="POST">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="uName" />
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control " name="pass" />
                            </div>
                            <input type="submit" class="btn purple inside-card" value="Log In" />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
   


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        jQuery('button').click(function(e) {
            jQuery('.collapse').collapse('hide');
        });
        $("#login").collapse('show');
    </script>
</body>

</html>