<?php
session_start();
include '../includes/handler.inc.php';
$session = new Session();
$session->dashboard();
$database = new Database();
$userInfo = $database->select('*', 'users', ['id' => $_SESSION['client']['id']]);
$cpanel = new CPanel();
$decode = $cpanel->requestInfo();
$bandwidth = $cpanel->bandwidth();
$service = new Service();
$info = $service->serviceInfo();
include '../views/dashboard/meta.html';
include '../views/dashboard/nav.html';
?>
    <div class="container mt-7">
        <div class="row">
            <div class="col-md-12">
                <p class="grey panel-p">Service - #<?php echo $info[0]['id']?></p>
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
        $math = ceil((int)($used * 100) / $limit); 
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
        $limit = (int)$bandwidth['bandwidth'][0]['acct'][0]['limit']/1024/1024;
        $used = ceil((int)$bandwidth['bandwidth'][0]['acct'][0]['totalbytes']/1024/1024);
        $math = ceil((int)($used * 100) / $limit);
    }
    ?>
     style="--percentage : <?php echo $math ?>; --fill: #FF3D00 ;">
     <?php echo $math ?>%

</div>
    <p class="grey usage-title"> Bandwidth Usage </p>
    <p class="purple usage-number"> <?php echo $used; ?> MB / <?php echo $limit ?> MB</p>
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
                        <div class="link-div"><img class="link-image" src="../assets/img/icons/globe.svg">
                            <p class="link-text">Subdomains</p>
                        </div>
                        <div class="link-div"><img class="link-image" src="../assets/img/icons/email.svg">
                            <p class="link-text">Email Accounts</p>
                        </div>
                        <div class="link-div"><img class="link-image" src="../assets/img/icons/backup.svg">
                            <p class="link-text">Backup</p>
                        </div>
                        <div class="link-div"><img class="link-image" src="../assets/img/icons/ftp.svg">
                            <p class="link-text">FTP Accounts</p>
                        </div>
                        <div class="link-div"><img class="link-image" src="../assets/img/icons/file.svg">
                            <p class="link-text">File Manager</p>
                        </div>
                        <div class="link-div"><img class="link-image" src="../assets/img/icons/phpmyadmin.svg">
                            <p class="link-text">phpMyAdmin</p>
                        </div>
                        <div class="link-div"><img class="link-image" src="../assets/img/icons/database.svg">
                            <p class="link-text">MySQL Databases</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include '../views/dashboard/footer.html' ?>