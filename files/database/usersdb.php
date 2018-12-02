<?php

//Include Database Connection Function To Make Connection With Database
include("inc/dbconnection.inc.php");

//Update User
function updateUser($user_id, $userName, $password){
	establishConnectionToDatabase();
	
	$query = "UPDATE teacher SET user_name = '$userName', password = '$password' WHERE teacher_id = $user_id;";
	
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
function selectAdmin($userName, $password){
	establishConnectionToDatabase();

	$query = "SELECT * FROM members WHERE UserName = '$userName' AND Password = '$password'";
	$result = mysqli_query($GLOBALS['link'], $query);
	
	$user = false;
	
	if($result){
		if($row = mysqli_fetch_array($result)){
			$user = array("id"=>$row['MemberId'], "username"=>$row['UserName'], "MemberName"=>$row['MemberName'], "Admin"=>$row['Admin'], "Photo"=>$row['Photo']);
		}
	}
	
	echo mysqli_error($GLOBALS['link']);
	
	mysqli_close($GLOBALS['link']);
	return $user;
}
?>