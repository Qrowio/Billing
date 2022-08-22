<?php
session_start();
include 'includes/handler.inc.php';
new Database();
new Register();
$session = new Session();
$session->loggedIn();
include './views/meta.html';
include './views/register.html';
?>