<?php

function get_user() {
    require 'connexion_bd.php';
    if (!isset($dbh)) {
        global $dbh;
    }

    $infos = array();
    
    $sessionPseudo = $_SESSION['user']['pseudo'];
    $sql = "SELECT * FROM profiluser WHERE pseudo = :sessionpseudo";
    $req = $dbh->prepare($sql);
    $req->bindParam(':sessionpseudo', $sessionPseudo, PDO::PARAM_STR);
    $req->execute();
    while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
        $infos[] = $row;
    }

    return $infos;
}
