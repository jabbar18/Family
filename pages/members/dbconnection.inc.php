<?php
function establishConnectionToDatabase(){
	global $link;

	$DB_USER_NAME = "root";
	$DB_PASSWORD = "";
	$DB_HOST = "localhost";
	$DB_NAME = "family";

	$link = mysqli_connect($DB_HOST, $DB_USER_NAME, $DB_PASSWORD, $DB_NAME) ;

       if ($link->connect_error) {
    die("Connection failed: " . $link->connect_error);
} 
}

