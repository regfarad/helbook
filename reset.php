<?php

if (isset($_GET['id']) && isset($_GET['token'])) {
    $user_id = $_GET['id'];
    $token = $_GET['token'];

    require 'connexion_bd.php';
    require 'include/functions.php';

    $sql = 'SELECT * FROM profiluser WHERE id = :id AND reset_token IS NOT NULL and reset_token = :reset_token AND reset_at > DATE_SUB(NOW(), INTERVAL 30 MINUTE)';
    $query = $dbh->prepare($sql);
    $query->bindParam(':id', $user_id, PDO::PARAM_STR);
    $query->bindParam(':reset_token', $token, PDO::PARAM_STR);
    $query->execute();
    $user = $query->fetch();

    if ($user) {
        if (!empty($_POST)) {
            if (!empty($_POST['reset_pass']) && $_POST['reset_pass'] == $_POST['reset_pass_conf']) {
                $reset_pass = $_POST['reset_pass'];
                $reset_pass_md5 = md5($reset_pass);
                
                $sqlUpd = 'UPDATE profiluser set passwd = :passwd, reset_at = NULL, reset_token = NULL';
                $query2 = $dbh->prepare($sqlUpd);
                $query2->bindParam(':passwd', $reset_pass_md5, PDO::PARAM_STR);
                $query2->execute();
                
                session_start();
                $_SESSION['flash']['success'] = "Votre mot de passse a bien été modifié";
                $_SESSION['auth'] = $user;
                header('Location: index.php?page=compte');
                exit();
            }
        }
    } else {
        session_start();
        $_SESSION['flash']['danger'] = "Ce token n'est pas valide";
        header('Location: index.php?page=login');
        exit();
    }
} else {
    header('Location: index.php?page=login');
}
?>

<?php require 'include/header.php'; ?>

<section class="col-lg-12">
    <h1 style="color:midnightblue; font-weight: bolder;">Réinitialisation mot de passe</h1>
    <h4 style="color:white; font-weight: bolder; background-color:midnightblue;">Réinitialiser mon mot de passe</h4>
    <form action="" method="post">
        <div class="row">
            <div class="form-group">
                <div class="col-lg-3">
                    <input type="password" class="form-control" name="reset_pass" id="reset_pass" placeholder="Mot de passe" required>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="form-group">
                <div class="col-lg-3">
                    <input type="password" class="form-control" name="reset_pass_conf" id="reset_pass_conf" placeholder="Confirmer mot de passe" required>
                </div>
                <div id="result"></div> 
            </div>
        </div>
        <button class="btn btn-primary">Réinitialiser mon mot de passe</button>
    </form>
    <p class="textSection"></p>
</section>

<?php

require 'include/footer.php';
