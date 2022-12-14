<?php
session_start();
include '../includes/handler.inc.php';
$session = new Session();
$session->dashboard();
$database = new Database();
new Service();
$services = $database->select('*', 'services', ['user' => $_SESSION['client']['id']]);
$userInfo = $database->select('*', 'users', ['id' => $_SESSION['client']['id']]);
include '../views/dashboard/meta.html';
include '../views/dashboard/nav.html';
?>

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
        foreach ($services as $service) {
        ?>
        <div class="col-md-6 mb-4">
                <div class="div-bg service-div">
                    <p class="purple service-name"><?php echo $service['package_name'] ?><?php if($service['status'] == "Active"){echo "<span class='green-stat service-status'>Active</span>";}else {echo "<span class='red service-status'>Terminated</span>";} ?><span class="grey service-id">Service ID: #<?php echo $service['id'] ?></span></p>
                    <div class="service-info mt-45">
                        <div class="service-div-inlien">
                            <p class="grey info-title">Started On</p>
                            <p class="purple info-info"><?php echo $service['createdAt'] ?></p>
                        </div>
                        <div class="service-div-inlien">
                            <p class="grey info-title">Expires On</p>
                            <p class="purple info-info"><?php echo $service['expireAt'] ?></p>
                        </div>
                        <div class="service-div-inlien">
                            <p class="grey info-title">Price</p>
                            <p class="purple info-info">$5.99/month</p>
                        </div>
                        <div class="service-div-inlien">
                            <p class="grey info-title">Domain</p>
                            <p class="purple info-info"><?php echo $service['domain'] ?></p>
                        </div>
                    </div>
                    <?php
                    if($service['status'] == "Active") {
                        echo "<div class='service-link-div'><p class='footer-bottom-text mt-45' style='display: inline-block'>Login to CPanel</p><a href='service.php?id=" . $service['id'] . "'><p style='display: inline-block' class='footer-bottom-text mt-45'>View Details</p></a></div>";
                    } else {
                        echo "<div class='service-link-div' style='justify-content: end;'><a href='service.php?id=" . $service['id'] . "'><p style='display: inline-block' class='footer-bottom-text mt-45'>View Details</p></a></div>";
                    }
                    ?>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>


    <?php include '../views/dashboard/footer.html' ?>