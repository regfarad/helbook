<?php
require '../connexion_bd.php';

session_start();
$user = $_SESSION['user']['pseudo'];
$membre = $_SESSION['auth']['pseudo'];


if (!isset($dbh)) {
    global $dbh;
}

$infos = array();

$sql = "SELECT * FROM tchat WHERE (sender = :sender AND receiver = :receiver) OR (receiver = :sender AND sender = :receiver) ORDER BY date DESC limit 7";
$req = $dbh->prepare($sql);
$req->bindParam(':sender', $membre, PDO::PARAM_STR);
$req->bindParam(':receiver', $user, PDO::PARAM_STR);
$req->execute();

while ($row = $req->fetch(PDO::FETCH_ASSOC)) {
    $infos[] = $row;
}


foreach ($infos as $info) {
    ?>
    <div class="message <?php echo ($info['sender'] == $membre) ? 'message-membre' : 'message-user'; ?>">
        <?php echo $info['message']; ?>
        <p style="font-size: smaller; font-style: italic">Envoyé par 
            <?php
            if ($info['sender'] == $membre) {
                echo $info['sender'] . " le " . date("d/m/Y à H:i:s", strtotime($info['date']));
            } else {
                echo $info['sender'] . " le " . date("d/m/Y à H:i:s", strtotime($info['date']));
            }
            ?> 
        </p>
    </div>
    <br><br>
    <?php
}
