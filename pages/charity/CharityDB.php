<?php

//Include Database Connection Function To Make Connection With Database
include_once("../../files/database/inc/dbconnection.inc.php");

//Create member 
function AddRecord()
{
	establishConnectionToDatabase();
	
    $iMemberId = $_POST['name'];
    $iDonorMemberId = $_POST['donorid'];
    $iDonateAmount = $_POST['donateammount'];
    $dDonateDateTime = $_POST['donatedate'];
   


    $sQuery = "INSERT INTO charity (MemberId, DonorMemberId, DonateAmount, DonateDateTime) VALUES('$iMemberId', '$iDonorMemberId', '$iDonateAmount', '$dDonateDateTime')";

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
			$aMember = array("MemberId"=>$row['MemberId'], "MemberName"=>$row['MemberName'], "UserName"=>$row['UserName'], "Password"=>$row['Password'], "Qualification"=>$row['Qualification'], "ContactNumber"=>$row['ContactNumber'], "CNIC"=>$row['CNIC'], "Email"=>$row['Email'], "Gender"=>$row['Gender'], "DateOfBirth"=>$row['DateOfBirth'], "SchoolName"=>$row['SchoolName'], "SchoolFees"=>$row['SchoolFees'], "SchoolContactNumber"=>$row['SchoolContactNumber'], "SchoolLatitude"=>$row['SchoolLatitude'], "SchoolLongitude"=>$row['SchoolLongitude'], "SchoolAddress"=>$row['SchoolAddress'], "MonthlyPocketMoney"=>$row['MonthlyPocketMoney']);
        	array_push($aMembers, $aMember);
		}
		
		return $aMembers;
		
	}

}
// Update member
function EditRecord()
{
	establishConnectionToDatabase();

	$iCharityId = $_POST['id'];
    $iMemberId = $_POST['name'];
    $iDonorMemberId = $_POST['donorid'];
    $iDonateAmount = $_POST['donateammount'];
    $dDonateDateTime = $_POST['donatedate'];
//    die($iCharityId);


    $sQuery = "UPDATE charity SET MemberId = '$iMemberId', DonorMemberId='$iDonorMemberId', DonateAmount='$iDonateAmount', DonateDateTime='$dDonateDateTime'  WHERE CharityId='$iCharityId'";


    $sResult = mysqli_query($GLOBALS['link'], $sQuery);
	
	if(mysqli_affected_rows($GLOBALS['link']) >= 0){
		$isUpdated = 1;
	}else{
		$isUpdated = false;
	}

    mysqli_close($GLOBALS['link']);
	return $isUpdated;
}

//Delete member
function DeleteMember($iCharityId)
{
	establishConnectionToDatabase();
	
	$query = "DELETE FROM charity WHERE CharityId = $iCharityId";
	$result = mysqli_query($GLOBALS['link'], $query);
	
	if(mysqli_affected_rows($GLOBALS['link']) > 0)
	{
		$sReturn = "Charity Deleted Successfully";
	}
	else
	{
        $sReturn = false;
	}
	
	mysqli_close($GLOBALS['link']);
	return $sReturn;
}

//Select All members
function SelectAllCharityMembers($iCharityId)
{
	establishConnectionToDatabase();

    $sCondition = "";

	if($iCharityId > 0)
	    $sCondition = "WHERE CharityId ='$iCharityId' LIMIT 1";


	$sQuery = "SELECT * FROM charity $sCondition";

	$sResult = mysqli_query($GLOBALS['link'], $sQuery);
	
	if($sResult)
	{
        $aCharityMembers = array();
		
		while($row = mysqli_fetch_array($sResult))
        {
			$aCharityMember = array("CharityId"=>$row['CharityId'], "MemberId"=>$row['MemberId'], "DonorMemberId"=>$row['DonorMemberId'], "DonateAmount"=>$row['DonateAmount'], "DonateDateTime"=>$row['DonateDateTime']);
        	array_push($aCharityMembers, $aCharityMember);
		}
		
		return $aCharityMembers;
		
	}
	
	mysqli_close($GLOBALS['link']);
	return false;
}

?>