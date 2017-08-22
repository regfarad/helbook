<?php
function afficher_actu() {
    require 'connexion_bd.php';
    if (!isset($dbh)) {
        global $dbh;
    }
    $infos = array();

    $sql = "SELECT * from actualites ORDER BY date_actu DESC";
    $req = $dbh->prepare($sql);
    $req->execute();
    while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
        $infos[] = $row;
    }
    return $infos;
}
