<?php
/*
	Some Short-cuts used in this file.
	
	m = MODE
	s = SAVE
	u = UPDATE
	d = DELETE
*/

//Include Event Database Functions
include ("./database/AssetsDB.php");

if(isset($_POST['m'])){
	$mode = $_POST['m'];
}else{
	$mode = $_GET['m'];
}

//If Request is to Create Subject
if($mode == 'ss'){

	$title = $_POST['title'];

	createSubject($title);
	header("location: ../assets.php?m=Subject Created Successfully");
}
//If Request is to Create Departmenet
else if($mode == 'sd'){
	$title = $_POST['title'];

	createDepartment($title);
	header("location: ../assets.php?m=Department Created Successfully");
}

//If Request is to Assign Subject To member
else if($mode == 'as'){

	$member_id = $_POST['memberid'];
	$subject_id = $_POST['subjectid'];

	assignSubjectTomember($member_id, $subject_id);
	
	header("location: ../assets.php?m=Subject Assigned Successfully");
}

//If Request is To Delete Subject
else if($mode == 'ds'){

	$subject_id = $_GET["subjectid"];

	deleteSubject($subject_id);
	header("location: ../assets.php?m=Subject Deleted Successfully");
}

//If Request is To Delete Subject from member
else if($mode == 'rs'){

	$subject_id = $_GET["subjectid"];
	$member_id = $_GET["memberid"];

	deleteSubjectFrommember($member_id, $subject_id);
	header("location: ../assets.php?m=Subject Un-Assinged Successfully");
}

//If Request is To Delete Subject
else if($mode == 'dd'){

	$department_id = $_GET["departmentid"];

	deleteDepartment($department_id);
	header("location: ../assets.php?m=Department Deleted Successfully");
}
?>