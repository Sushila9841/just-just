<?php
//server name 
	$server ='mysql';
//username
	$username = 'student';
// password
	$password = 'student';
//dbname 
	$dbname = 'cars';
// To connect to the database
	$pdo = new PDO("mysql:host=$server; dbname=$dbname", $username, $password);
    ?>