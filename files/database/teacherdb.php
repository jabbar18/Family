<?php

//Include Database Connection Function To Make Connection With Database
include_once("inc/dbconnection.inc.php");

//Create Teacher 
function createTeacher($name, $username, $password){
	establishConnectionToDatabase();

	$query = "insert into teacher (name, user_name, password) value('$name', '$username', '$password');";
	$result = mysqli_query($GLOBALS['link'], $query);

	if($reult){
			$isCreated = mysqli_insert_id($GLOBALS['link']);
	}else{
		$isCreated = false;
	}
	
	mysqli_close($GLOBALS['link']);
	
	return $isCreated;
}

//Update Teacher
function updateTeacher($teacher_id, $name, $username, $password){
	establishConnectionToDatabase();
	
	$query = "update teacher set name = '$name', user_name = '$username', password = '$password' WHERE teacher_id = $teacher_id";
	$result = mysqli_query($GLOBALS['link'], $query);
	
	if(mysqli_affected_rows($GLOBALS['link']) > 0){
		$isUpdated = "Teacher Updated Sucessfully";		
	}else{
		$isUpdated = false;
	}
	
	mysqli_close($GLOBALS['link']);
	return $isUpdated;
}

//Delete Teacher
function deleteTeacher($teacher_id){
	establishConnectionToDatabase();
	
	$query = "DELETE FROM teacher WHERE teacher_id = $teacher_id";
	$result = mysqli_query($GLOBALS['link'], $query);
	
	if(mysqli_affected_rows($GLOBALS['link']) > 0){
		$isDeleted = "Teacher Deleted Sucessfully";		
	}else{
		$isDeleted = false;
	}
	
	mysqli_close($GLOBALS['link']);
	return $isDeleted;
}

//Select All Teachers
function selectAllTeachers(){
	establishConnectionToDatabase();

	$query = "SELECT * FROM teacher";
	$result = mysqli_query($GLOBALS['link'], $query);
	
	if($result){
		$teachers = array();
		
		while($row = mysqli_fetch_array($result)){
			$teacher = array("id"=>$row['teacher_id'], "name"=>$row['name'], "username"=>$row['user_name'], "password"=>$row['password']);
			array_push($teachers, $teacher);
		}
		
		return $teachers;
		
	}
	
	mysqli_close($GLOBALS['link']);
	return $false;
}

?>