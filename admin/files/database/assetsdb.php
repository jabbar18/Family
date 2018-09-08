<?php

//Include Database Connection Function To Make Connection With Database
include_once("inc/dbconnection.inc.php");

//Create Subject 
function createSubject($title){
	establishConnectionToDatabase();

	$query = "INSERT INTO subject (title) VALUES('$title')";
	$result = mysqli_query($GLOBALS['link'], $query);

	if($reult){
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

//Assign Subject To Teacher 
function assignSubjectToTeacher($teacher_id, $subject_id){
	establishConnectionToDatabase();

	$query = "insert into teacher_has_subjects (teacher_id, subject_id) value($teacher_id, $subject_id)";
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

//Delete Assigned Subject From Teacher
function deleteSubjectFromTeacher($teacher_id, $subject_id){
	establishConnectionToDatabase();
	
	$query = "DELETE FROM teacher_has_subjects WHERE teacher_id = $teacher_id AND subject_id = $subject_id";
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

//Select All Teachers With their subjects
function selectTeachersAndTheirSubjects(){
	establishConnectionToDatabase();

	$query = "select t.teacher_id, s.subject_id, t.name, s.title from teacher_has_subjects ths join teacher t on ths.teacher_id = t.teacher_id join subject s on ths.subject_id = s.subject_id";
	$result = mysqli_query($GLOBALS['link'], $query);
	
	if($result){
		$teachersAndSubjects = array();
		
		while($row = mysqli_fetch_array($result)){
			$data = array("teacher_id"=>$row['teacher_id'],"subject_id"=>$row['subject_id'], "name"=>$row['name'], "title"=>$row['title']);
			array_push($teachersAndSubjects, $data);	
		}
		
		return $teachersAndSubjects;
		
	}
	
	mysqli_close($GLOBALS['link']);
	return false;
}

?>