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

    public function dashboard()
    {
        if(!isset($_SESSION['client']))
        {
            header('location: ../login');
        }
    }

    public function admin()
    {
        if(!isset($_SESSION['admin']))
        {
            header('location: ../dashboard/');
        }
    }
}