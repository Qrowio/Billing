<?php
session_start();
include '../includes/handler.inc.php';
new Service();
$session = new Session();
$database = new Database();
$session->dashboard();
$services = $database->select('*', 'services', ['user' => $_SESSION['client']['id']]);
$userInfo = $database->select('*', 'users', ['id' => $_SESSION['client']['id']]);
include '../views/dashboard/meta.html';
include '../views/dashboard/nav.html';
?>
    <div class="container mt-7">
        <div class="row">
            <div class="col-md-12">
                <p class="grey panel-p">Dashboard</p>
                <p class="grey panel-header">Welcome, <?php echo $userInfo[0]['firstname'] . " ". $userInfo[0]['lastname']?></p>
                <p class="grey panel-p">Welcome to the dashboard. Through here you can manage your service.</p>
            </div>
        </div>
    </div>
    <div class="container mt-45">
        <div class="row">
            <div class="col-md-4">
                <div class="div-bg stat">
                    <h1 class="number"><?php echo $userInfo[0]['services'] ?></h1>
                    <p class="stat-title grey">Services</p>
                    <hr class="purple"><img class="stat-icon" src="../assets/img/icons/server.svg">
                </div>
            </div>
            <div class="col-md-4">
                <div class="div-bg stat">
                    <h1 class="number"><?php echo $userInfo[0]['tickets'] ?></h1>
                    <p class="stat-title grey">Tickets</p>
                    <hr class="red"><img class="stat-icon" src="../assets/img/icons/heart.svg">
                </div>
            </div>
            <div class="col-md-4">
                <div class="div-bg stat">
                    <h1 class="number"><?php echo $userInfo[0]['invoices'] ?></h1>
                    <p class="stat-title grey">Invoices</p>
                    <hr class="orange"><img class="stat-icon" src="../assets/img/icons/card.svg">
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
                        foreach($services as $service){
                        ?>
                        <div class="sec-div">
                        <a href ="service.php?id=<?php echo $service['id']?>">
                            <p class="grey title-two"><?php echo $service['package_name']?><span class="date"><?php echo $service['createdAt']?></span><br></p>
                            <p class="grey title-link purple"><?php echo $service['domain']?><?php if($service['status'] == "Active"){echo "<span class='status green'>Active</span>";}else {echo "<span class='status red'>Terminated</span>";} ?><br></p>
                        </a>
                        </div>
                        <?php
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

    <?php include '../views/dashboard/footer.html' ?>