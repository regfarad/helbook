<?php

require_once 'include/functions.php';
reconnect_from_cookie();

if (isset($_SESSION['auth'])) {
    header('Location: index.php?page=compte');
}
if (!empty($_POST) && !empty($_POST['pseudo']) && !empty($_POST['passwd'])) {
    $pseudo = $_POST['pseudo'];
    $pwd = $_POST['passwd'];

    require_once 'connexion_bd.php';


    $sql = "SELECT * FROM profiluser WHERE pseudo = :pseudo OR mail = :pseudo";
    $req = $dbh->prepare($sql);
    $req->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
    $req->execute();
    $user = $req->fetch();

    $pass = md5($pwd);
    if ($pass == $user['passwd']) {

        $_SESSION['auth'] = $user;
       // $_SESSION['flash']['success'] = "Vous êtes maintenant connecté.";
        if ($_POST['remember']) {
            $remember_token = str_random(250);
            $user_id = $user['id'];

            $sqlUpd = 'UPDATE profiluser set remember_token = :rem_token WHERE id = :id';
            $query = $dbh->prepare($sqlUpd);
            $query->bindParam(':rem_token', $remember_token, PDO::PARAM_STR);
            $query->bindParam(':id', $user_id, PDO::PARAM_STR);
            $query->execute();
            setcookie('remember', $user_id . '==' . $remember_token . sha1($user_id . 'reglol'), time() + 60 * 60 * 24 * 7);
        }

        header('Location: index.php?page=compte');
        exit();
    } else {
        $_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrect';
    }
}
?>

<?php require 'include/header.php'; ?>

<section class="col-lg-12">
    <h1 style="color:midnightblue; font-weight: bolder;">Se connecter</h1>
    <p class="textSection"></p>
</section>

<?php

require 'include/footer.php';
