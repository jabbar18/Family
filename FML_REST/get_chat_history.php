<?php
require_once 'db_functions.php';
$db = new DB_Functions();
if (isset($_GET['id'])) {
    // receiving the post params
    $iMemberId = $_GET['id'];
    $sData = $db->getMessages($iMemberId);
    // keeping response header to json
    header('Content-Type: application/json');

// echoing json result
    echo json_encode($sData);
}else{
// required post params is missing
    $response["error"] = TRUE;
    echo json_encode($response);
}

