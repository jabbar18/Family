<?php

//Include Database Connection Function To Make Connection With Database
include_once("inc/dbconnection.inc.php");

//Create Student
function createStudent($name, $cast, $fatherName, $rollNumber, $year, $address, $department_id){
	establishConnectionToDatabase();

	$query = "insert into student (name, cast, father_name, roll_number, year, address, department_id) value('$name', '$cast', '$fatherName', '$rollNumber', '$year', '$address', $department_id)";
	$result = mysqli_query($GLOBALS['link'], $query);

	if($result){
			$isCreated = mysqli_insert_id($GLOBALS['link']);
	}else{
		$isCreated = false;
	}
	
	mysqli_close($GLOBALS['link']);
	
	return $isCreated;
}


//Select All Students
function selectAllStudents(){
	establishConnectionToDatabase();

	$query = "select *, d.title from student left join department d on student.department_id = d.department_id";
	$result = mysqli_query($GLOBALS['link'], $query);
	
	if($result){
		$students = array();
		
		while($row = mysqli_fetch_array($result)){
			$student = array("id"=>$row['student_id'], "name"=>$row['name'], "address"=>$row['address'], "cast"=>$row['cast'], "fathername"=>$row['father_name'], "rollnumber"=>$row['roll_number'], "department"=>$row['title'], "qrcode"=>$row['qrcode_image'],  "year"=>$row['year']);
			array_push($students, $student);	
		}
		
		return $students;
		
	}
	
	mysqli_close($GLOBALS['link']);
	return false;
}

//Delete Student
function deleteStudent($student_id){
	establishConnectionToDatabase();
	
	$query = "DELETE FROM student WHERE student_id = $student_id";
	$result = mysqli_query($GLOBALS['link'], $query);
	
	if(mysqli_affected_rows($GLOBALS['link']) > 0){
		$isDeleted = "Student Deleted Sucessfully";		
	}else{
		$isDeleted = false;
	}
	
	mysqli_close($GLOBALS['link']);
	return $isDeleted;
}

//Delete Student
function addQrCode($student_id, $qrcode_image){
	establishConnectionToDatabase();
	
	$query = "UPDATE student SET qrcode_image = '$qrcode_image' WHERE student_id = $student_id";
	$result = mysqli_query($GLOBALS['link'], $query);
	
	if(mysqli_affected_rows($GLOBALS['link']) > 0){
		$isCreated = "Student Created Sucessfully";		
	}else{
		$isCreated = false;
	}
	
	mysqli_close($GLOBALS['link']);
	return $isCreated;
}

?>