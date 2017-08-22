<?php

$user_id = $_GET['id'];
$token = $_GET['token'];
require 'connexion_bd.php';

$sql = 'SELECT * FROM profiluser WHERE id = :id';
$query = $dbh->prepare($sql);
$query->bindParam(':id', $user_id, PDO::PARAM_STR);
$query->execute();
$user = $query->fetch();
session_start();

if ($user && $user['confirmation_token'] == $token) {
    $sqlUpd = 'UPDATE profiluser set confirmation_token = NULL, confirmed_at = NOW() WHERE id = :id';
    $query2 = $dbh->prepare($sqlUpd);
    $query2->bindParam(':id', $user_id, PDO::PARAM_STR);
    $query2->execute();
    
    $_SESSION['flash']['success'] = "Votre compte a bien été validé";
    $_SESSION['auth'] = $user;
    
    //header("Refresh: 1; URL=http://localhost/HelBook/compte.php");
    header('Location: index.php?page=compte');
} else {
    $_SESSION['flash']['danger'] = "Ce token n'est plus valide";
    //header("Refresh: 1; URL=http://localhost/HelBook/login.php");
    header('Location: index.php?page=login');
}
