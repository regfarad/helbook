<?php
//connexion_bd.php

// on défini les paramètre de connexion à la DB
$host='localhost';
$user='stud';
$pass='helb';
$db='helbook';

// Définition des variables de connexion
$dsn = "mysql:host=$host;dbname=$db";
$dbh = null;
//**************************************
// connexion à mysql et à la db
//**************************************
try 
{
	$dbh = new PDO($dsn, $user, $pass); //db handle
	$dbh->exec("SET CHARACTER SET utf8");
} 
catch (PDOException $e) 
{
	die( "Erreur ! : " . $e->getMessage() );
}