<?php
//la fonction qui va recuperer la liste d'amis de l'expéditeur
function liste_amis_exp() {
    require 'connexion_bd.php';
    if (!isset($dbh)) {
        global $dbh;
    }
    $infos = array();
    $sessionPseudo = $_SESSION['auth']['pseudo'];

    $sql = "SELECT pseudo_dest, img_profil FROM amis INNER JOIN profiluser ON (profiluser.pseudo = amis.pseudo_dest) WHERE pseudo_exp = :sessionPseudo AND active = 1";
    $req = $dbh->prepare($sql);
    $req->bindParam(':sessionPseudo', $sessionPseudo, PDO::PARAM_STR);
    $req->execute();
    while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
        $infos[] = $row;
    }
    
    return $infos;
}

//la fonction qui va recuperer la liste d'amis du destinaire
function liste_amis_dest() {
    require 'connexion_bd.php';
    if (!isset($dbh)) {
        global $dbh;
    }
    $infos = array();
    $pseudo = $_SESSION['auth']['pseudo'];

    $sql = "SELECT pseudo_exp, img_profil FROM amis INNER JOIN profiluser ON (profiluser.pseudo = amis.pseudo_exp) WHERE pseudo_dest = :pseudo AND active = 1";
    $req = $dbh->prepare($sql);
    $req->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    $req->execute();
    while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
        $infos[] = $row;
    }
    return $infos;
}