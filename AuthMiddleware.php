<?php



class AuthMiddleware
{

    public static function notLoggedIn()
    {

        session_start();
        if (!isset($_SESSION['id'])) {
            header("Location: /");
            return true;
        } else {
            return false;
        }
    }

    public static function loggedIn()
    {

        session_start();
        if (isset($_SESSION['id'])) {
            header("Location: /index");
            return true;
        } else {
            return false;
        }
    }
}
