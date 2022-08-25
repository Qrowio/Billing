<?php
session_start();
include '../includes/handler.inc.php';
$session = new Session();
$session->dashboard();
$database = new Database();
$userInfo = $database->select('*', 'users', ['id' => $_SESSION['client']['id']]);
$settings = new Settings();
include '../views/dashboard/meta.html';
include '../views/dashboard/nav.html';
?>

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
                <div class="settings-3"><input type="text" name="firstname" placeholder="<?php echo $userInfo[0]['firstname']?>" class="settings-small"></div>
                <div class="settings-3"><input type="text" name="lastname" placeholder="<?php echo $userInfo[0]['lastname']?>" class="settings-small"></div>
            </div>
            <div class="col-md-12 col-lg-12 col-xl-12 col-xxl-12 offset-xxl-0">
                <hr class="settings-hr">
            </div>
            <div class="col-md-6 col-xxl-5">
                <p class="settings-title">Email</p>
                <p class="settngs-desc grey">This will be used for all email purposes. This includes password resets and order information.<br></p>
            </div>
            <div class="col-md-6 offset-xxl-1 settings-div">
                <div class="settings-3" style="width: 100%;"><input type="text" name="email" placeholder="<?php echo $userInfo[0]['email']; ?>"class="settings-small" style="width: 100%!important;"></div>
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
                <div class="settings-3"><input type="text" placeholder="Current Password" name="password" class="settings-small"></div>
                <div class="settings-3"><input type="text" placeholder="New Password" name="confirm" class="settings-small"></div>
            </div>
        </div>
    </div>
</form>

<?php include '../views/dashboard/footer.html' ?>