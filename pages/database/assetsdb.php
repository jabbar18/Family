<?php

//Include Database Connection Function To Make Connection With Database
include_once("inc/dbconnection.inc.php");

//Create Subject 
function createSubject($title){
	establishConnectionToDatabase();

	$query = "INSERT INTO subject (title) VALUES('$title')";
	$result = mysqli_query($GLOBALS['link'], $query);

	if($result){
			$isCreated = "Subject Created Sucessfully";
	}else{
		$isCreated = false;
	}
	
	mysqli_close($GLOBALS['link']);
	
	return $isCreated;
}

//Create Department 
function createDepartment($title){
	establishConnectionToDatabase();

	$query = "INSERT INTO department (title) VALUES('$title')";
	$result = mysqli_query($GLOBALS['link'], $query);

	if($reult){
			$isCreated = "Department Created Sucessfully";
	}else{
		$isCreated = false;
	}
	
	mysqli_close($GLOBALS['link']);
	
	return $isCreated;
}

//Assign Subject To member 
function assignSubjectTomember($member_id, $subject_id){
	establishConnectionToDatabase();

	$query = "insert into member_has_subjects (member_id, subject_id) value($member_id, $subject_id)";
	$result = mysqli_query($GLOBALS['link'], $query);

	if($result){
			$isAssigned = "Subject Assigned Sucessfully";
	}else{
		$isAssigned = false;
	}
	
	mysqli_close($GLOBALS['link']);
	
	return $isAssigned;
}

//Delete Subjecct
function deleteSubject($subject_id){
	establishConnectionToDatabase();
	
	$query = "DELETE FROM subject WHERE subject_id = $subject_id";
	$result = mysqli_query($GLOBALS['link'], $query);
	
	if(mysqli_affected_rows($GLOBALS['link']) > 0){
		$isDeleted = "Subject Deleted Sucessfully";		
	}else{
		$isDeleted = false;
	}
	
	mysqli_close($GLOBALS['link']);
	return $isDeleted;
}

//Delete Department
function deleteDepartment($department_id){
	establishConnectionToDatabase();
	
	$query = "DELETE FROM department WHERE department_id = $department_id";
	$result = mysqli_query($GLOBALS['link'], $query);
	
	if(mysqli_affected_rows($GLOBALS['link']) > 0){
		$isDeleted = "Department Deleted Sucessfully";		
	}else{
		$isDeleted = false;
	}
	
	mysqli_close($GLOBALS['link']);
	return $isDeleted;
}

//Delete Assigned Subject From member
function deleteSubjectFrommember($member_id, $subject_id){
	establishConnectionToDatabase();
	
	$query = "DELETE FROM member_has_subjects WHERE member_id = $member_id AND subject_id = $subject_id";
	$result = mysqli_query($GLOBALS['link'], $query);
	
	if(mysqli_affected_rows($GLOBALS['link']) > 0){
		$isDeleted = "Department Deleted Sucessfully";		
	}else{
		$isDeleted = false;
	}
	
	mysqli_close($GLOBALS['link']);
	return $isDeleted;
}

//Select All Subjects
function selectAllSubjects(){
	establishConnectionToDatabase();

	$query = "SELECT subject_id, title FROM subject";
	$result = mysqli_query($GLOBALS['link'], $query);
	
	if($result){
		$subjects = array();
		
		while($row = mysqli_fetch_array($result)){
			$subject = array("id"=>$row['subject_id'], "title"=>$row['title']);
			array_push($subjects, $subject);	
		}
		
		return $subjects;
		
	}
	
	mysqli_close($GLOBALS['link']);
	return false;
}

//Select All Departments
function selectAllDepartments(){
	establishConnectionToDatabase();

	$query = "SELECT department_id, title FROM department";
	$result = mysqli_query($GLOBALS['link'], $query);
	
	if($result){
		$subjects = array();
		
		while($row = mysqli_fetch_array($result)){
			$subject = array("id"=>$row['department_id'], "title"=>$row['title']);
			array_push($subjects, $subject);	
		}
		
		return $subjects;
		
	}
	
	mysqli_close($GLOBALS['link']);
	return false;
}

//Select All members With their subjects
function selectmembersAndTheirSubjects(){
	establishConnectionToDatabase();

	$query = "select t.member_id, s.subject_id, t.name, s.title from member_has_subjects ths join member t on ths.member_id = t.member_id join subject s on ths.subject_id = s.subject_id";
	$result = mysqli_query($GLOBALS['link'], $query);
	
	if($result){
		$membersAndSubjects = array();
		
		while($row = mysqli_fetch_array($result)){
			$data = array("member_id"=>$row['member_id'],"subject_id"=>$row['subject_id'], "name"=>$row['name'], "title"=>$row['title']);
			array_push($membersAndSubjects, $data);	
		}
		
		return $membersAndSubjects;
		
	}
	
	mysqli_close($GLOBALS['link']);
	return false;
}

?>