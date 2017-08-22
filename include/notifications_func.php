<?php

function afficher_notifs() {
    require 'connexion_bd.php';
    if (!isset($dbh)) {
        global $dbh;
    }
    $infos = array();
    $id = $_SESSION['auth']['pseudo'];

    $sql = "SELECT profiluser.pseudo, profiluser.img_profil, notifications.sujet_notif_id, notifications.nom_notif, notifications.vu, notifications.date_notif"
            . " FROM notifications"
            . " LEFT JOIN profiluser ON profiluser.pseudo = user_id"
            . " WHERE sujet_notif_id = :sujet_notif_id"
            . " ORDER BY notifications.date_notif DESC";

    $req = $dbh->prepare($sql);
    $req->bindParam(':sujet_notif_id', $id);
    $req->execute();

    while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
        $infos[] = $row;
    }
    
    $sql = "UPDATE notifications SET vu = '1' WHERE sujet_notif_id = :sujet_notif_id";
    $req2 = $dbh->prepare($sql);
    $req2->bindParam(':sujet_notif_id', $id);
    $req2->execute();
    
    return $infos;
}
