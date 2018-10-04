<?php
/*
	Some Short-cuts used in this file.
	
	m = MODE
	s = SAVE
	u = UPDATE
	d = DELETE
*/

//Include Event Database Functions
include ("./database/TeacherDB.php");

if(isset($_POST['m'])){
	$mode = $_POST['m'];
}else{
	$mode = $_GET['m'];
}

//If Request is to Create An New Event
if($mode == 's'){

	$name = $_POST['name'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];


	if($password == $cpassword){
		createTeacher($name, $username, $password);
		header("location: ../teachers.php?m=Teacher Created Sucessflly");
	}else{
		header("location: ../teachers.php?m=Password And Confirm Password Did Not Match");
	}
}

//If Request is to Delete An Event
else if($mode == 'd'){
	$teacher_id = $_GET['teacherid'];
	deleteTeacher($teacher_id);
	header("location: ../teachers.php?m=Teacher Deleted Successfully");
}

//If Request is To Update An Event
else if($mode == 'u'){

	$eventId = $_POST["eid"];

	//If User Have Uploaded An Cover Image.
	if(isFileUploaded("cover")){	
		
		//Move Image To new Location
		//Insert Image Path in to database
		
		$fileName = basename($_FILES["cover"]["name"]);
		//$fileExtension = pathinfo($_FILES["cover"]["tmp_name"],PATHINFO_EXTENSION);
		$src = $_FILES['cover']['tmp_name'];
		$des = "./images/uploaded/" .$fileName;
		
		move_uploaded_file($src, '.'.$des);
		updateEvent($eventId, $title, $date, $description, $des);
		header("location: ../Event.php");
		
		return;
	}
	
	updateEvent($eventId, $title, $date, $description, "");
	header("location: ../Event.php");
}
?>