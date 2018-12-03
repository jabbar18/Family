<?php
/*
	Some Short-cuts used in this file.
	
	m = MODE
	s = SAVE
	u = UPDATE
	d = DELETE
*/

//Include Event Database Functions
include("PlacesDB.php");

if(isset($_POST['action']))
{
    $sAction = $_POST['action'];
}
else
{
    $sAction = $_GET['action'];
}

//If Request is to Create An New Event
if($sAction == 'AddRecord')
{
    $iPlaceId = AddRecord();

    if($iPlaceId)
    {

        header("location: Places.php?m=Place Created Successfully");
    }
    else
    {
        header("location: Places.php?m=Can't Create Place");
    }

}
else if($sAction == 'EditRecord')
{
    $iEventId2 = $_POST['EventId'];
    $iEventId = EditRecord($iEventId2);


    if($iEventId)
    {

        header("location: ViewEvent.php?m=Place Edited Successfully&EventId=$iEventId2");
    }
    else
    {
        header("location: ViewEvent.php?m=Can't Edit Place&EventId=$iEventId2");
    }

}

else if($sAction == 'DeleteRecord')
{

    $iPlaceId = $_GET['PlaceId'];

    DeleteEvent($iPlaceId);

    header("location: Places.php?m=Place Deleted Successfully");
}

?>