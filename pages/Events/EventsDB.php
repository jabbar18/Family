<?php

//Include Database Connection Function To Make Connection With Database
include_once("../../files/database/inc/dbconnection.inc.php");

$aColors = array("AFD8F8", "F6BD0F", "8BBA00", "FF8E46", "008E8E", "D64646", "8E468E", "588526", "B3AA00", "C07878", "78C08b", "C0b878", "7892c0", "AFD8F8", "F6BD0F", "8BBA00", "FF8E46", "008E8E", "D64646", "8E468E", "AFD8F8", "F6BD0F", "8BBA00", "FF8E46", "008E8E", "D64646", "8E468E", "588526", "B3AA00", "C07878", "78C08b", "C0b878", "7892c0", "AFD8F8", "F6BD0F", "8BBA00", "FF8E46", "008E8E", "D64646", "8E468E", "AFD8F8", "F6BD0F", "8BBA00", "FF8E46", "008E8E", "D64646", "8E468E", "588526", "B3AA00", "C07878", "78C08b", "C0b878", "7892c0", "AFD8F8", "F6BD0F", "8BBA00", "FF8E46", "008E8E", "D64646", "8E468E");
//Create member
function AddRecord()
{
    establishConnectionToDatabase();


    $sname = $_POST['name'];
    $sed = $_POST['ed'];
    $sl = $_POST['l'];
    $seo = $_POST['eo'];
    $aMembers= $_POST['Members'];
    $sDescription= $_POST['des'];

    $sQuery = "INSERT INTO events (EventName, DateTime, Location, EventOrganizorId, Description) VALUES( '$sname', '$sed', '$sl', '$seo', '$sDescription')";

    $sResult = mysqli_query($GLOBALS['link'], $sQuery);

    if($sResult)
    {
        $isCreated = mysqli_insert_id($GLOBALS['link']);
    }
    else
    {
        $isCreated = false;
    }


    if(count($aMembers) > 0)
    {

        for($i = 0; $i < count($aMembers); $i++)
        {

            $sQuery2 = "INSERT INTO event_members (EventId, MemberId) VALUES( '$isCreated', '$aMembers[$i]')";
            $sResult = mysqli_query($GLOBALS['link'], $sQuery2);

        }

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


    $sQuery = "DELETE FROM event_members   WHERE  EventId='$iEventId'";
    $sResult = mysqli_query($GLOBALS['link'], $sQuery);

    foreach ($aMembers as $key => $value) {
        $sQuery = "INSERT INTO event_members (EventId, MemberId) VALUES( '$iEventId', '$value')";

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
    $query = "DELETE FROM event_members WHERE EventId = $iMemberId";
    $result = mysqli_query($GLOBALS['link'], $query);

    mysqli_close($GLOBALS['link']);
    return $sReturn;
}


function SelectAllEvents($iEventId, $sSort = 0)
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

function SelectAllPlaces($iPlaceId)
{
    establishConnectionToDatabase();

    $sCondition = "";

    if($iPlaceId > 0)
        $sCondition = "WHERE E.PlaceId ='$iPlaceId' LIMIT 1";

    $sQuery = "SELECT E.*, M.MemberName AS 'Organizor' FROM places AS E INNER JOIN members AS M ON M.MemberId = E.MemberId  $sCondition";

    $sResult = mysqli_query($GLOBALS['link'], $sQuery);

    if($sResult)
    {
        $aPlaces = array();

        while($row = mysqli_fetch_array($sResult))
        {
            $aPlace = array("PlaceId"=>$row['PlaceId'],"PlaceName"=>$row['PlaceName'], "MemberId"=>$row['MemberId'],"Organizor"=>$row['Organizor'], "Latitude"=>$row['Latitude'], "Longitude"=>$row['Longitude']);
            array_push($aPlaces, $aPlace);
        }

        return $aPlaces;

    }

    mysqli_close($GLOBALS['link']);
    return false;
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
            $aMember = array("MemberId"=>$row['MemberId'], "Admin"=>$row['Admin'], "MotherId"=>$row['MotherId'],"FatherId"=>$row['FatherId'], "MemberName"=>$row['MemberName'], "UserName"=>$row['UserName'], "Password"=>$row['Password'], "Qualification"=>$row['Qualification'], "ContactNumber"=>$row['ContactNumber'], "CNIC"=>$row['CNIC'], "Email"=>$row['Email'], "Gender"=>$row['Gender'], "DateOfBirth"=>$row['DateOfBirth'], "SchoolName"=>$row['SchoolName'], "SchoolFees"=>$row['SchoolFees'], "SchoolContactNumber"=>$row['SchoolContactNumber'], "SchoolLatitude"=>$row['SchoolLatitude'], "SchoolLongitude"=>$row['SchoolLongitude'], "SchoolAddress"=>$row['SchoolAddress'], "MonthlyPocketMoney"=>$row['MonthlyPocketMoney'], "AccountBalance"=>$row['AccountBalance'], "Photo"=>$row['Photo']);
            array_push($aMembers, $aMember);
        }

        return $aMembers;

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


    $sQuery = "SELECT E.* FROM event_members AS E   $sCondition";

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

function SelectAllPlaceMember($iPlaceId)
{
    establishConnectionToDatabase();

    $sCondition = "";

    if($iPlaceId > 0)
        $sCondition = "WHERE E.PlaceId ='$iPlaceId' ";


    $sQuery = "SELECT E.* FROM places_members AS E   $sCondition";

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
// Birthday Funtion

function MemberBirthday($ddate)
{
    establishConnectionToDatabase();

    $dDay = date("d",strtotime($ddate));
    $dMonth = date("m",strtotime($ddate));

    if($ddate != '')
        $sCondition = "WHERE Day(DateOfBirth) = '$dDay' and Month(DateOfBirth) = '$dMonth'";


    $sQuery = "SELECT * FROM members $sCondition";



    $sResult = mysqli_query($GLOBALS['link'], $sQuery);

    if($sResult)
    {

        $aMembers = array();

        while($row = mysqli_fetch_array($sResult))
        {
            $aMember = array("MemberId"=>$row['MemberId'], "MemberName"=>$row['MemberName'], "UserName"=>$row['UserName'], "DateOfBirth"=>$row['DateOfBirth']);
            array_push($aMembers, $aMember);
        }

        return $aMembers;

    }

    mysqli_close($GLOBALS['link']);
    return false;
}
function BirthdayWish()
{
    session_start(); //Start Session

    establishConnectionToDatabase();
    $sMemberBirthdayId = $_REQUEST['MemberId'];
    $WisherId = $_SESSION['id'];
    $sBirthdayMessage = $_POST['birthdaymessage'];
    date_default_timezone_set('asia/karachi');
    $dDateTime = date('Y-m-d h:i:sa');

    $sQuery = "INSERT INTO birthday (BirthdayMessage, WishDateTime, BirthdayMemberId, MemberWisherId) VALUES( '$sBirthdayMessage', '$dDateTime', '$sMemberBirthdayId', '$WisherId')";

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


//poll voting
function PollVoting($dDate)
{
    establishConnectionToDatabase();

    $sCondition = "";
    $iUserId = $_SESSION['id'];

    if($dDate != '')
        $sCondition = "WHERE P.PollStartDateTime >= '$dDate 00:00:00' AND PS.MemberId = '$iUserId'";

    $sQuery = "SELECT P.*, PS.MemberId FROM polls AS P INNER JOIN polls_members AS PS ON PS.PollId = P.PollId $sCondition";

    $sResult = mysqli_query($GLOBALS['link'], $sQuery);

    $aEvents = array();
    if($sResult)
    {


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
function BirthdayNotification($dDate)
{
    establishConnectionToDatabase();

    $WisherId = $_SESSION['id'];

    $sCondition = "";


    if($dDate != '')
        $sCondition = "WHERE WishDateTime BETWEEN '$dDate 00:00:00' AND  '$dDate 23:59:59' AND BirthdayMemberId ='$WisherId'";


    $sQuery = "SELECT * FROM birthday $sCondition";

    $sResult = mysqli_query($GLOBALS['link'], $sQuery);

    $aEvents = array();

    if($sResult)
    {


        while($row = mysqli_fetch_array($sResult))
        {
            $aEvent = array("id"=>$row['id'],"BirthdayMessage"=>$row['BirthdayMessage'], "WishDateTime"=>$row['WishDateTime'], "BirthdayMemberId"=>$row['BirthdayMemberId'], "MemberWisherId"=>$row['MemberWisherId']);
            array_push($aEvents, $aEvent);
        }

        return $aEvents;

    }

    mysqli_close($GLOBALS['link']);
    return false;
}
//todo notificatiom

function TodoNotification($dDate)
{
    establishConnectionToDatabase();

    $sCondition = "";
    $iToDoId = $_SESSION['id'];


    if($dDate != '')
        $sCondition = "WHERE TodoDate <='$dDate' AND DeadlineDate >= '$dDate' AND TodoMemberId ='$iToDoId'";


    $sQuery = "SELECT * FROM todo $sCondition";



    $sResult = mysqli_query($GLOBALS['link'], $sQuery);

    $aEvents = array();

    if($sResult)
    {


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

function Expenses_Data()
{
    establishConnectionToDatabase();
    global $aColors;
    $counter=0;
    $sCateogries='';
    $sData='';
    $sCondition= "";
    $iTotal = 0;


    $iUserId = $_SESSION['id'];
    $iAdmin = $_SESSION['Admin'];

    if($iAdmin == 0)
        $sCondition = "WHERE E.MemberId = $iUserId";

    $sQuery = "SELECT SUM(E.Amount) AS Total,MONTHNAME(E.DateTime) AS MonthName 
                FROM expenses E 
                $sCondition
                GROUP BY MONTHNAME(E.DateTime)
                ORDER BY str_to_date(MONTHNAME(E.DateTime),'%M') ASC";

    $ObjResult = mysqli_query($GLOBALS['link'], $sQuery);
    while($aRow = mysqli_fetch_assoc($ObjResult))
    {
        $counter++;
        $iTotal += $aRow['Total'];
        $sData .="{y:".$aRow['Total'].", color: \"#".$aColors[$counter]."\"},";
        $sCateogries .="'".$aRow['MonthName']."',";
    }
    $aData=["Data"=>trim($sData,','),"Categories" => trim($sCateogries,','), "Total" => $iTotal];
    return $aData;

}

function PollVote()
{
    establishConnectionToDatabase();


    $QuestionAnswer = $_POST['Question_'];
    $MembersId = $_POST['MemberId'];
    $sComments = $_POST['comments'];

    $sResult = explode("_", $QuestionAnswer);
    $QuestionNo = $sResult[0];
    $AnswerNo = $sResult[1];

    $sQuery = "INSERT INTO polls_answers (QuestionId, AnswerId, MemberId, Comments) VALUES('$QuestionNo', '$AnswerNo', '$MembersId', '$sComments')";

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

function CheckPoll($iQuestionId, $iMemberId)
{
    establishConnectionToDatabase();

    $iCount = 0;

    $que= "SELECT COUNT(id) AS 'Counting' from polls_answers WHERE MemberId='$iMemberId' AND QuestionId='$iQuestionId'";

    $sResult = mysqli_query($GLOBALS['link'], $que);

    while($row = mysqli_fetch_array($sResult))
    {

        $iCount = $row['Counting'];
    }

    return $iCount;
//    die($sResult);
}

function PollResult($QuestionId, $MemberId = "")
{

    establishConnectionToDatabase();

    $sCondition = "";

    if($MemberId != '')
        $sCondition = "AND MemberId ='$MemberId'";


    $sQuery = "SELECT PA.*, M.MemberName, M.Photo FROM polls_answers AS PA INNER JOIN members AS M ON M.MemberId = PA.MemberId WHERE QuestionId ='$QuestionId' $sCondition";


    $sResult = mysqli_query($GLOBALS['link'], $sQuery);
    $aVotes = array();

    if($sResult)
    {
        while($row = mysqli_fetch_array($sResult))
        {
            $aVotes["Answers"][] = ["MemberId"=>$row['MemberId'], "MemberName"=>$row['MemberName'], "Photo"=>$row['Photo'],"QuestionId"=>$row['QuestionId'], "AnswerId"=>$row['AnswerId'], "Comments"=>$row['Comments']];
//            array_push($aVotes, $aVote);
        }

    }
    $sQuery = "SELECT
    QuestionId,
    (SELECT COUNT(AnswerId) FROM polls_answers WHERE AnswerId='1' AND QuestionId='$QuestionId') AS 'Answer_1',
    (SELECT COUNT(AnswerId) FROM polls_answers WHERE AnswerId='2' AND QuestionId='$QuestionId') AS 'Answer_2',
    (SELECT COUNT(AnswerId) FROM polls_answers WHERE AnswerId='3' AND QuestionId='$QuestionId') AS 'Answer_3',
    (SELECT COUNT(AnswerId) FROM polls_answers WHERE AnswerId='4' AND QuestionId='$QuestionId') AS 'Answer_4',
    (SELECT COUNT(Comments) FROM polls_answers WHERE Comments  <> '' AND QuestionId='$QuestionId') AS 'Comments'
    FROM
    polls_answers
    WHERE QuestionId = '$QuestionId'
    LIMIT 1";

    $sResult = mysqli_query($GLOBALS['link'], $sQuery);


    if($sResult)
    {

        while($row = mysqli_fetch_array($sResult))
        {
            $aVotes["Total"] = ["Answer_1"=>$row['Answer_1'],"Answer_2"=>$row['Answer_2'], "Answer_3"=>$row['Answer_3'], "Answer_4"=>$row['Answer_4'], "Comments"=>$row['Comments']];

        }

    }
//    array_push($aVotes, $aVote);
    mysqli_close($GLOBALS['link']);

    return $aVotes;
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

function SelectAllPolls($iToDoId)
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

function SelectAllToDo($iToDoId, $iUserId = 0)
{
    establishConnectionToDatabase();

    $sCondition = "";

    if($iUserId > 0)
        $sCondition = "WHERE TodoMemberId = '$iUserId'";

    if($iToDoId > 0)
        $sCondition .= "WHERE TodoId ='$iToDoId' LIMIT 1";

    $sQuery = "SELECT * FROM todo $sCondition";

    $sResult = mysqli_query($GLOBALS['link'], $sQuery);

    $aEvents = array();

    if($sResult)
    {
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


function GetTrackingData($iMemberId = "", $dDate = "")
{
    establishConnectionToDatabase();

    $sCondition = "";

    if($dDate != '' && $iMemberId > 0)
    {
        $sCondition = "WHERE 'LastLocation' >= '$dDate 00:00:00' AND T.MemberId = '$iMemberId' LIMIT 500";
        $sQuery = "SELECT T.MemberId, T.Latitude, T.Longitude, T.LocationDate AS 'LastLocation', M.MemberName, M.Photo FROM tracking AS T INNER JOIN members AS M ON T.MemberId = M.MemberId $sCondition";


    }
    else
    {

        $sQuery = "SELECT T.MemberId, T.Latitude, T.Longitude, T.LocationDate, M.MemberName, M.Photo, (SELECT LocationDate FROM tracking WHERE MemberId=T.MemberId ORDER BY LocationDate DESC LIMIT 1) AS 'LastLocation' 
         FROM tracking AS T INNER JOIN members AS M ON T.MemberId = M.MemberId GROUP BY T.MemberId";


    }

 $sResult = mysqli_query($GLOBALS['link'], $sQuery);

    $aTracking = array();

    $iCounter = 0;
    $sMemberTrack = "";
    $sMemberLocations = "";

    if($sResult)
    {
        while($row = mysqli_fetch_array($sResult))
        {
            $aTrack = array("MemberId"=>$row['MemberId'],"Latitude"=>$row['Latitude'], "Longitude"=>$row['Longitude'], "LastLocation"=>$row['LastLocation'], "MemberName"=>$row['MemberName'], "Photo"=>$row['Photo']);


            if($row['Photo'] != "")
            {
                $sPhoto =  "../../files/".$row['Photo'];
            }
            else
            {
                $sPhoto = "../../dist/img/user2-160x160.jpg";
            }

            $sIcon = "image = { url: '". $sPhoto ."',size: new google.maps.Size(30, 30),scaledSize: new google.maps.Size(30, 30)}";


            $sMemberTrack .= (($iCounter > 0) ? ',' : '') . '["'. $row['MemberName'] .'", ' . $row['Latitude'] . ', ' . $row['Longitude'] . ', ' . $sIcon . ', "'. $row['LastLocation'] .'"]';

            $sMemberLocations .= (($iCounter > 0) ? ',' : '') . 'new google.maps.LatLng(' . $row['Latitude'] . ', ' . $row['Longitude'] . ')';

            $iCounter++;
        }


        if($dDate == '' && $iMemberId == "")
            $sMemberLocations = "";

        $sReturn = '<div style="width:100%; height:600px; margin-top:2px;" id="map_div"></div>
            <!--Map script-->
           <script type="text/javascript">
           
            function initialize() {
            var map;
            var bounds = new google.maps.LatLngBounds();
            var mapOptions = {
                mapTypeId: "roadmap"
            };
            var infowindow = new google.maps.InfoWindow({
             maxWidth: 300
            });
    
            var aEmployeeTrack = [ ' . $sMemberTrack . '];
            
            var sEmployeeLocations = [ ' . $sMemberLocations . ']
            
            console.log(aEmployeeTrack);
    
            // Display a map on the page
            map = new google.maps.Map(document.getElementById("map_div"), mapOptions);
            map.setTilt(45);
            
            var gEmployeeLocations = new google.maps.Polyline({ path: sEmployeeLocations, strokeColor: "#FF0000", strokeOpacity: 1, strokeWeight: 2 });
			gEmployeeLocations.setMap(map);
    
            // Loop through our array of markers & place each one on the map  
            for( i = 0; i < aEmployeeTrack.length; i++ ) {
                var position = new google.maps.LatLng(aEmployeeTrack[i][1], aEmployeeTrack[i][2]);
                bounds.extend(position);
                marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    title: aEmployeeTrack[i][0],
                    icon: aEmployeeTrack[i][3],
                    labelClass: "label", // the CSS class for the label
                });
                
                //console.log(">>>"+aEmployeeTrack[i][0]);
                // Automatically center the map fitting all markers on the screen
                map.fitBounds(bounds);
    
                marker = new google.maps.Marker({ position: new google.maps.LatLng(aEmployeeTrack[i][1], aEmployeeTrack[i][2]), map: map, title: aEmployeeTrack[i][0], icon: aEmployeeTrack[i][3] });
                google.maps.event.addListener(marker, "click", (function(marker, i) { return function() { map.setZoom(15); map.setCenter(marker.getPosition()); infowindow.setContent(aEmployeeTrack[i][0] + "<br /><br />" + aEmployeeTrack[i][4]); infowindow.open(map, marker); } })(marker, i));
            }
            
               
              var myoverlay = new google.maps.OverlayView();
              myoverlay.draw = function () {
                //this assigns an id to the markerlayer Pane, so it can be referenced by CSS
                this.getPanes().markerLayer.id="markerLayer"; 
              };
              myoverlay.setMap(map);
    
            // Override our map zoom level once our fitBounds function runs (Make sure it only runs once)
//            var boundsListener = google.maps.event.addListener((map), "bounds_changed", function(event) {
//                this.setZoom(6);
//                google.maps.event.removeListener(boundsListener);
//            });
            
          
        }
        initialize();
        </script> <style>
            
            #markerLayer img {
                border: 4px solid #fff !important;
                width: 85% !important;
                height: 90% !important;
                border-radius: 50% 50% 50% 0;
                transform: rotate(-45deg);
            }
            #markerLayer img:hover 
            {
                border: 4px solid #0c64ae !important;
            }
           
            </style>';
        return($sReturn);

    }



    mysqli_close($GLOBALS['link']);
    return false;
}

?>