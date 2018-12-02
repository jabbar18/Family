<?php

//Include Database Connection Function To Make Connection With Database
include_once("../../files/database/inc/dbconnection.inc.php");

//Create member 
function AddRecord()
{

	establishConnectionToDatabase();

	session_start();

    $aMembers = $_POST['Members'];
    $sQuestion = $_POST['question'];
    $sAnswer1 = $_POST['ans1'];
    $sAnswer2 = $_POST['ans2'];
    $sAnswer3= $iUserId = $_SESSION['id'];$_POST['ans3'];
    $sAnswer4= $_POST['ans4'];
    $dPollstartdate = $_POST['pollstartdate'];
    $dPollenddate = $_POST['pollenddate'];
    $sNotes= $_POST['notes'];
    $dCurrentDate = date('Y-m-d');



    $sQuery = "INSERT INTO polls (Question, Answer1,Answer2,Answer3,Answer4,PollStartDateTime,PollEndDateTime,Notes,PollAddedBy,PollAddedOn)
    VALUES( '$sQuestion', '$sAnswer1','$sAnswer2', '$sAnswer3', '$sAnswer4','$dPollstartdate', '$dPollenddate','$sNotes', '$iUserId','$dCurrentDate')";

    $sResult = mysqli_query($GLOBALS['link'], $sQuery);

    if($sResult)
    {
        $isCreated = mysqli_insert_id($GLOBALS['link']);
    }
    else
    {
        $isCreated = false;
    }

    if($isCreated > 0)
    {
        foreach ($aMembers as $key => $value) {

            $sQuery2 = "INSERT INTO polls_members (PollId, MemberId) VALUES( '$isCreated', '$value')";

            $sResult = mysqli_query($GLOBALS['link'], $sQuery2);
            if(!($sResult))
                return false;


        }

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
	
	$query = "DELETE FROM polls WHERE PollId = $iMemberId";
	$result = mysqli_query($GLOBALS['link'], $query);
	
	if(mysqli_affected_rows($GLOBALS['link']) > 0)
	{
		$sReturn = "Poll Deleted Successfully";
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
	    $sCondition = "WHERE PollId ='$iToDoId' LIMIT 1";


	$sQuery = "SELECT * FROM polls $sCondition";


	$sResult = mysqli_query($GLOBALS['link'], $sQuery);
	
	if($sResult)
	{
        $aEvents = array();
		
		while($row = mysqli_fetch_array($sResult))
        {
			$aEvent = array("PollId"=>$row['PollId'],"Question"=>$row['Question'], "Answer1"=>$row['Answer1'], "Answer2"=>$row['Answer2'], "Answer3"=>$row['Answer3'], "Answer4"=>$row['Answer4'],"PollStartDateTime"=>$row['PollStartDateTime'], "PollEndDateTime"=>$row['PollEndDateTime'], "PollAddedOn"=>$row['PollAddedOn'], "Notes"=>$row['Notes'], "PollAddedBy"=>$row['PollAddedBy']);
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