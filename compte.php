<?php
require 'connexion_bd.php';
require 'include/functions.php';
require 'include/actu_func.php';
isLogged_only();

require 'include/header.php';
?>
<?php
require 'menu_membre.php';

if (!isset($dbh)) {
    global $dbh;
}
$pseudo = $_SESSION['auth']['pseudo'];

if (isset($_POST['submit'])) {
    $text_actu = $_POST['text_actu'];

    $path = $_FILES['photo']['name'];

    $file = basename($path);
    $file = strtr($file, 'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
    $file = preg_replace('/([^.a-z0-9_]+)/i', '-', $file);

    $dossier = 'images/';
    $cheminImg = $dossier . $file;


    $req = $dbh->prepare("INSERT INTO actualites (text,pseudo,img_actu,date_actu) VALUES (:text,:pseudo,:img_actu,NOW())");
    $req->bindParam(':text', $text_actu);
    $req->bindParam(':pseudo', $pseudo);
    $req->bindParam(':img_actu', $cheminImg);
    $req->execute();
    header("Location : index.php?page=compte");
}
?>
<h3 style="color:white; font-weight: bolder; background-color:midnightblue; padding-left: 10px;"><center>Actualités</center></h3>
<?php
$infos = infos_membre_connecte();
foreach ($infos as $info) {
    ?>
    <div style="text-align: center;">
        <a  href="index.php?page=profil_connecte"><img src="<?php echo $info['img_profil']; ?>"  height="70" width="70" class="img-rounded"></a>
    </div>
    <?php
}
?>
<div style="text-align: center;">
    <form method="post" action="" enctype="multipart/form-data">
        <textarea style="" id="text_actu" name="text_actu" rows="2" cols="65"></textarea>
        <div style="display: inline-block;">
            <input type="file" id="photo" name="photo" />
            <input style="margin-right: 40%;" type="submit" class=" btn btn-info" name="submit" value="Publier"/> 
        </div>
    </form>  
</div>

<?php
$infos_actus = afficher_actu();
foreach ($infos_actus as $info_actu) {
    ?>
    <div class="actualités">
        <?php if ($info_actu['img_actu'] == "images/") { ?>
            <p style="font-size: large;"><?php echo $info_actu['text'] ?></p>
            <p><em>Publié par <?php echo $info_actu['pseudo']; ?> le <?php echo date("d/m/Y à H:m:i", strtotime($info_actu['date_actu'])) ?></em></p>
        <?php } else { ?>
            <p style="font-size: large;"><?php echo $info_actu['text'] ?></p>
            <img src="<?php echo $info_actu['img_actu']; ?>"  height="250" width="400" class="img-rounded">
            <p><em>Publié par <?php echo $info_actu['pseudo']; ?> le <?php echo date("d/m/Y à H:m:i", strtotime($info_actu['date_actu'])) ?></em></p>
        <?php } ?>   
        </div>
        <?php
    }
    require 'include/footer.php';
    