<?php
require_once 'db_functions.php';
$db = new DB_Functions();
if (isset($_POST['user_id'])) {
    // receiving the post params
    $user_id = $_POST['user_id'];
    $subjects = $db->getSubjects($user_id);
    // keeping response header to json
    header('Content-Type: application/json');

// echoing json result
    echo json_encode($subjects);
}else{
// required post params is missing
    $response["error"] = TRUE;
    echo json_encode($response);
}

