<?php

//Include Database Connection Function To Make Connection With Database
include_once("../../files/database/inc/dbconnection.inc.php");

//Create member 
function AddRecord()
{
	establishConnectionToDatabase();




    $sname = $_POST['name'];
    $sed = $_POST['ed'];
    $sl = $_POST['l'];
    $seo = $_POST['eo'];
    $aMembers= $_POST['Members'];

   	
    $sQuery = "INSERT INTO events (EventName, DateTime, Location,EventOrganizorId) VALUES( '$sname', '$sed', '$sl', '$seo')";
   
    $sResult = mysqli_query($GLOBALS['link'], $sQuery);

	if($sResult)
	{
	    $isCreated = mysqli_insert_id($GLOBALS['link']);
	}
	else
	{
		$isCreated = false;
	}


		foreach ($aMembers as $key => $value) {
    		 $sQuery = "INSERT INTO events_members (EventId, MemberId) VALUES( '$isCreated', '$value')";

    		$sResult = mysqli_query($GLOBALS['link'], $sQuery);
    		if(!($sResult))
    			return false;


    	}


	
	mysqli_close($GLOBALS['link']);
	
	return $isCreated;
}

//Update member
function EditRecord($iEventId)
{
	establishConnectionToDatabase();

	$sname = $_POST['name'];
    $sed = $_POST['ed'];
    $sl = $_POST['l'];
    $seo = $_POST['eo'];
    $aMembers= $_POST['Members'];
    // $iEventId =$this->iEventId;
   	
    $sQuery = "Update  events SET EventName='$sname',  DateTime='$sed', Location='$sl', EventOrganizorId='$seo'   WHERE  EventId='$iEventId'";


   	// die($sQuery);
    $sResult = mysqli_query($GLOBALS['link'], $sQuery);
	
	if(mysqli_affected_rows($GLOBALS['link']) >= 0){
		$isUpdated = "Event Updated Successfully";
	}else{
		$isUpdated = false;
		return false;
	}

	
	$sQuery = "DELETE FROM events_members   WHERE  EventId='$iEventId'";
	$sResult = mysqli_query($GLOBALS['link'], $sQuery);

	foreach ($aMembers as $key => $value) {
    		 $sQuery = "INSERT INTO events_members (EventId, MemberId) VALUES( '$iEventId', '$value')";

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
	
	$query = "DELETE FROM events WHERE EventId = $iMemberId";
	$result = mysqli_query($GLOBALS['link'], $query);
	
	if(mysqli_affected_rows($GLOBALS['link']) > 0)
	{
		$sReturn = "Member Deleted Successfully";
	}
	else
	{
        $sReturn = false;
	}
	$query = "DELETE FROM events_members WHERE EventId = $iMemberId";
	$result = mysqli_query($GLOBALS['link'], $query);
	
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
	function SelectAllEvents($iEventId)
{
	establishConnectionToDatabase();

    $sCondition = "";

	if($iEventId > 0)
	    $sCondition = "WHERE E.EventId ='$iEventId' LIMIT 1";


	$sQuery = "SELECT E.*,M.UserName AS 'Organizor' FROM events AS E INNER JOIN members AS M ON M.MemberId = E.EventOrganizorId  $sCondition";

	$sResult = mysqli_query($GLOBALS['link'], $sQuery);
	
	if($sResult)
	{
        $aEvents = array();
		
		while($row = mysqli_fetch_array($sResult))
        {
			$aEvent = array("EventId"=>$row['EventId'],"EventName"=>$row['EventName'], "DateTime"=>$row['DateTime'], "Location"=>$row['Location'], "EventOrganizorId"=>$row['EventOrganizorId'],"Organizor"=>$row['Organizor']);
        	array_push($aEvents, $aEvent);
		}
		
		return $aEvents;
		
	}
	
	mysqli_close($GLOBALS['link']);
	return false;
}




function SelectAllEventMember($iEventId)
{
	establishConnectionToDatabase();

    $sCondition = "";

	if($iEventId > 0)
	    $sCondition = "WHERE E.EventId ='$iEventId' ";


	$sQuery = "SELECT E.* FROM events_members AS E   $sCondition";
	
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