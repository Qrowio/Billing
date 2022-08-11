<?php
session_start();
include '../includes/handler.inc.php';
$session = new Session();
$session->dashboard();
$database = new Database();
$sql = $database->pullServices();
$statement = $database->userInfo();
$settings = new Settings();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Ethereal - Dashboard</title>
    <link rel="icon" type="image/png" href="../assets/img/ethereal-notext.svg">
    <meta name="title" content="Ethereal - Billing Stem">
    <meta name="description" content="The new future of easy CPanel management and billing!">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="../assets/css/styles.min.css">
</head>

<body>
    <nav class="navbar navbar-light navbar-expand-md py-3">
        <div class="container"><button data-bs-toggle="collapse" class="navbar-toggler" data-bs-target="#navcol-1"><span class="visually-hidden">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><img class="nav-icon" src="../assets/img/dashboard%201.svg"><a class="nav-link" href="index.php">Dashboard</a></li>
                    <li class="nav-item"><img class="nav-icon" src="../assets/img/server%201.svg"><a class="nav-link" href="services.php">My Services</a></li>
                    <li class="nav-item"><img class="nav-icon" src="../assets/img/heart%20(1)%201.svg" width="20" height="43"><a class="nav-link" href="#">Tickets</a></li>
                    <li class="nav-item"><img class="nav-icon" src="../assets/img/settings%202.svg"><a class="nav-link active" href="#">Account Settings</a></li>
                </ul><img class="picture" src="../assets/img/unsplash_WNoLnJo7tS8.svg">
                <div class="dropdown"><a class="dropdown-toggle grey transition" aria-expanded="false" data-bs-toggle="dropdown" href="#"><?php echo $statement['firstname'] . " ". $statement['lastname']?></a>
                    <div class="dropdown-menu">
                        <div class="dropdown-div-top">
                            <div class="dropdown-top-content" style="display: flex;"><img class="picture" width="35" height="100%" src="../assets/img/unsplash_WNoLnJo7tS8.svg">
                                <div style="display: inline-grid;">
                                    <p class="grey dropdown-name-email"><?php echo $statement['firstname'] . " ". $statement['lastname']?></p>
                                    <p class="grey dropdown-name-email" style="font-size: 12px;"><?php echo $statement['email']?><br></p>
                                </div>
                            </div>
                        </div><a class="dropdown-item" href="settings.php"><img class="nav-icon" src="../assets/img/settings%202.svg" style="margin-right: 10px;">Account Settings</a><a class="dropdown-item" href="#"><img class="nav-icon" src="../assets/img/card.svg" style="margin-right: 10px;">Billing Information</a>
                        <hr style="color: #777777;"><a class="dropdown-item" href="logout.php"><img class="nav-icon" src="../assets/img/sign-out.svg" style="margin-right: 10px;">Sign Out</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <form method="post">
    <div class="container mt-7">
        <div class="row">
            <div class="col-md-12">
                <p class="grey panel-p">Settings</p>
                <p class="grey panel-header">User Settings</p>
                <p class="grey panel-p">Edit your account settings, be careful with what you change.<br></p>
                <hr class="settings-hr">
                <div style="display: flex;justify-content: end;"><a href="#"><button class="small-btn" onclick="history.back()" style="background: none;" type="button">Cancel</button></a><button name="save" class="purple small-btn" type="submit">Save</button></div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-xxl-5">
                <p class="settings-title">Name</p>
                <p class="settngs-desc grey">This will be displayed across the site. It will also be used in your billing statements.<br></p>
            </div>
            <div class="col-md-6 offset-xxl-1 settings-div">
                <div class="settings-3"><input type="text" name="firstName" placeholder="<?php echo $statement['firstname']?>" class="settings-small"></div>
                <div class="settings-3"><input type="text" name="lastName" placeholder="<?php echo $statement['lastname']?>" class="settings-small"></div>
            </div>
            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 offset-xxl-0">
                <hr class="settings-hr">
            </div>
            <div class="col-md-6 col-xxl-5">
                <p class="settings-title">Email</p>
                <p class="settngs-desc grey">This will be used for all email purposes. This includes password resets and order information.<br></p>
            </div>
            <div class="col-md-6 offset-xxl-1 settings-div">
                <div class="settings-3" style="width: 100%;"><input type="text" name="email" placeholder="<?php echo $statement['email']; ?>"class="settings-small" style="width: 100%!important;"></div>
                <div class="settings-3"></div>
            </div>
            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 offset-xxl-0">
                <hr class="settings-hr">
            </div>
            <div class="col-md-6 col-xxl-5">
                <p class="settings-title">Change Password</p>
                <p class="settngs-desc grey">If you need to change your password, you can feel free to do it here.<br></p>
            </div>
            <div class="col-md-6 offset-xxl-1 settings-div">
                <div class="settings-3"><input type="text" name="password" class="settings-small"></div>
                <div class="settings-3"><input type="text" name="confirm" class="settings-small"></div>
            </div>
        </div>
    </div>
</form>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>