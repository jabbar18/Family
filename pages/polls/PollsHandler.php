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
    $iTodoId = AddRecord();

    if($iTodoId)
    {

        header("location: polls.php?m=To Do Created Successfully");
    }
    else
    {
        header("location: polls.php?m=Can't Create To Do");
    }

}
else if($sAction == 'EditRecord')
{
    $iCharityId = $_POST['id'];
    $iEventId = EditRecord();

    if($iEventId)
    {

        header("location: EditToDo.php?m=Event Edited Successfully&PollsId=$iCharityId");
    }
    else
    {
        header("location: Todo.php?m=Can't Edit Event");
    }

}
else if($sAction == 'DeleteRecord')
{

    $iEventId = $_GET['PollsId'];


    DeleteEvent($iEventId);

    header("location: polls.php?m=To Do Deleted Successfully");
}

?>