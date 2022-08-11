<?php
session_start();
include '../includes/handler.inc.php';
$session = new Session();
$session->dashboard();
$database = new Database();
$sql = $database->pullServices();
$statement = $database->userInfo();
$test = $database->serviceExpiry();
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
                    <li class="nav-item"><img class="nav-icon" src="../assets/img/dashboard%201.svg"><a class="nav-link active" href="#">Dashboard</a></li>
                    <li class="nav-item"><img class="nav-icon" src="../assets/img/server%201.svg"><a class="nav-link" href="services.php">My Services</a></li>
                    <li class="nav-item"><img class="nav-icon" src="../assets/img/heart%20(1)%201.svg" width="20" height="43"><a class="nav-link" href="#">Tickets</a></li>
                    <li class="nav-item"><img class="nav-icon" src="../assets/img/settings%202.svg"><a class="nav-link" href="settings.php">Account Settings</a></li>
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
    <div class="container mt-7">
        <div class="row">
            <div class="col-md-12">
                <p class="grey panel-p">Dashboard</p>
                <p class="grey panel-header">Welcome, <?php echo $statement['firstname'] . " ". $statement['lastname']?></p>
                <p class="grey panel-p">Welcome to the dashboard. Through here you can manage your service.</p>
            </div>
        </div>
    </div>
    <div class="container mt-45">
        <div class="row">
            <div class="col-md-4">
                <div class="div-bg stat">
                    <h1 class="number"><?php echo $statement['services'] ?></h1>
                    <p class="stat-title grey">Services</p>
                    <hr class="purple"><img class="stat-icon" src="../assets/img/server%201.svg">
                </div>
            </div>
            <div class="col-md-4">
                <div class="div-bg stat">
                    <h1 class="number"><?php echo $statement['tickets'] ?></h1>
                    <p class="stat-title grey">Tickets</p>
                    <hr class="red"><img class="stat-icon" src="../assets/img/heart%20(1)%201.svg">
                </div>
            </div>
            <div class="col-md-4">
                <div class="div-bg stat">
                    <h1 class="number"><?php echo $statement['invoices'] ?></h1>
                    <p class="stat-title grey">Invoices</p>
                    <hr class="orange"><img class="stat-icon" src="../assets/img/credit-cards%202.svg">
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-45">
        <div class="row">
            <div class="col-md-6">
                <div class="div-bg">
                    <div class="dash-two">
                        <p class="second-title grey"><a href="services.php"><span class="view purple">View All</span></a>Your Services</p>
                    </div>
                    <div class="section-dash-two">
                        <?php
                        $int = 0;
                        while($int < 3 && $row = $sql->fetch(PDO::FETCH_ASSOC)){
                        ?>
                        <div class="sec-div">
                        <a href ="service.php?id=<?php echo $row['id']?>">
                            <p class="grey title-two"><?php echo $row['package_name']?><span class="date"><?php echo $row['createdAt']?></span><br></p>
                            <p class="grey title-link purple"><?php echo $row['domain']?><?php if($row['status'] == "Active"){echo "<span class='status green'>Active</span>";}else {echo "<span class='status red'>Terminated</span>";} ?><br></p>
                        </a>
                        </div>
                        <?php
                        $int++;
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="div-bg">
                    <div class="dash-two">
                        <p class="second-title grey">Your Tickets<span class="view purple">View All</span></p>
                    </div>
                    <div class="section-dash-two">
                        <!-- <div class="sec-div">
                            <p class="grey title-two">#1239 - Where is my login information?<span class="status green ticket-status">Active</span><br></p>
                            <p class="grey title-link purple">Last Updated: 19/02/2022<br></p>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>