<?php
/*
	Some Short-cuts used in this file.
	
	m = MODE
	s = SAVE
	u = UPDATE
	d = DELETE
*/

//Include Event Database Functions
include("PollsDB.php");

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
    $iPollId = AddRecord();

    if($iPollId)
    {

        header("location: Polls.php?m=Poll Created Successfully");
    }
    else
    {
        header("location: Polls.php?m=Can't Create Poll");
    }

}
else if($sAction == 'DeleteRecord')
{

    $iEventId = $_GET['PollsId'];


    DeleteEvent($iEventId);

    header("location: Polls.php?m=To Do Deleted Successfully");
}

?>