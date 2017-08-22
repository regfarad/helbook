<?php
require './connexion_bd.php';
require './include/header.php';
require './include/tchat_func.php';
require './include/new_message_func.php';
require './menu_membre.php';
if (!isset($_GET['pseudo']) && empty($_GET['pseudo']) && pseudo_incorrect() == "1") {
    header("Location: index.php?page=compte");
}
$_SESSION['user']['pseudo'] = $_GET['pseudo'];
?>


<?php
$users = get_user();
foreach ($users as $user) {
    ?>
        <!--    <h3 style="color:midnightblue; font-weight: bolder;" class=""><?php echo $user['pseudo']; ?><hr></h3>-->
    <h3 style="color:white; font-weight: bolder; background-color:midnightblue; padding-left: 10px;">
        <center>Chat en direct avec <?php echo $user['pseudo']; ?> 
            <h6><a href="index.php?page=historique&pseudo=<?php echo $user['pseudo']; ?>"><em>Historique des conversations</em></a></h6>
        </center>
    </h3>   

    <div class="messages-box"></div>

    <div class="bottom">
        <div class="field field-area">
            <label for="message" class="field-label">Votre message</label>
            <textarea name="message" id="message" rows="2" class="field-input field-textarea"></textarea>  
        </div>

        <button type="submit" id="send" class="send">
            <span class="icon-mail"></span>
        </button>

    </div>
    <?php
}
