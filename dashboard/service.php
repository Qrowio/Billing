<?php
session_start();
include '../includes/handler.inc.php';
$session = new Session();
$session->dashboard();
$database = new Database();
$sql = $database->servicePage();
$row = $sql->fetch();
$cpanel = new CPanel();
$decode = $cpanel->requestInfo();
$bandwidth = $cpanel->bandwidth();
$test = $database->serviceExpiry();
$statement = $database->userInfo();
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
                <p class="grey panel-p">Service - #<?php echo $row['id']?></p>
                <p class="grey panel-header">My Services</p>
                <p class="grey panel-p">Here is the individual information about your service.<br></p>
            </div>
        </div>
    </div>
    <div class="container mt-45">
        <div class="row">
            <div class="col-md-6">
                <div class="div-bg">
                    <div class="dash-two">
                        <p class="second-title grey">Service Information</p>
                    </div>
                    <div class="section-dash-two">
                        <div class="service-info">
                            <div class="service-div-inlien mb-3">
                                <p class="grey info-title">Name</p>
                                <p class="purple info-info"><?php echo $decode['acct'][0]['plan']; ?></p>
                            </div>
                            <div class="service-div-inlien mb-3">
                                <p class="grey info-title">Domain</p>
                                <p class="purple info-info"><?php echo $decode['acct'][0]['domain']; ?></p>
                            </div>
                            <div class="service-div-inlien">
                                <p class="grey info-title">Storage</p>
                                <p class="purple info-info"><?php echo $decode['acct'][0]['disklimit']; ?></p>
                            </div>
                            <div class="service-div-inlien mb-3">
                                <p class="grey info-title">Bandwidth</p>
                                <p class="purple info-info">empty</p>
                            </div>
                            <div class="service-div-inlien mb-3">
                                <p class="grey info-title">Domains</p>
                                <p class="purple info-info"><?php echo $decode['acct'][0]['maxsub']; ?></p>
                            </div>
                            <div class="service-div-inlien mb-3">
                                <p class="grey info-title">Contact Email</p>
                                <p class="purple info-info"><?php echo $decode['acct'][0]['email']; ?></p>
                            </div>
                            <div class="service-div-inlien mb-3">
                                <p class="grey info-title">Email Accts</p>
                                <p class="purple info-info"><?php echo $decode['acct'][0]['max_emailacct_quota']; ?></p>
                            </div>
                            <div class="service-div-inlien mb-3">
                                <p class="grey info-title">FTP Accts</p>
                                <p class="purple info-info"><?php echo $decode['acct'][0]['maxftp']; ?></p>
                            </div>
                            <div class="service-div-inlien mb-3">
                                <p class="grey info-title">Max Databases</p>
                                <p class="purple info-info"><?php echo $decode['acct'][0]['maxsql']; ?></p>
                            </div>
                            <div class="service-div-inlien mb-3">
                                <p class="grey info-title">Disk Limit</p>
                                <p class="purple info-info"><?php echo $decode['acct'][0]['disklimit']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="div-bg">
                    <div class="dash-two">
                        <p class="second-title grey">Service Usage</p>
                    </div>
                    <div class="section-dash-two" style="display: inline-block;text-align: center;width: 100%;padding: 1.6rem 0;"><div style="display: inline-block">
<div class="semi-donut margin" 
<?php 
     if($decode['acct'][0]['disklimit'] == 'Unlimited'){
        echo 0;
     } else {
        $used = (int)$decode['acct'][0]['diskused']; 
        $limit = (int)$decode['acct'][0]['disklimit']; 
        $math = ($used * 100) / $limit; 
     }
     ?>
     style="--percentage : <?php echo $math?>; --fill: #FF3D00 ;">
     <?php echo $math?>%
</div>
    <p class="grey usage-title"> Disk Usage </p>
    <p class="purple usage-number"> <?php echo $decode['acct'][0]['diskused']; ?> MB / <?php echo $decode['acct'][0]['disklimit']; ?> </p>
</div>

<div style="display: inline-block">
<div class="semi-donut margin" 
<?php
    if($bandwidth['bandwidth'][0]['acct'][0]['limit'] == 'unlimited'){
        $limit = 'Unlimited';
        $math = 0;
    } else {
        echo "hi";
        $limit = round((int)$bandwidth['bandwidth'][0]['acct'][0]['limit']/1024/1024); 
        $math = round((int)$bandwidth['bandwidth'][0]['acct'][0]['totalbytes']/1024/1024);
    }
    ?>
     style="--percentage : <?php echo $math ?>; --fill: #FF3D00 ;">
     <?php echo $math ?>%

</div>
    <p class="grey usage-title"> Bandwidth Usage </p>
    <p class="purple usage-number"> <?php echo $math; ?> MB / <?php echo $limit ?> MB</p>
</div></div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-45">
        <div class="row">
            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12">
                <div class="div-bg">
                    <div class="dash-two">
                        <p class="second-title grey">Quick Links</p>
                    </div>
                    <div class="section-dash-two" style="display: block;text-align: center;">
                        <div class="link-div"><img class="link-image" src="../assets/img/globe%201.svg">
                            <p class="link-text">Subdomains</p>
                        </div>
                        <div class="link-div"><img class="link-image" src="../assets/img/Group%2071.svg">
                            <p class="link-text">Email Accounts</p>
                        </div>
                        <div class="link-div"><img class="link-image" src="../assets/img/Group%2072.svg">
                            <p class="link-text">Backup</p>
                        </div>
                        <div class="link-div"><img class="link-image" src="../assets/img/Group%2076.svg">
                            <p class="link-text">FTP Accounts</p>
                        </div>
                        <div class="link-div"><img class="link-image" src="../assets/img/XMLID_52_.svg">
                            <p class="link-text">File Manager</p>
                        </div>
                        <div class="link-div"><img class="link-image" src="../assets/img/Group.svg">
                            <p class="link-text">phpMyAdmin</p>
                        </div>
                        <div class="link-div"><img class="link-image" src="../assets/img/Group%2080.svg">
                            <p class="link-text">MySQL Databases</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>