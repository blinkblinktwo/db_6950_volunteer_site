<?php

 // Open a connection via PDO to create a new database and table with structure.
 // WARNING: Running this will drop and make anew the volunteer database if it exists!!!
 // WARNING: The drop command is stored in the init.sql file.

require "config.php";

try 
{
	$connection = new PDO("mysql:host=$host", $username, $password, $options);
	$sql = file_get_contents("data/init.sql");
	$connection->exec($sql);
	
	echo "Database and table(s) created.";
}

catch(PDOException $error)
{
	echo $sql . "<br>" . $error->getMessage();
}