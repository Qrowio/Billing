<?php
declare(strict_types = 1);

class Session {

    public function loggedIn()
    {
        if(isset($_SESSION['client']))
        {
            header('location: ./dashboard/');
        }
    }

    function dashboard()
    {
        if(!isset($_SESSION['client']))
        {
            header('location: ../login');
        }
    }
}