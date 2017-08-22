<?php
require 'include/ibi_func.php';
require './connexion_bd.php';
$page = htmlentities($_GET['page']);
$pages = scandir('./');


if (!empty($page) && in_array($_GET['page'].".php", $pages)) {
    $content = './'.$_GET['page'].".php";
} else {
    header("Location: index.php?page=accueil_inscription");
}

if(isset($_SESSION['auth']['pseudo']) && $page!='compte' && $page!='parametres' && $page!='liste_membres' && $page != 'profil_membre' && $page != 'envoi_demande_ami' &&
        $page != 'annuler_demande_ami' && $page != 'invitations' && $page != 'amis' && $page != 'supprimer_ami' && $page != 'new_message' && $page != 'conversations' && 
        $page != 'message' && $page != 'tchat' && $page != 'historique' && $page = 'profil_connecte'&&$page='notifications') {
    header("Location: index.php?page=compte");
}
require $content;




