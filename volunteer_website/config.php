<?php

// This file stores our information to connect the page to our MYSQL database named "volunteer".
// Though dangerous, our default password for root is blank for this test website.

$host       = "localhost";
$username   = "root";
$password   = "";
$dbname     = "volunteer";
$dsn        = "mysql:host=$host;dbname=$dbname";
$options    = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
              );