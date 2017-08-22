<?php
require './include/new_message_func.php';
require './include/header.php';
require './menu_membre.php';

if (isset($_GET['pseudo']) && !empty($_GET['pseudo']) && pseudo_incorrect() == "1") {
    if (isset($_POST['submit'])) {
        $sujet = $_POST['sujet'];
        $message = $_POST['message'];
        if (!empty($message)) {
            creer_conversation($sujet, $message);
            ?>
            <h4 style="color: green; font-weight: bolder;">Votre message a bien été envoyé</h4>
            <?php
        } else {
            ?>
            <h4 style="color: red; font-weight: bolder;">Le message est obligatoire ...</h4>
            <?php
        }
    }
} 
//    header("Location: index.php?page=compte");
//}
?>
<h3 style="color:white; font-weight: bolder; background-color:midnightblue; padding-left: 10px;">Envoyer un message</h3>
<form class="form-horizontal col-lg-9" role="form" method="POST" action="">
    <div class="form-group col-lg-5">
        <label for="a">à : </label>
        <input type="text" class="form-control" name="a" id="a" value="<?php echo $_GET['pseudo']; ?>" disabled="disabled"/> <br>

        <label for="sujet">Sujet : </label>
        <input type="text" class="form-control" name="sujet" id="sujet"/> <br>

        <label for="message">Votre message : </label><br>
        <textarea rows='6' cols="52" class="form-control" name="message" id="message"></textarea> <br><br>

        <input type="submit" class="btn btn-info" role="button" name="submit" value="Envoyer">

    </div>
</form>
