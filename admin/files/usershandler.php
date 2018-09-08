<?php
/*
	This File Handles The User Login, Update, Logout Of The System.
	
	Some Short-cuts used in this file.
	
	m = Request Mode(Login | Logout | Update User)
	l = Login User
	lo = Logout User
	uu = Update User
	
	userName = User Name Of User
	oldPassword = Actual Password
	nPassword = New Password
	cnPassword = Confirm New Password
*/

//Include Event Database Functions
include ("./database/usersdb.php");

//Get Mode Values From Post Or Get Method
if(isset($_POST['m'])){
	$mode = $_POST['m'];
}else{
	$mode = $_GET['m'];
}

//If Mode Is to Login The User
if($mode == 'l'){

	$userName = $_POST['username'];
	$oldPassword  = $_POST['password'];

	$user = selectUser($userName, $oldPassword); //Search For User in database, If user found Then Return its Information or Else return false;
	
	if($user){ //If User Is Found
		session_start(); //Start Session
		
		$_SESSION['id'] = $user['id']; //Put UserId In Session
		$_SESSION['username'] = $user['username']; //Put UserName In Session
		
		header("location: ../teachers.php"); //Redirect To Event Page
	}else{
		header("location: ../index.php?m=User Name Or Passwrod Is Not Correct"); //Redirect To Event Page
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
	header("location: ../../index.php");

}

?>