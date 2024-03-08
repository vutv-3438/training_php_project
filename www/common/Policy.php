<?php

require_once("models/User.php");

class Policy
{
    public static function checkCredentials(string $userName, string $password)
    {
        return (new User())->checkCredentials($userName, $password);
    }

    public static function checkAuthorize()
    {
        session_start();
        if (!isset($_SESSION['user_name'])) {
            if (isset($_COOKIE['remember_me_cookie'])) {
                $cookie_value = base64_decode($_COOKIE['remember_me_cookie']);
                list($username, $password) = explode(':', $cookie_value);

                if (static::checkCredentials($username, $password)) {
                    $_SESSION['user_name'] = $username;
                    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                    header('Location: index.php?model=book&action=readAll');
                    exit();
                } else {
                    setcookie('remember_me_cookie', '', time() - 3600);
                }
            }

            header("location: index.php?model=user&action=login");
            exit();
        }
    }
}