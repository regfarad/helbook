<?php

require './connexion_bd.php';
if (!isset($dbh)) {
    global $dbh;
}
session_start();
$pseudo = $_SESSION['auth']['pseudo'];
if (isset($_POST['submit'])) {
    $text_actu = $_POST['text_actu'];

    $path = $_FILES['photo']['name'];

    $file = basename($path);
    $file = strtr($file, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
    $file = preg_replace('/([^.a-z0-9_]+)/i', '-', $file);

    $dossier = 'images/';
    $cheminImg = $dossier . $file;


    $req = $dbh->prepare("INSERT INTO actualites (text,pseudo,img_actu,date_actu) VALUES (:text,:pseudo,:img_actu,NOW())");
    $req->bindParam(':text', $text_actu);
    $req->bindParam(':pseudo', $pseudo);
    $req->bindParam(':img_actu', $cheminImg);
    $req->execute();
    header("Location : index.php?page=compte");
    exit();
}