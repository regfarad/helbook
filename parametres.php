<?php
require 'include/parametre_func.php';
require 'include/header.php';
require 'menu_membre.php';

if (isset($_POST['submit'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $situation = $_POST['situation'];
    $email = $_POST['email'];
    $pwd = $_POST['passwordNew'];
    $pwd_conf = $_POST['password_confNew'];
    $sexe = $_POST['sexe'];
    $dateNaiss = $_POST['dateNaiss'];
    $section = $_POST['section'];
    $anac = $_POST['anac'];

//La photo de profil

    $fichier = basename($_FILES['avatar']['name']);
    $fichier = strtr($fichier, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
    $fichier = preg_replace('/([^.a-z0-9_]+)/i', '-', $fichier);

    $dossier = 'images/';
    $cheminImg = $dossier . $fichier;

    if ($pwd != $pwd_conf) {
        $_SESSION['flash']['danger'] = "Les mots de passe ne sont pas identiques";
    }
    $user_id = $_SESSION['auth']['id'];
    $passmd5 = md5($pwd);
    modif_infos_membre($user_id, $nom, $prenom, $sexe, $situation, $passmd5, $dateNaiss, $anac, $section, $email, $cheminImg);
    $_SESSION['flash']['success'] = "Vos informations entrées ont bien été mis à jour";  
    header("Location: index.php?page=compte");
}
?>
<h3 style="color:white; font-weight: bolder; background-color:midnightblue; padding-left: 10px;">Vos paramètres</h3>

<?php
$infos = infos_membre_connecte();
foreach ($infos as $info) {
    ?>
    <form action="" method="POST" class="form-horizontal col-lg-7" enctype="multipart/form-data">
        <fieldset class="param_fieldset">
            <legend>Changer vos informations</legend>

            <div class="row">
                <div class="form-group">
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="nom" id="nom" value="<?php echo $info['nom']; ?>" />
                    </div>
                    <div class="col-lg-6">
                        <input type="text" class="form-control" name="prenom" id="prenom" value="<?php echo $info['prenom']; ?> "/>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-lg-12">
                        <input type="email" class="form-control" name="email" id="email" value="<?php echo $info['mail']; ?>">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <div class="col-lg-12">
                        <input type="password" class="form-control" name="passwordNew" id="passwordNew" placeholder="Nouveau mot de passe">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <div class="col-lg-12">
                        <input type="password" class="form-control" name="password_confNew" id="password_confNew" placeholder="Confirmer votre nouveau mot de passe" onchange="validationmdp(this)">
                    </div>
                    <div id="result"></div> 
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label class="col-lg-5 elmts">Situation</label>
                    <select name="situation">
                        <?php echo isset($info['situation']) ? '<option value=' . $info['situation'] . '>' . $info['situation'] . '</option>' : ""; ?>
                        <?php echo $info['situation'] != 'Celibataire' ? '<option value="Celibataire">Celibataire</option>' : ""; ?>
                        <?php echo $info['situation'] != 'En relation libre' ? '<option value="En relation libre">En relation libre</option>' : ""; ?>
                        <?php echo $info['situation'] != 'En couple' ? '<option value="En couple">En couple</option>' : ""; ?>
                        <?php echo $info['situation'] != 'Marié(e)' ? '<option value="Marié(e)">Marié(e)</option>' : ""; ?> 
                        <?php echo $info['situation'] != 'Divorcé(e)' ? '<option value="Divorcé(e)">Divorcé(e)</option>' : ""; ?>       

                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label class="col-lg-5 elmts positionDateNaiss"> Date de naissance </label>
                    <div class="col-lg-4">    
                        <input type='date' class="form-control" name="dateNaiss" id="dateNaiss" value="<?php echo $info['dateNaiss']; ?>"/>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <label class="col-lg-5 elmts">Sexe</label>
                    <div class="radio-inline">
                        <label class="elmts radio-inline"><input type="radio" name="sexe" value="homme" checked="checked" id="m">Homme</label>
                        <label class="elmts radio-inline"><input type="radio" name="sexe" value="femme" id="f">Femme</label>
                    </div>        
                </div>
                <div id="result2"></div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label class="col-lg-5 elmts positionSection"> Section </label>
                    <div class="radio-inline elmts">
                        <label class="radio-inline"><input type="radio" name="section" value="RP" checked="checked" id="rp">RP</label> 
                        <label class="radio-inline"><input type="radio" name="section" value="IG" id="ig">IG</label>
                    </div>  
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label class="col-lg-5 elmts">Année accadémique</label>
                    <select name="anac">
                        <?php echo isset($info['anac']) ? '<option value=' . $info['anac'] . '>' . $info['anac'] . '</option>' : ""; ?>
                        <?php echo $info['anac'] != '1' ? '<option value="1">1</option>' : ""; ?>
                        <?php echo $info['anac'] != '2' ? '<option value="2">2</option>' : ""; ?>
                        <?php echo $info['anac'] != '3' ? '<option value="3">3</option>' : ""; ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <label class="col-lg-4 elmts positionAvatar">Definir Avatar</label>
                    <div class="col-lg-8 elmts">        
                        <input type="file" id="avatar" name="avatar" value="<?php echo $info['img_profil']; ?>">
                    </div>
                </div>
            </div>
            <div class="row">
                <div>
                    <input type="submit" class="btn btn-primary" role="button" name="submit" value="Modifier">
                    <input type="reset" class="btn btn-danger" role="button" name="annuler" value="Annuler">
                </div>
            </div>
        </fieldset>  
    </form>
    <?php
}

