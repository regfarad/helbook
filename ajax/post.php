<?php

require '../connexion_bd.php';

session_start();
$user = $_SESSION['user']['pseudo'];
$membre = $_SESSION['auth']['pseudo'];

$message = $_POST['message'];

if (!isset($dbh)) {
    global $dbh;
}

$infos = array();

$sql = "INSERT INTO tchat (sender,receiver,message,date) VALUES (:sender, :receiver, :message, NOW())";
$req = $dbh->prepare($sql);
$req->bindParam(':sender', $membre, PDO::PARAM_STR);
$req->bindParam(':receiver', $user, PDO::PARAM_STR);
$req->bindParam(':message', $message, PDO::PARAM_STR);
$req->execute();



