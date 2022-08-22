<?php
session_start();
include '../includes/handler.inc.php';
$session = new Session();
$session->dashboard();
$database = new Database();
$sql = $database->pullServices();
$statement = $database->userInfo();
$test = $database->serviceExpiry();
include '../views/dashboard/meta.html';
include '../views/dashboard/nav.html';
?>
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
                    <hr class="purple"><img class="stat-icon" src="../assets/img/icons/server.svg">
                </div>
            </div>
            <div class="col-md-4">
                <div class="div-bg stat">
                    <h1 class="number"><?php echo $statement['tickets'] ?></h1>
                    <p class="stat-title grey">Tickets</p>
                    <hr class="red"><img class="stat-icon" src="../assets/img/icons/heart.svg">
                </div>
            </div>
            <div class="col-md-4">
                <div class="div-bg stat">
                    <h1 class="number"><?php echo $statement['invoices'] ?></h1>
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

    <?php include '../views/dashboard/footer.html' ?>