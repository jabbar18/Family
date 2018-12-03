<?php

//Include Database Connection Function To Make Connection With Database
include_once("../../files/database/inc/dbconnection.inc.php");

$aColors = array("AFD8F8", "F6BD0F", "8BBA00", "FF8E46", "008E8E", "D64646", "8E468E", "588526", "B3AA00", "C07878", "78C08b", "C0b878", "7892c0", "AFD8F8", "F6BD0F", "8BBA00", "FF8E46", "008E8E", "D64646", "8E468E", "AFD8F8", "F6BD0F", "8BBA00", "FF8E46", "008E8E", "D64646", "8E468E", "588526", "B3AA00", "C07878", "78C08b", "C0b878", "7892c0", "AFD8F8", "F6BD0F", "8BBA00", "FF8E46", "008E8E", "D64646", "8E468E", "AFD8F8", "F6BD0F", "8BBA00", "FF8E46", "008E8E", "D64646", "8E468E", "588526", "B3AA00", "C07878", "78C08b", "C0b878", "7892c0", "AFD8F8", "F6BD0F", "8BBA00", "FF8E46", "008E8E", "D64646", "8E468E");
//Create member
function AddRecord()
{
    establishConnectionToDatabase();


    $sPlaceName = $_POST['name'];
    $iPlaceMemberId = $_POST['po'];
    $aMembers= $_POST['Members'];
    $iLatitude = $_POST['lt'];
    $iLongitude = $_POST['ln'];

    $sQuery = "INSERT INTO places (PlaceName, MemberId, Latitude, Longitude) VALUES( '$sPlaceName', '$iPlaceMemberId', '$iLatitude', '$iLongitude')";

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
        $sQuery = "INSERT INTO places_members (PlaceId, MemberId) VALUES( '$isCreated', '$value')";

        $sResult = mysqli_query($GLOBALS['link'], $sQuery);
        if(!($sResult))
            return false;


    }
    mysqli_close($GLOBALS['link']);

    return $isCreated;
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


function SelectAllPlaces($iEventId, $sSort = 0)
{
    establishConnectionToDatabase();

    $sCondition = "";

    if($sSort == 1)
        $sCondition = "ORDER BY E.DateTime DESC LIMIT 5";

    if($iEventId > 0)
        $sCondition = "WHERE E.EventId ='$iEventId' LIMIT 1";


    $sQuery = "SELECT E.*, M.MemberName AS 'Organizor' FROM events AS E INNER JOIN members AS M ON M.MemberId = E.EventOrganizorId  $sCondition";

    $sResult = mysqli_query($GLOBALS['link'], $sQuery);

    if($sResult)
    {
        $aEvents = array();

        while($row = mysqli_fetch_array($sResult))
        {
            $aEvent = array("EventId"=>$row['EventId'],"EventName"=>$row['EventName'], "DateTime"=>$row['DateTime'], "Location"=>$row['Location'], "EventOrganizorId"=>$row['EventOrganizorId'],"Organizor"=>$row['Organizor'], "Description"=>$row['Description']);
            array_push($aEvents, $aEvent);
        }

        return $aEvents;

    }

    mysqli_close($GLOBALS['link']);
    return false;
}


?>