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

    $sQuery = "INSERT INTO expenses (MemberId, Amount, DateTime) VALUES ('$smember_id', '$iamount_sum', '$sexp_date');";
    $sResult = mysqli_query($GLOBALS['link'], $sQuery);

    $sQuery1 = "INSERT INTO `expenses_items` (`ExpenseId`, `Amount`, `Item`) VALUES";
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



//Delete member
function DeleteMember($iExpenseId)
{
	establishConnectionToDatabase();

	$query = "DELETE FROM expenses WHERE ExpenseId = $iExpenseId";
	$result = mysqli_query($GLOBALS['link'], $query);
	
	if(mysqli_affected_rows($GLOBALS['link']) > 0)
	{
		$sReturn = "Expense Deleted Successfully";
	}
	else
	{
        $sReturn = false;
	}
	
	mysqli_close($GLOBALS['link']);
	return $sReturn;
}

//Select All members
function SelectAllExpense($iExpenseId, $iUserId = 0)
{
	establishConnectionToDatabase();

    $sCondition = "";

	if($iExpenseId > 0)
	    $sCondition = "WHERE E.ExpenseId ='$iExpenseId'";

    if($iUserId > 0)
        $sCondition = "WHERE E.MemberId ='$iUserId'";


	$sQuery = "SELECT E.*, M.MemberName FROM expenses AS E INNER JOIN members AS M ON E.MemberId = M.MemberId $sCondition";

	$sResult = mysqli_query($GLOBALS['link'], $sQuery);
	
	if($sResult)
	{
        $aMembers = array();
		
		while($row = mysqli_fetch_array($sResult))
        {
			$aMember = array("MemberId"=>$row['MemberId'], "MemberName"=>$row['MemberName'], "ExpenseId"=>$row['ExpenseId'], "Amount"=>$row['Amount'], "DateTime"=>$row['DateTime']);
        	array_push($aMembers, $aMember);
		}
		
		return $aMembers;
		
	}
	
	mysqli_close($GLOBALS['link']);
	return false;
}

function SelectAllExpensesItems($iExpenseId)
{
    establishConnectionToDatabase();

    $sCondition = "";

    if($iExpenseId > 0)
        $sCondition = "WHERE EI.ExpenseId ='$iExpenseId'";


    $sQuery = "SELECT EI.* FROM expenses_items AS EI $sCondition";

    $sResult = mysqli_query($GLOBALS['link'], $sQuery);

    if($sResult)
    {
        $aExpensesItems = array();

        while($row = mysqli_fetch_array($sResult))
        {
            $aExpensesItem = array("ExpenseId"=>$row['ExpenseId'], "Amount"=>$row['Amount'], "Item"=>$row['Item']);
            array_push($aExpensesItems, $aExpensesItem);
        }

        return $aExpensesItems;

    }

    mysqli_close($GLOBALS['link']);
    return false;
}

?>