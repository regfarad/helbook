<?php
require './include/refuser_func.php';
refuser_invitation();
header("Location: index.php?page=invitations");

