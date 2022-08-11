<?php
session_start();
include 'includes/handler.inc.php';
$database = new Database();
$register = new Register();
$session = new Session();
$session->loggedIn();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Ethereal - Register</title>
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
                    <h1 class="form-title">Register</h1>
                    <p class="form-description grey">Welcome to our platform! To take a look at our services, please register for an account.<br></p>
                    <div class="input-div"><label class="form-label grey" for="firstname">First Name</label><input type="text" name="firstname" class="form-input" placeholder="Enter your first name..."></div>
                    <div class="input-div"><label class="form-label grey" for="surname">Last Name</label><input type="text" name="surname" class="form-input" placeholder="Enter your surname..."></div>
                    <div class="input-div"><label class="form-label grey" for="email">Email Address</label><input type="email" name="email" class="form-input" placeholder="Enter your email address..."></div>
                    <div class="input-div"><label class="form-label grey" for="password">Password</label><input type="password" name="password" class="form-input" placeholder="Enter your password..."></div>
                    <div class="input-div"><label class="form-label grey" for="confirm">Confirm Password</label><input type="password" name="confirm" class="form-input" placeholder="Confirm your password..."></div><button name="submit" type="submit" class="purple form-button transition" type="button">Register</button>
                    <p class="form-link">Or&nbsp;<a href="login.php"><span class="purple flink transition">click here to login</span></a></p>
                </div>
            </form>
            </div>
        </div>
    </div>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>