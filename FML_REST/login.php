<?php

require_once 'db_functions.php';
$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);
 
if (isset($_GET['username']) && isset($_GET['password'])) {
 
    // receiving the post params
    $username = $_GET['username'];
    $password = $_GET['password'];

    // POST the user by email and password
    $user = $db->getUserByUsernameAndPassword($username, $password);
 
    if ($user != false) {
        // user is found
        $response["error"] = FALSE;
        $response["name"] = $user["UserName"];
        $response["id"] = $user["MemberId"];
        
        echo json_encode($response);
    } else {
        // user is not found with the credentials
        $response["error"] = TRUE;
        $response["message"] = "Invalid Username or Password!";
        echo json_encode($response);
    }
} else {
    // required post params is missing
    $response["error"] = TRUE;
    $response["message"] = "Required parameters username or password is missing!";
    echo json_encode($response);
}

?>