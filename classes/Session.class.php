<?php

class Session {
    function loggedIn() {
        if(isset($_SESSION['client'])){
            header('location: ./dashboard/index.php');
        }
    }

    function dashboard() {
        if(!isset($_SESSION['client'])){
            header('location: ../login.php');
        }
    }
}