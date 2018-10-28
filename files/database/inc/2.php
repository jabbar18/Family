<?php
function establishConnectionToDatabase(){
	global $link;

	$DB_USER_NAME = "b6_17179994";
	$DB_PASSWORD = "123jabbarHamna";
	$DB_HOST = "sql309.byethost6.com";
	$DB_NAME = "b6_17179994_qras";

	$link = mysqli_connect($DB_HOST, $DB_USER_NAME, $DB_PASSWORD, $DB_NAME) ;
}

