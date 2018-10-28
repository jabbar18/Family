<?php

//Include Database Connection Function To Make Connection With Database
include_once("../../files/database/inc/dbconnection.inc.php");

//Create member 
function AddRecord()
{
	establishConnectionToDatabase();

    $sTitle = $_POST['title'];
    $sToDoDate = $_POST['tododate'];
    $sDeadlineDoDate = $_POST['tododeadlinedate'];
    $sDescription = $_POST['description'];
    $iMemberId= $_POST['member'];

   
    $sQuery = "INSERT INTO todo (Title, TodoDate, DeadlineDate, Description, TodoMemberId ) VALUES( '$sTitle', '$sToDoDate','$sDeadlineDoDate', '$sDescription', '$iMemberId')";
   	


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
    $sTitle = $_POST['title'];
    $sToDoDate = $_POST['tododate'];
    $sDescription = $_POST['description'];
    $aMembers= $_POST['Members'];
    
    $sQuery = "UPDATE to_do SET Title = '$sTitle',  Date='$sToDoDate', Description='$sDescription'  WHERE To_Do_Id='$iMemberId'";


    $sResult = mysqli_query($GLOBALS['link'], $sQuery);
	
	if(mysqli_affected_rows($GLOBALS['link']) > 0){
		$isUpdated = "Member Updated Successfully";
	}else{
		$isUpdated = false;
	}
	$sQuery = "DELETE FROM to_do_members WHERE To_Do_Id ='$iMemberId'";
	$sResult = mysqli_query($GLOBALS['link'], $sQuery);

	foreach ($aMembers as $key => $value) {
		$sQuery = "INSERT INTO to_do_members (To_Do_Id, MemberId) VALUES( '$iMemberId', '$value')";
		
	   $sResult = mysqli_query($GLOBALS['link'], $sQuery);
	   if(!($sResult))
		   return false;


   }


    mysqli_close($GLOBALS['link']);
	return $isUpdated;
}

//Delete member
function DeleteEvent($iMemberId)
{
	establishConnectionToDatabase();
	
	$query = "DELETE FROM todo WHERE TodoId = $iMemberId";
	$result = mysqli_query($GLOBALS['link'], $query);
	
	if(mysqli_affected_rows($GLOBALS['link']) > 0)
	{
		$sReturn = "Member Deleted Successfully";
	}
	else
	{
        $sReturn = false;
	}

//	$query = "DELETE FROM to_do_members WHERE To_Do_Id = $iMemberId";
//	$result = mysqli_query($GLOBALS['link'], $query);
	
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
			$aMember = array("MemberId"=>$row['MemberId'], "MemberName"=>$row['MemberName'], "UserName"=>$row['UserName'], "Password"=>$row['Password'], "Qualification"=>$row['Qualification'], "ContactNumber"=>$row['ContactNumber'], "CNIC"=>$row['CNIC'], "Email"=>$row['Email'], "Gender"=>$row['Gender'], "DateOfBirth"=>$row['DateOfBirth'], "SchoolName"=>$row['SchoolName'], "SchoolFees"=>$row['SchoolFees'], "SchoolContactNumber"=>$row['SchoolContactNumber'], "SchoolLatitude"=>$row['SchoolLatitude'], "SchoolLongitude"=>$row['SchoolLongitude'], "SchoolAddress"=>$row['SchoolAddress'], "MonthlyPocketMoney"=>$row['MonthlyPocketMoney']);
        	array_push($aMembers, $aMember);
		}
		
		return $aMembers;
		
	}

}	
	function SelectAllToDo($iToDoId)
{
	establishConnectionToDatabase();

    $sCondition = "";


	if($iToDoId > 0)
	    $sCondition = "WHERE TodoId ='$iToDoId' LIMIT 1";


	$sQuery = "SELECT * FROM todo $sCondition";


	$sResult = mysqli_query($GLOBALS['link'], $sQuery);
	
	if($sResult)
	{
        $aEvents = array();
		
		while($row = mysqli_fetch_array($sResult))
        {
			$aEvent = array("TodoId"=>$row['TodoId'],"Title"=>$row['Title'], "TodoDate"=>$row['TodoDate'], "TodoMemberId"=>$row['TodoMemberId'], "Description"=>$row['Description'], "DeadlineDate"=>$row['DeadlineDate']);
        	array_push($aEvents, $aEvent);
		}
		
		return $aEvents;
		
	}
	
	mysqli_close($GLOBALS['link']);
	return false;
}




function SelectAllToDoMember($iEventId)
{
	establishConnectionToDatabase();

    $sCondition = "";

	if($iEventId > 0)
	    $sCondition = "WHERE E.To_Do_Id ='$iEventId' ";


	$sQuery = "SELECT E.* FROM to_do_members AS E   $sCondition";
	
	$sResult = mysqli_query($GLOBALS['link'], $sQuery);
	
	if($sResult)
	{
        $aEvents = array();
		
		while($row = mysqli_fetch_array($sResult))
        {
			//$aEvent = array("EventId"=>$row['EventId'],"EventName"=>$row['EventName'], "DateTime"=>$row['DateTime'], "Location"=>$row['Location'], "EventOrganizorId"=>$row['EventOrganizorId'],"Organizor"=>$row['Organizor']);
        //	array_push($aEvents, $row['MemberId'] );
			$aEvents[]=$row['MemberId'];
		}
		
		return $aEvents;

		
	}
	
	mysqli_close($GLOBALS['link']);
	return false;
}








?>