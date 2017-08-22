<?php

require './include/accepter_func.php';
accepter_invitation();
if (isset($_GET['pseudo'])) {
    header("Location: index.php?page=profil_membre&pseudo=" . $_GET['pseudo']);
}


