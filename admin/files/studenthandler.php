<?php

include ("./database/studentdb.php");

if(isset($_POST['m'])){
	$mode = $_POST['m'];
}else{
	$mode = $_GET['m'];
}

//If Request is to Create An New Student
if($mode == 's'){
	
	$name = $_POST['name'];
	$cast = $_POST['cast'];
	$fatherName = $_POST['fathername'];
	$rollNumber = $_POST['rollnumber'];
	$year = $_POST['year'];
	$address = $_POST['address'];
	$department_id = $_POST['department_id'];

	$student_id = createStudent($name, $cast, $fatherName, $rollNumber, $year, $address, $department_id);

	if($student_id){
		include ("./qrcode_generator/qrlib.php");
		
		QRcode::png($student_id, "../qrcode_images/" .base64_encode($student_id) .".png", QR_ECLEVEL_L, 10);
		
		addQrCode($student_id, "/qrcode_images/" .base64_encode($student_id) .".png");

		header("location: ../students.php?m=Student Created Successfully");
	}else{
		header("location: ../students.php?m=Student Not Successfully");
	}
}

//If Request is to Delete An Tournament
else if($mode == 'd'){
	$student_id = $_GET['studentid'];
	deleteStudent($student_id);

	$student_id = base64_encode($student_id);
	unlink("../qrcode_images/$student_id.png");

	header("location: ../students.php?m=Student Deleted Successfully");
}

//If Request is To Update An Tournament
else if($mode == 'u'){

	$tournamentId = $_POST["tid"];

	//If User Have Uploaded An Cover Image.
	if(isFileUploaded("cover")){	
		
		//Move Image To new Location
		//Insert Image Path in to database
		
		$fileName = basename($_FILES["cover"]["name"]);
		//$fileExtension = pathinfo($_FILES["cover"]["tmp_name"],PATHINFO_EXTENSION);
		$src = $_FILES['cover']['tmp_name'];
		$des = "./images/uploaded/" .$fileName;
		
		move_uploaded_file($src, '.'.$des);
		updateTournament($tournamentId, $title, $date, $description, $des, $max_members, $game_id);
		header("location: ../Tournament.php");
		
		return;
	}
	
	updateTournament($tournamentId, $title, $date, $description, "", $max_members, $game_id);
	header("location: ../Tournament.php");
}
//If Request for Update Page(up) then redirect to Update Event Page
else if($mode == 'up'){
	
	$eid = $_GET['eid'];
	$paramString = selectEvent($eid);
	
	header("location: ../UpdateEvent.php$paramString");
}
//If Tournament is Done
else if($mode == 'td'){

	$tid = $_GET['tid'];
	$status = $_GET['s'];
	$isUpdated = updateTournamentState($tid, $status);
	
	header("location: ../Tournament.php");
}
//Upload Event Gallery Images
else if($mode == 'tgu'){

	$tid = $_POST['tid'];
	foreach ($_FILES['files']['name'] as $f => $name) {     
	    if ($_FILES['files']['error'][$f] == 0) {
			$src = $_FILES['files']['tmp_name'][$f];
			$des = "./images/uploaded/" .$name;
			
			move_uploaded_file($src, '.'.$des);
			insertImageInTournamentGallery($tid, $des);
		}
	}
	
	header("location: ../TournamentSummery.php?tid=" .$tid);
}
//Delete Particular Image From Event Gallery
else if($mode == "tgd"){

	$imgid = $_GET['imgid'];
	$tid = $_GET['tid'];
	deleteImageFromGallery($imgid);
	
	header("location: ../Tournamentsummery.php?tid=" .$tid);

}
?>