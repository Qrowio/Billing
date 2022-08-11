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
    <title>Ethereal - Dashboard - Services</title>
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
                    <li class="nav-item"><img class="nav-icon" src="../assets/img/server%201.svg"><a class="nav-link active" href="services.php">My Services</a></li>
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
                        </div>
                        <a class="dropdown-item" href="settings.php"><img class="nav-icon" src="../assets/img/settings%202.svg" style="margin-right: 10px;">Account Settings</a>
                        <a class="dropdown-item" href="#"><img class="nav-icon" src="../assets/img/card.svg" style="margin-right: 10px;">Billing Information</a>
                        <?php if($statement['is_admin'] == 1){echo "<a class='dropdown-item' href='../admin/'><img class='nav-icon' src='../assets/img/settings%202.svg' style='margin-right: 10px;'>Admin</a>";}?>
                        <hr style="color: #777777;"><a class="dropdown-item" href="logout.php"><img class="nav-icon" src="../assets/img/sign-out.svg" style="margin-right: 10px;">Sign Out</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="container mt-7">
        <div class="row">
            <div class="col-md-12">
                <p class="grey panel-p">Services</p>
                <p class="grey panel-header">My Services</p>
                <p class="grey panel-p">Here is a full list of all of the services you are subscribed to.<br></p>
            </div>
        </div>
    </div>
    <div class="container mt-45">
        <div class="row">
        <?php
        foreach ($row = $sql->fetchAll() as $row) {
        ?>
        <div class="col-md-6 mb-4">
                <div class="div-bg service-div">
                    <p class="purple service-name"><?php echo $row['package_name'] ?><?php if($row['status'] == "Active"){echo "<span class='green-stat service-status'>Active</span>";}else {echo "<span class='red service-status'>Terminated</span>";} ?><span class="grey service-id">Service ID: #<?php echo $row['id'] ?></span></p>
                    <div class="service-info mt-45">
                        <div class="service-div-inlien">
                            <p class="grey info-title">Started On</p>
                            <p class="purple info-info"><?php echo $row['createdAt'] ?></p>
                        </div>
                        <div class="service-div-inlien">
                            <p class="grey info-title">Expires On</p>
                            <p class="purple info-info"><?php echo $row['expireAt'] ?></p>
                        </div>
                        <div class="service-div-inlien">
                            <p class="grey info-title">Price</p>
                            <p class="purple info-info">$5.99/month</p>
                        </div>
                        <div class="service-div-inlien">
                            <p class="grey info-title">Domain</p>
                            <p class="purple info-info"><?php echo $row['domain'] ?></p>
                        </div>
                    </div>
                    <?php
                    if($row['status'] == "Active") {
                        echo "<div class='service-link-div'><p class='footer-bottom-text mt-45' style='display: inline-block'>Login to CPanel</p><a href='service.php?id=" . $row['id'] . "'><p style='display: inline-block' class='footer-bottom-text mt-45'>View Details</p></a></div>";
                    } else {
                        echo "<div class='service-link-div' style='justify-content: end;'><a href='service.php?id=" . $row['id'] . "'><p style='display: inline-block' class='footer-bottom-text mt-45'>View Details</p></a></div>";
                    }
                    ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>