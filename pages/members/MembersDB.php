<?php

//Include Database Connection Function To Make Connection With Database
include_once("../../files/database/inc/dbconnection.inc.php");

//Create member 
function AddRecord()
{
	establishConnectionToDatabase();

    $sMemberName = $_POST['name'];
	$sUserName = $_POST['uname'];
	$sFatherName = $_POST['sfathername'];
	$sMotherName = $_POST['smothername'];
    $sPassword = $_POST['password'];
    $sQualification = $_POST['qualification'];
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
	$iAccountBalancee = $_POST['accountbalance'];
	


    $sQuery = "INSERT INTO members (MemberName,FatherId,MotherId, UserName, Password, Qualification, ContactNumber, CNIC, Email, Gender, DateOfBirth, SchoolName, SchoolFees, SchoolContactNumber, SchoolLatitude, SchoolLongitude, SchoolAddress, MonthlyPocketMoney,AccountBalance) VALUES('$sMemberName','$sFatherName','$sMotherName', '$sUserName', '$sPassword', '$sQualification', '$dContactNumber', '$dCNIC', '$sEmail', '$sGender', '$dDateofBirth', '$sSchoolName', '$sSchoolFees', '$sSchoolContact', '$dSchoolLatitude', '$dSchoolLongitude', '$sSchoolAddress', '$dMoney', '$iAccountBalancee')";
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
function EditRecord()
{
	establishConnectionToDatabase();


    $iMemberId = $_POST['id'];
    $sMemberName = $_POST['name'];
    $sUserName = $_POST['uname'];
    $sPassword = $_POST['password'];
    $sQualification = $_POST['qualification'];
    $dContactNumber = $_POST['cnumber'];
    $dCNIC = $_POST['cnic'];
    $sEmail = $_POST['email'];
    $sGender = $_POST['gender'];
    $dDateofBirth = $_POST['dob'];
    $sSchoolName = $_POST['sname'];
    $sSchoolFees = $_POST[''];
    $sSchoolContact = $_POST['scontact'];
    $dSchoolLatitude = $_POST['slatitude'];
    $dSchoolLongitude = $_POST['slongitude'];
    $sSchoolAddress = $_POST['saddress'];
    $dMoney = $_POST['money'];


    $sQuery = "UPDATE members SET MemberName = '$sMemberName', UserName = '$sUserName', Password = '$sPassword', Qualification='$sQualification', ContactNumber='$dContactNumber', 
    CNIC='$dCNIC', Email='$sEmail', Gender='$sGender', DateOfBirth='$dDateofBirth', 
    SchoolName='$sSchoolName', SchoolFees='$sSchoolFees', SchoolContactNumber='$sSchoolContact', SchoolLatitude='$dSchoolLatitude', SchoolLongitude='$dSchoolLongitude', SchoolAddress='$sSchoolAddress', MonthlyPocketMoney='$dMoney'  WHERE MemberId='$iMemberId'";


    $sResult = mysqli_query($GLOBALS['link'], $sQuery);
	
	if(mysqli_affected_rows($GLOBALS['link']) > 0){
		$isUpdated = "Member Updated Successfully";
	}else{
		$isUpdated = false;
	}

    mysqli_close($GLOBALS['link']);
	return $isUpdated;
}

//Delete member
function DeleteMember($iMemberId)
{
	establishConnectionToDatabase();
	
	$query = "DELETE FROM members WHERE MemberId = $iMemberId";
	$result = mysqli_query($GLOBALS['link'], $query);
	if($result)
	{
		$sReturn = true;
	}
	else
	{
        $sReturn = false;
	}
	
	mysqli_close($GLOBALS['link']);
	return $sReturn;
}

//Select All members
function SelectAllMembers($iMemberId)
{
	establishConnectionToDatabase();

	$sCondition = "";

	if($iMemberId > 0)
	    $sCondition = "WHERE MemberId ='$iMemberId' LIMIT 1";


	$sQuery = "SELECT * FROM members $sCondition";

	$sResult = mysqli_query($GLOBALS['link'], $sQuery);
	
	if($sResult)
	{

        $aMembers = array();
		
		while($row = mysqli_fetch_array($sResult))
        {
			$aMember = array("MemberId"=>$row['MemberId'],"MotherId"=>$row['MotherId'],"FatherId"=>$row['FatherId'], "MemberName"=>$row['MemberName'], "UserName"=>$row['UserName'], "Password"=>$row['Password'], "Qualification"=>$row['Qualification'], "ContactNumber"=>$row['ContactNumber'], "CNIC"=>$row['CNIC'], "Email"=>$row['Email'], "Gender"=>$row['Gender'], "DateOfBirth"=>$row['DateOfBirth'], "SchoolName"=>$row['SchoolName'], "SchoolFees"=>$row['SchoolFees'], "SchoolContactNumber"=>$row['SchoolContactNumber'], "SchoolLatitude"=>$row['SchoolLatitude'], "SchoolLongitude"=>$row['SchoolLongitude'], "SchoolAddress"=>$row['SchoolAddress'], "MonthlyPocketMoney"=>$row['MonthlyPocketMoney'], "AccountBalance"=>$row['AccountBalance']);
        	array_push($aMembers, $aMember);
		}

       return $aMembers;
		
	}
	
	mysqli_close($GLOBALS['link']);
	return false;
}

?>