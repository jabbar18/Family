<?php

//Include Database Connection Function To Make Connection With Database
include("inc/dbconnection.inc.php");

//Update User
function updateUser($user_id, $userName, $password){
	establishConnectionToDatabase();
	
	$query = "UPDATE admin SET user_name = '$userName', password = '$password' WHERE admin_id = $user_id;";
	
	$result = mysqli_query($GLOBALS['link'], $query);
	
	if(mysqli_affected_rows($GLOBALS['link']) > 0){
		$isUpdated = true;
	}else{
		$isUpdated = false;
	}
	
	mysqli_close($GLOBALS['link']);
	return $isUpdated;
}

//Select Specific User with username And password
function selectUser($userName, $password){
	establishConnectionToDatabase();

	$query = "SELECT * FROM admin WHERE user_name = '$userName' AND password = '$password'";
	$result = mysqli_query($GLOBALS['link'], $query);

	die("here");
	
	$user = false;
	
	if($result){
		if($row = mysqli_fetch_array($result)){
			$user = array("id"=>$row['admin_id'], "username"=>$row['user_name'], "password"=>$row['password']);
		}
	}
	
	echo mysqli_error($GLOBALS['link']);
	
	mysqli_close($GLOBALS['link']);
	return $user;
}

//Select Specific User with username And password
function isUserValid($userName, $password){
	establishConnectionToDatabase();

	$query = "SELECT * FROM admin WHERE user_name = '$userName' AND password = '$password'";

	$result = mysqli_query($GLOBALS['link'], $query);

	$row = mysqli_fetch_array($result);
	
	if(!empty($row['admin_id'])){
		mysqli_close($GLOBALS['link']);	
		return true; //If UserName AND Password Is Correct Then return True
	}
	
	mysqli_close($GLOBALS['link']);
	return false;
}
?>