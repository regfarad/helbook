<?php
//la fonction qui va récupérer le pseudo et l'avatar du membre sauf celui dun connecté 
function recuperer_pseudo_avatar () {
    require 'connexion_bd.php';
    if (!isset($dbh)) {
        global $dbh;
    }
    $infos = array();
    $pseudo = $_SESSION['auth']['pseudo'];

    $sql = "SELECT pseudo, img_profil FROM profiluser WHERE pseudo != :pseudo";
    $req = $dbh->prepare($sql);
    $req->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    $req->execute();
    while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
        $infos[] = $row;
    }
    return $infos;
}

