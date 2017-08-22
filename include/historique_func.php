<?php
function get_historique() {
    require 'connexion_bd.php';
    $user = $_SESSION['user']['pseudo'];
    $membre = $_SESSION['auth']['pseudo'];


    if (!isset($dbh)) {
        global $dbh;
    }

    $infos = array();

    $sql = "SELECT * FROM tchat "
            . "INNER JOIN profiluser ON (profiluser.pseudo = tchat.receiver) "
            . "WHERE (sender = :sender AND receiver = :receiver) OR (receiver = :sender AND sender = :receiver) ORDER BY date DESC";
    $req = $dbh->prepare($sql);
    $req->bindParam(':sender', $membre, PDO::PARAM_STR);
    $req->bindParam(':receiver', $user, PDO::PARAM_STR);
    $req->execute();

    while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
        $infos[] = $row;
    }
    return $infos;
}
