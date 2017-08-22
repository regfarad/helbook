<?php
require 'include/supprimer_ami_func.php';
supprimer_ami();
header("Location: index.php?page=amis");
