<?php

function modif_infos_membre($id, $nom, $prenom, $sexe, $situation, $passwdNew, $dateNaiss, $anac, $section, $email, $cheminImg) {
    require 'connexion_bd.php';

    if (!isset($dbh)) {
        global $dbh;
    }
    $sqlUp = "UPDATE profiluser set nom = :nom, prenom = :prenom, sexe = :sexe, situation = :situation,
            passwd = :passwd, dateNaiss = :dateNaiss , anac = :anac, section = :section, mail = :mail, img_profil = :img_profil
            WHERE id = :id";
    $req = $dbh->prepare($sqlUp);

    $req->bindParam(':nom', $nom);
    $req->bindParam(':prenom', $prenom);
    $req->bindParam(':sexe', $sexe);
    $req->bindParam(':situation', $situation);
    $req->bindParam(':passwd', $passwdNew);
    $req->bindParam(':dateNaiss', $dateNaiss);
    $req->bindParam(':anac', $anac);
    $req->bindParam(':section', $section);
    $req->bindParam(':mail', $email);
    $req->bindParam(':img_profil', $cheminImg);
    $req->bindParam(':id', $id);

    $req->execute();
}
