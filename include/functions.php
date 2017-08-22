<?php

function debug($var) {

    echo '<pre>' . printf(var_dump($var), true) . '</pre>';
}

function str_random($length) {
    $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
    return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
}

function isLogged_only() {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['auth'])) {
        session_start();
        $_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'accéder à cette page";
        header('Location: index.php');
        exit();
    }
}

function isLogged() {
    if (isset($_SESSION['auth'])) {
        $logged = 1;
    } else {
        $logged = 0;
    }
    return $logged;
}

function reconnect_from_cookie() {
    
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    
    if (isset($_COOKIE['remember'])) {
        require_once 'connexion_bd.php';
        if (!isset($dbh)) {
            global $dbh;
        }
        
        
        $remember_token = $_COOKIE['remember'];
        $parts = explode('==', $remember_token);
        $user_id = $parts[0];

        $sql = "SELECT * FROM profiluser WHERE id = :id";
        $req = $dbh->prepare($sql);
        $req->bindParam(':id', $user_id, PDO::PARAM_STR);
        $req->execute();
        $user = $req->fetch();

        if ($user) {
            $expected = $user_id . '==' . $user['remember_token'] . sha1($user_id . 'reglol');

            if ($expected == $remember_token) {
                session_start();
                $_SESSION['auth'] = $user;
                setcookie('remember', $remember_token, time()+60*60*24*7);
            } else {
                setcookie('remember', null, -1);
            }
        } else {
            setcookie('remember', null, -1);
        }
    }
}
