<?php

require_once 'db_functions.php';
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['teacher_id']) && isset($_POST['student_id']) && isset($_POST['subject_id']) && isset($_POST['semester'])) {

    $teacher_id = $_POST['teacher_id'];
    $student_id = $_POST['student_id'];
    $subject_id = $_POST['subject_id'];
    $semester = $_POST['semester'];
    $date = date('m/d/Y');
    $year = date('Y');
    $student_name = $db->getStudentName_Id($student_id);
    // check if user can add attendance

    if($db->canMarkAttendance($teacher_id, $subject_id, $student_id, $date)) {
        $result = $db->markAttendance($teacher_id, $student_id,$subject_id,$date,$year,$semester);

        if ($result) {


            // success
            $response["error"] = FALSE;
            $response["message"] = $student_name." Your attendance marked successfully!";

            echo json_encode($response);
        } else {
            // some sort of sql error
            $response["error"] = TRUE;
            $response["message"] = "Invalid parameters!";
            echo json_encode($response);
        }
    }else{
        $response["error"] = TRUE;
        $response["message"] = $student_name. " your attendance is already marked!"; //show name here
        echo json_encode($response);
    }



} else {
    // required post params is missing
    $response["error"] = TRUE;
    $response["message"] = "Required parameters missing!";
    echo json_encode($response);
}

