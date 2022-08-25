<?php
session_start();
include '../includes/handler.inc.php';
$session = new Session();
$session->admin();