<?php
require_once 'db_functions.php';
$db = new DB_Functions();
if (isset($_GET['id'])) {
    // receiving the post params
    $iMemberId = $_GET['id'];
    $iLatitude = $_GET['lat'];
    $iLongitude = $_GET['lon'];
    $subjects = $db->addLocations($iMemberId, $iLatitude, $iLongitude);
    // keeping response header to json
    header('Content-Type: application/json');

// echoing json result
    echo json_encode($subjects);
}else{
// required post params is missing
    $response["error"] = TRUE;
    echo json_encode($response);
}

