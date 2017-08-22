<?php

//la fonction qui va récupérer les infos de l'user connecté
function infos_membre_connecte() {
    require 'connexion_bd.php';
    if (!isset($dbh)) {
        global $dbh;
    }
    $infos = array();
    $id = $_SESSION['auth']['id'];

    $sql = "SELECT * FROM profiluser WHERE id = :id";
    $req = $dbh->prepare($sql);
    $req->bindParam(':id', $id, PDO::PARAM_STR);
    $req->execute();
    while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
        $infos[] = $row;
    }
    return $infos;
}

//la fonction qui va compter le nombre de personnes inscrites
function nombre_membres() {
    require 'connexion_bd.php';
    if (!isset($dbh)) {
        global $dbh;
    }

    $nb = $dbh->query("SELECT COUNT(id) FROM profiluser");
    $res = $nb->fetchColumn();

    return $res;
}

/*function nombre_notifs_non_lues() {
    require 'connexion_bd.php';
    if (!isset($dbh)) {
        global $dbh;
    }
    
    $id = $_SESSION['auth']['pseudo'];
    $nb = $dbh->query("SELECT COUNT(id) FROM notifications "
            . "WHERE sujet_notif_id = '$id' AND vu = 0");
    $res = $nb->fetchColumn();

    return $res;
}*/
