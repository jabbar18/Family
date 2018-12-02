<?php
require_once 'db_functions.php';
$db = new DB_Functions();
if (isset($_GET['id'])) {
    // receiving the post params
    $iMemberId = $_GET['id'];
    $todos = $db->addTodo($iMemberId);
    // keeping response header to json
    header('Content-Type: application/json');

    if ($todos != false) {
        // user is found
        $response["error"] = FALSE;

        echo json_encode($response);
    } else {
        // user is not found with the credentials
        $response["error"] = TRUE;
        $response["message"] = "Invalid Username or Password!";
        echo json_encode($response);
    }


}else{
// required post params is missing
    $response["error"] = TRUE;
    echo json_encode($response);
}

