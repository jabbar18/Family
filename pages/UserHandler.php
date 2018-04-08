<?php


//Include Event Database Functions
include ("./database/usersdb.php");

//Get Mode Values From Post Or Get Method
$mode = $_POST['m'];
//If Mode Is to Login The User
if($mode == 'login'){

    $userName = $_POST['username'];
    $oldPassword  = $_POST['password'];

    $accountType = $_POST['account'];


        $user = selectAdmin($userName, $oldPassword); //Search For User in database, If user found Then Return its Information or Else return false;

        if($user){ //If User Is Found
            session_start(); //Start Session

            $_SESSION['id'] = $user['id']; //Put UserId In Session
            $_SESSION['username'] = $user['username']; //Put UserName In Session

            header("location: ../pages/Members.php"); //Redirect To Event Page
        }else{
            header("location: ../index.php?m=User Name Or Passwrod Is Not Correct"); //Redirect To Event Page
        }


}
//If Mode Is to Login The User With Qr Code
if($mode == 'ql'){

    $encoded_data = $_POST['data'];

    $data_array = explode(',', $encoded_data);

    if(count($data_array) == 1){
        echo 'n';
        exit();
    }

    $userName = base64_decode($data_array[0]);
    $oldPassword  = base64_decode($data_array[1]);

    $user = selectUser($userName, $oldPassword); //Search For User in database, If user found Then Return its Information or Else return false;

    if($user){ //If User Is Found
        session_start(); //Start Session

        $_SESSION['id'] = $user['id']; //Put UserId In Session
        $_SESSION['username'] = $user['username']; //Put UserName In Session
        echo 'd';
    }else{
        echo 'n';
    }
}
//If Mode Is To Update The User
else if($mode =='uu'){

    $userName = $_POST['username'];
    $oldPassword = $_POST['password'];
    $nPassword = $_POST['npassword'];
    $cnPassword = $_POST['cpassword'];

    $isUserValid = isUserValid($userName, $oldPassword); //Check Whether User Is Valid Or Not

    //echo "userName: $userName password: $oldPassword";

    if($isUserValid){ //If User Is Valid Then
        if($nPassword == $cnPassword){ //Check That new Password is equal To confirm new Password

            session_start();
            $userUpdated = updateUser($_SESSION['id'], $userName, $nPassword); //Update user, if Successful then return true or else return false

            if($userUpdated){ //if User Updated Successfully
                header('location: ../settings.php?m=User Updated Successfully'); //Redirect To Settings Page With Message "User Updated SuccessFully Message"
            }else{ //If User Not Updated
                header('location: ../settings.php?m=Cant Update User Because Of Some Problem'); //Redirect To Settings Page With Message "Cant Update User Because Of Some Problem"
            }

        }else{ //If New Password is Not equal To Confirm New Password

            header('location: ../settings.php?m=New Password And Confirm New Password Are Not Same'); //Redirect To Settings Page With Message "New Password And Confirm New Password Are Not Same"
        }
    }else{ //If User Name Or Password Are Not Correct
        header('location: ../settings.php?m=Old Password Is Not Correct'); //Redirect To Settings Page With Message "Old Password Is Not Correct"
    }
}
//If Mode Is To Logout The User
else if($mode == "lo"){

    session_start();
    session_destroy(); //Destroy User Session
    header("location: ../index.php");

}

?>