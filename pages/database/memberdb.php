<?php

//Include Database Connection Function To Make Connection With Database
include_once("inc/dbconnection.inc.php");

//Create member 
function createmember($name, $username, $password){
	establishConnectionToDatabase();

	$query = "insert into member (name, user_name, password) value('$name', '$username', '$password');";
	$result = mysqli_query($GLOBALS['link'], $query);

	if($reult){
			$isCreated = mysqli_insert_id($GLOBALS['link']);
	}else{
		$isCreated = false;
	}
	
	mysqli_close($GLOBALS['link']);
	
	return $isCreated;
}

//Update member
function updatemember($member_id, $name, $username, $password){
	establishConnectionToDatabase();
	
	$query = "update member set name = '$name', user_name = '$username', password = '$password' WHERE member_id = $member_id";
	$result = mysqli_query($GLOBALS['link'], $query);
	
	if(mysqli_affected_rows($GLOBALS['link']) > 0){
		$isUpdated = "member Updated Sucessfully";		
	}else{
		$isUpdated = false;
	}
	
	mysqli_close($GLOBALS['link']);
	return $isUpdated;
}

//Delete member
function deletemember($member_id){
	establishConnectionToDatabase();
	
	$query = "DELETE FROM member WHERE member_id = $member_id";
	$result = mysqli_query($GLOBALS['link'], $query);
	
	if(mysqli_affected_rows($GLOBALS['link']) > 0){
		$isDeleted = "member Deleted Sucessfully";		
	}else{
		$isDeleted = false;
	}
	
	mysqli_close($GLOBALS['link']);
	return $isDeleted;
}

//Select All members
function selectAllmembers(){
	establishConnectionToDatabase();

	$query = "SELECT * FROM member";
	$result = mysqli_query($GLOBALS['link'], $query);
	
	if($result){
		$members = array();
		
		while($row = mysqli_fetch_array($result)){
			$member = array("id"=>$row['member_id'], "name"=>$row['name'], "username"=>$row['user_name'], "password"=>$row['password']);
			array_push($members, $member);
		}
		
		return $members;
		
	}
	
	mysqli_close($GLOBALS['link']);
	return $false;
}

?>