<?php
if (!empty($_POST) && !empty($_POST['mail'])) {
    $mail = $_POST['mail'];

    require_once 'connexion_bd.php';
    require_once 'include/functions.php';

    $sql = "SELECT * FROM profiluser WHERE mail = :mail AND confirmed_at IS NOT NULL";
    $req = $dbh->prepare($sql);
    $req->bindParam(':mail', $mail, PDO::PARAM_STR);
    $req->execute();
    $user = $req->fetch();

    $user_id = $user['id'];
    $pass = md5($pwd);
    if ($user) {
        session_start();

        $reset_token = str_random(60);
        $sqlUpd = 'UPDATE profiluser set reset_token = :reset_token, reset_at = NOW() WHERE id = :id';
        $query2 = $dbh->prepare($sqlUpd);
        $query2->bindParam(':reset_token', $reset_token, PDO::PARAM_STR);
        $query2->bindParam(':id', $user_id, PDO::PARAM_STR);
        $query2->execute();

        $_SESSION['flash']['success'] = "Les instrctions du rappel du mot de passe vous ont été renvoyés par email.";
        $objet = 'Réinitialisation de votre mot de passe';
        $msg = "Afin de réinitialiser votre mot de passe, veuillez cliquer sur ce lien.\n\nhttp://localhost/HelBook/reset.php?id=$user_id&token=$reset_token";
        $from = "From: regfaradtest@gmail.com";
        mail($mail, $objet, $msg, $from);
        header('Location: index.php?page=login');
        exit();
    } else {
        session_start();
        $_SESSION['flash']['danger'] = 'Aucun compte ne correspond à cette adresse mail';
    }
}
?>

<?php require 'include/header.php'; ?>

<section class="col-lg-12">
    <h1 style="color:midnightblue; font-weight: bolder;">Mot de passe oublié</h1>
    <h4 style="color:white; font-weight: bolder; background-color:midnightblue;">Réinitialiser le mot de passe</h4>
    <form action="" method="post">
        <div class="row">
            <div class="form-group">
                <div class="col-lg-3">
                    <input type="mail" class="form-control" name="mail" id="mail" placeholder="Entrez votre adresse mail" required>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Se connecter</button>
    </form>

</section>


