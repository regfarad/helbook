<?php
//la fonction qui va recuperer les invitations 
function recup_invitation () {
    require 'connexion_bd.php';
    if (!isset($dbh)) {
        global $dbh;
    }
    $infos = array();
    $sessionPseudo = $_SESSION['auth']['pseudo'];

    $sql = "SELECT pseudo_exp,date_invitation,active,img_profil,sexe FROM amis INNER JOIN profiluser ON (profiluser.pseudo = amis.pseudo_exp) WHERE pseudo_dest = :sessionPseudo"
            . " ORDER BY date_invitation DESC";
    $req = $dbh->prepare($sql);
    $req->bindParam(':sessionPseudo', $sessionPseudo);
    $req->execute();
    while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
        $infos[] = $row;
    }
 
    return $infos;
}

//la fonction qui va vérifier si l'invitation a été accepté
function invitation_acceptee () {
    require 'connexion_bd.php';
    if (!isset($dbh)) {
        global $dbh;
    }
    $infos = array();
    $sessionPseudo = $_SESSION['auth']['pseudo'];

    $sql = "SELECT pseudo_dest from amis WHERE pseudo_exp = :sessionPseudo AND active = 1";
    $req = $dbh->prepare($sql);
    $req->bindParam(':sessionPseudo', $sessionPseudo);
    $req->execute();
    while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
        $infos[] = $row;
    }
 
    return $infos;
}