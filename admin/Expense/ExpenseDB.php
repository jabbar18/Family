<?php

//Include Database Connection Function To Make Connection With Database
include_once("../../files/database/inc/dbconnection.inc.php");

//Create member
function AddRecord()
{
	establishConnectionToDatabase();
	
	$saction = $_POST['action'];
	$smember_id = $_POST['member_id'];
	$sbalance = $_POST['balance'];
	$sexp_date = $_POST['exp_date'];
	$sitems = $_POST['items'];
	$samount = $_POST['amount'];
	$iamount_sum = $_POST['amount_sum'];

    $sQuery = "INSERT INTO `expenses` (`MemberId`, `Amount`, `DateTime`) VALUES ('$smember_id', '$iamount_sum', '$sexp_date');";
    $sResult = mysqli_query($GLOBALS['link'], $sQuery);

    $sQuery1 = "INSERT INTO `expence_items` (`ExpenseId`, `Amount`, `Item`) VALUES ";
	if($sResult)
	{
	    $isCreated = mysqli_insert_id($GLOBALS['link']);
	    for ($i=0; $i < count($sitems) ; $i++)
	    {
	    	$sQuery1.= "('$isCreated', '$samount[$i]', '$sitems[$i]'),";
	    }
	    $sQuery1= rtrim($sQuery1,',');
	    $sResult1 = mysqli_query($GLOBALS['link'], $sQuery1);
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
	
	if(mysqli_affected_rows($GLOBALS['link']) > 0)
	{
		$sReturn = "Member Deleted Successfully";
	}
	else
	{
        $sReturn = false;
	}
	
	mysqli_close($GLOBALS['link']);
	return $sReturn;
}

//Select All members
function SelectAllExpense($iExpenseId)
{
	establishConnectionToDatabase();

    $sCondition = "";

	if($iExpenseId > 0)
	    $sCondition = "WHERE ExpenseId ='$iExpenseId' LIMIT 1";


	$sQuery = "SELECT E.*,M.MemberName  FROM expenses AS E INNER JOIN members AS M ON E.MemberId = M.MemberId  $sCondition";

	$sResult = mysqli_query($GLOBALS['link'], $sQuery);
	
	if($sResult)
	{
        $aMembers = array();
		
		while($row = mysqli_fetch_array($sResult))
        {
			$aMember = array("MemberId"=>$row['MemberId'], "MemberName"=>$row['MemberName'], "ExpenseId"=>$row['ExpenseId'], "Amount"=>$row['Amount'], "ItemId"=>$row['ItemId'], "DateTime"=>$row['DateTime']);
        	array_push($aMembers, $aMember);
		}
		
		return $aMembers;
		
	}
	
	mysqli_close($GLOBALS['link']);
	return false;
}

?>