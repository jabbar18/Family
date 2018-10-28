<?php

//Include Database Connection Function To Make Connection With Database
include_once("inc/dbconnection.inc.php");

//Select All Subjects
function selectSubjectReport($subject_id, $teacher_id){
	establishConnectionToDatabase();

	$query = "select st.name, st.roll_number, a.attendence_year, count(st.roll_number) as report from attendence a left join student st on a.student_id = st.student_id WHERE a.subject_id = $subject_id AND a.teacher_id = $teacher_id group by a.attendence_year, st.name order by attendence_year DESC";
	$result = mysqli_query($GLOBALS['link'], $query);

	if($result){
		$reports = array();
		
		while($row = mysqli_fetch_array($result)){
			$report = array("name"=>$row['name'], "roll_number"=>$row['roll_number'], "year"=>$row['attendence_year'], "report"=>$row['report'],);
			array_push($reports, $report);	
		}
		
		return $reports;
		
	}
	
	mysqli_close($GLOBALS['link']);
	return false;
}

//Select All Subjects
function selectStudentCompleteReport($student_id){
	establishConnectionToDatabase();

	$query = "select s.title, count(a.student_id) as report, a.attendence_year, a.semester from attendence a left join subject s on a.subject_id = s.subject_id WHERE a.student_id = $student_id group by s.title,  a.semester order by semester asc";
	$result = mysqli_query($GLOBALS['link'], $query);

	if($result){
		$subjects = array();
		
		while($row = mysqli_fetch_array($result)){
			$subject = array("title"=>$row['title'], "report"=>$row['report'], "year"=>$row['attendence_year'], "semester"=>$row['semester'],);
			array_push($subjects, $subject);	
		}
		
		return $subjects;
		
	}
	
	mysqli_close($GLOBALS['link']);
	return false;
}
?>