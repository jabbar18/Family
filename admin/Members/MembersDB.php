<?php

//Include Database Connection Function To Make Connection With Database
include_once("../../files/database/inc/dbconnection.inc.php");

//Create member 
function CreateMember()
{
	establishConnectionToDatabase();

    $sMemberName = $_POST['name'];
    $sUserName = $_POST['uname'];
    $sPassword = $_POST['password'];
    $sQualification = $_POST['qulatification'];
    $dContactNumber = $_POST['cnumber'];
    $dCNIC = $_POST['cnic'];
    $sEmail = $_POST['email'];
    $sGender = $_POST['gender'];
    $dDateofBirth = $_POST['dob'];
    $sSchoolName = $_POST['sname'];
    $sSchoolFees = $_POST['sfees'];
    $sSchoolContact = $_POST['scontact'];
    $dSchoolLatitude = $_POST['slatitude'];
    $dSchoolLongitude = $_POST['slongitude'];
    $sSchoolAddress = $_POST['saddress'];
    $dMoney = $_POST['money'];


    $sQuery = "INSERT INTO members (MemberName, UserName, Password, Qualification, ContactNumber, CNIC, Email, Gender, DateOfBirth, SchoolName, SchoolFees, SchoolContactNumber, SchoolLatitude, SchoolLongitude, SchoolAddress, MonthlyPocketMoney) VALUES('$sMemberName', '$sUserName', '$sPassword', '$sQualification', '$dContactNumber', '$dCNIC', '$sEmail', '$sGender', '$dDateofBirth', '$sSchoolName', '$sSchoolFees', '$sSchoolContact', '$dSchoolLatitude', '$dSchoolLongitude', '$sSchoolAddress', '$dMoney')";

    $sResult = mysqli_query($GLOBALS['link'], $sQuery);

	if($sResult)
	{
	    $isCreated = mysqli_insert_id($GLOBALS['link']);
	}
	else
	{
		$isCreated = false;
	}
	
	mysqli_close($GLOBALS['link']);
	
	return $isCreated;
}

//Update member
function UpdateMember(){
	establishConnectionToDatabase();
	
	$sQuery = "UPDATE members SET MemberName = '$sMemberName', UserName = '$sUserName', Password = '$sPassword' WHERE MemberID = $iMemberId";
    $sResult = mysqli_query($GLOBALS['link'], $sQuery);
	
	if(mysqli_affected_rows($GLOBALS['link']) > 0){
		$isUpdated = "Member Updated Sucessfully";
	}else{
		$isUpdated = false;
	}
	
	mysqli_close($GLOBALS['link']);
	return $isUpdated;
}

//Delete member
function DeleteMember($iMemberId){
	establishConnectionToDatabase();
	
	$query = "DELETE FROM members WHERE MemberId = $iMemberId";
	$result = mysqli_query($GLOBALS['link'], $query);
	
	if(mysqli_affected_rows($GLOBALS['link']) > 0){
		$isDeleted = "Member Deleted Sucessfully";
	}else{
		$isDeleted = false;
	}
	
	mysqli_close($GLOBALS['link']);
	return $isDeleted;
}

//Select All members
function SelectAllmembers()
{
	establishConnectionToDatabase();

	$sQuery = "SELECT * FROM members";
	$sResult = mysqli_query($GLOBALS['link'], $sQuery);
	
	if($sResult)
	{
        $aMembers = array();
		
		while($row = mysqli_fetch_array($sResult)){
			$aMember = array("MemberId"=>$row['MemberId'], "MemberName"=>$row['MemberName'], "UserName"=>$row['UserName'], "Password"=>$row['Password']);
			array_push($aMembers, $aMember);
		}
		
		return $aMembers;
		
	}
	
	mysqli_close($GLOBALS['link']);
	return $false;
}

?>