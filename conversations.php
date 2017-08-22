<?php
require './include/conversations_func.php';
require './include/header.php';
require './menu_membre.php';

?>


<h3 style="color:white; font-weight: bolder; background-color:midnightblue; padding-left: 10px;"><center>Vos Messages reçus</center></h3>
<?php
$conversations = recup_conversation();
if ($conversations == true) {
    foreach ($conversations as $conversation) {
        ?>
        <div class="conversation">
            <h4> Expéditeur : <a href="index.php?page=profil_membre&pseudo=<?php echo $conversation['pseudo']; ?>"> <?php echo $conversation['pseudo']; ?> </a></h4>
            <a href="index.php?page=profil_membre&pseudo=<?php echo $conversation['pseudo']; ?>"><img src="<?php echo $conversation['img_profil']; ?>"  height="70" width="70" class="img-rounded"></a>
            <p><a href="index.php?page=message&id=<?php echo $conversation['id_conversation']; ?>">Sujet : <?php echo $conversation['sujet']; ?></a></p>
            <p style="color: white;">Posté le : <?php echo date("d/m/Y à H:i:s",  strtotime($conversation['date_message'])); ?></p>
        </div>
        <?php
    }
} else {
    ?>
    <h4 style="color: red; font-weight: bolder;">Vous n'avez pas de messages ...</h4>
    <?php
}
