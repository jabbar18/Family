<?php
/*
	Some Short-cuts used in this file.
	
	m = MODE
	s = SAVE
	u = UPDATE
	d = DELETE
*/

//Include Event Database Functions
include("CharityDB.php");

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
    $iMemberId = AddRecord();

    if($iMemberId)
    {

        header("location: Charity.php?m=Charity Created Successfully");
    }
    else
    {
        header("location: Charity.php?m=Can't Create Member");
    }

}
else if($sAction == 'EditRecord')
{
    $iCharityId = $_POST['id'];
    $iMemberId = EditRecord();

    if($iMemberId)
    {

        header("location: EditCharity.php?m=Charity Edited Successfully&CharityId=$iCharityId");
    }
    else
    {
        header("location: Charity.php?m=Can't Edit Member&CharityId=$iCharityId");
    }

}

else if($sAction == 'DeleteRecord')
{

    $iMemberId = $_GET['CharityId'];

    DeleteMember($iMemberId);

    header("location: Charity.php?m=Charity Deleted Successfully");
}

?>