<?php
require_once 'db_functions.php';
$db = new DB_Functions();
if (isset($_GET['id'])) {
    // receiving the post params
    $iMemberId = $_GET['id'];
    $iPollId = $_GET['pid'];
    $iAnswerId = $_GET['aid'];
    $votes = $db->addVote($iMemberId, $iPollId, $iAnswerId);
    // keeping response header to json
    header('Content-Type: application/json');

    if ($votes != false) {
        // user is found
        $response["error"] = FALSE;

        echo json_encode($response);
    } else {
        // user is not found with the credentials
        $response["error"] = TRUE;
        $response["message"] = "Unable to Vote!";
        echo json_encode($response);
    }


}else{
// required post params is missing
    $response["error"] = TRUE;
    echo json_encode($response);
}
