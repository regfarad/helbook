<?php
require './include/message_func.php';
require './include/header.php';
require './menu_membre.php';
?>
<h3 style="color:white; font-weight: bolder; background-color:midnightblue; padding-left: 10px;"><center>Contenu de votre message reçu</center></h3>
<?php
$messages = recup_message();
foreach ($messages as $message) {
    ?>
    <div class="messages">
        <p>Envoyé par : 
            <a href="index.php?page=profil_membre&pseudo=<?php echo $message['pseudo']; ?>">
                <?php echo $message['pseudo']; ?> 
            </a>
            <br>Le <?php echo date('d/m/Y à H:i:s', strtotime($message['date_message'])); ?></p>
        <img src="<?php echo $message['img_profil']; ?>"  height="70" width="70" class="img-rounded">
        <p>" <em><?php echo $message['corps_message']; ?></em> "</p>
    </div>
    <br>
    <center>
        <a href="index.php?page=new_message&pseudo=<?php echo $message['pseudo_exp'];?>">
            <input type="button" onClick="document.location='index.php?page=new_message&pseudo=<?php echo $message['pseudo_exp'];?>'"class="btn btn-info" value="Répondre à <?php echo $message['pseudo_exp']; ?>"/>
        </a>
    </center>

    <?php
}
