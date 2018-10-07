<?php

require_once 'db_functions.php';
$db = new DB_Functions();

// json response array
$response = array("error" => FALSE);

if (isset($_POST['data'])) {

    // receiving the post params
    $data = $_POST['data'];

    $data_array = explode(',', $data);

    if(count($data_array) != 1){
        $username = base64_decode($data_array[0]);
        $password  = base64_decode($data_array[1]);

      //  echo "username:" .$username." <br /> pass: ".$password."<br/>";



        // POST the user by email and password
        $user = $db->getUserByUsernameAndPassword($username,$password);

        if ($user != false) {
            // user is found
            $response["error"] = FALSE;
            $response["user"]["name"] = $user["name"];
            $response["user"]["user_name"] = $user["user_name"];
            $response["user"]["id"] = $user["teacher_id"];

            echo json_encode($response);
        } else {
            // user is not found with the credentials
            $response["error"] = TRUE;
            $response["message"] = "Invalid Username or Password!";
            echo json_encode($response);
        }
    }else{
        $response["error"] = TRUE;
        $response["message"] = "Invalid QR code!";
        echo json_encode($response);
    }


} else {
    // required post params is missing
    $response["error"] = TRUE;
    $response["message"] = "Required parameters username or password is missing!";
    echo json_encode($response);
}

?>