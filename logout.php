<?php

session_start();
setcookie('remember', NULL, -1);
unset($_SESSION['auth']);
//$_SESSION['flash']['success'] = "Vous êtes maintenant déconnecté";

//<!--<p style="color: green;">Vous êtes maintenant déconnecté</p>-->

header("Location: index.php?page=accueil_inscription");
