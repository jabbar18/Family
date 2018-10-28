<?php

//Include Database Connection Function To Make Connection With Database
include_once("inc/dbconnection.inc.php");

//Select All Subjects
function selectAllSubjects($teacher_id){
	establishConnectionToDatabase();

	$query = "select sb.subject_id, sb.title from subject sb join teacher_has_subjects ths on sb.subject_id = ths.subject_id WHERE ths.teacher_id = $teacher_id";
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


//Select All Subjects
function selectSubjectsAttendence($subject_id, $teacher_id){
	establishConnectionToDatabase();

	$query = "SELECT st.student_id, st.roll_number, st.name, d.title as department_title, st.year, a.semester, a.date, a.attendence_year FROM attendence a join student st on a.student_id = st.student_id left join department d on st.department_id = d.department_id WHERE a.subject_id = $subject_id and a.teacher_id = $teacher_id order by a.date DESC";
	$result = mysqli_query($GLOBALS['link'], $query);

	if($result){
		$subjects = array();
		
		while($row = mysqli_fetch_array($result)){
			$subject = array( "id"=>$row['student_id'], "roll_number"=>$row['roll_number'],  "name"=>$row['name'], "title"=>$row['department_title'], "year"=>$row['attendence_year'], "semester"=>$row['semester'], "date"=>$row['date']);
			array_push($subjects, $subject);	
		}
		
		return $subjects;
		
	}
	
	mysqli_close($GLOBALS['link']);
	return false;
}
?>