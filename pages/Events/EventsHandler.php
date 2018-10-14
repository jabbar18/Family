<?php
/*
	Some Short-cuts used in this file.
	
	m = MODE
	s = SAVE
	u = UPDATE
	d = DELETE
*/

//Include Event Database Functions
include("EventsDB.php");

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
    $iEventId = AddRecord();

    if($iEventId)
    {

        header("location: Events.php?m=Event Created Successfully");
    }
    else
    {
        header("location: Events.php?m=Can't Create Event");
    }

}
else if($sAction == 'EditRecord')
{
    $iEventId2 = $_POST['EventId'];
    $iEventId = EditRecord($iEventId2);


    if($iEventId)
    {

        header("location: ViewEvent.php?m=Event Edited Successfully&EventId=$iEventId2");
    }
    else
    {
        header("location: ViewEvent.php?m=Can't Edit Event&EventId=$iEventId2");
    }

}

else if($sAction == 'DeleteRecord')
{

    $iEventId = $_GET['EventId'];

    DeleteEvent($iEventId);

    header("location: Events.php?m=Event Deleted Successfully");
}

?>