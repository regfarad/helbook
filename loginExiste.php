<?php
    require_once 'connexion_bd.php';

    $login = $_POST['login'];
    if (isset($login)&&!empty($login)) {
        
        
        $sql = 'SELECT pseudo from profiluser WHERE pseudo = :pseudo';
        $query = $dbh->prepare($sql);
        $query->bindParam(':pseudo', $login,PDO::PARAM_STR) ;
        $query->execute();
        if ($query->rowCount() == 1) {
            echo 'Ce pseudo existe dejà.'; 
            echo 'Veuillez choisir un autre login';
        } else {
            echo "Pseudo disponible";
        }
    }

