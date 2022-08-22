<?php
session_start();
include 'includes/handler.inc.php';
new Database();
$session = new Session();
$session->loggedIn();
include './views/meta.html';
include './views/forgot.html';
?>