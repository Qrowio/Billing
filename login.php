<?php
session_start();
include 'includes/handler.inc.php';
$database = new Database();
$login = new Login();
$session = new Session();
$session->loggedIn();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Ethereal - Login</title>
    <link rel="icon" type="image/png" href="./assets/img/ethereal-notext.svg">
    <meta name="title" content="Ethereal - Billing Stem">
    <meta name="description" content="The new future of easy CPanel management and billing!">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/css/styles.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form method="post">
                <div class="login-div div-bg">
                    <h1 class="form-title">Sign-in</h1>
                    <p class="form-description grey">Please login to access your services. You may require email verification.<br></p>
                    <div class="input-div"><label class="form-label grey" for="email">Email Address</label><input required name="email" type="email" class="form-input" placeholder="Enter your email address..." name="email"></div>
                    <div class="input-div"><label class="form-label grey" for="password">Password</label><input required name="password" type="password" class="form-input" placeholder="Enter your password..." name="password"></div><a href="forgot.html">
                        <p class="purple forgot flink transition">Forgot your password?</p>
                    </a><button class="purple form-button transition" name="submit" type="submit">Sign In</button>
                    <p class="form-link">Or&nbsp;<a href="register.php"><span class="purple flink transition">click here to register</span></a></p>
                </div>
                </form>
            </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>