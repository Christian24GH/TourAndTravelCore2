<?php
    $dbname = 'core2';
    $dbhost = 'localhost';
    $dbport = '3306';
    $dbusername = 'root';
    $dbpassword = '';

    $connections = new mysqli($dbhost, $dbusername, $dbpassword, $dbname, $dbport);

    if(mysqli_connect_error()){
        die("Cant connect to $dbname: " . mysqli_connect_error());
    }
	$connections->select_db($dbname);
