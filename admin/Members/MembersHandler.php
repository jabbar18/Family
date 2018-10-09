<?php
/*
	Some Short-cuts used in this file.
	
	m = MODE
	s = SAVE
	u = UPDATE
	d = DELETE
*/

//Include Event Database Functions
include("MembersDB.php");

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

        header("location: Members.php?m=Member Created Successfully");
    }
    else
    {
        header("location: Members.php?m=Can't Create Member");
    }

}
else if($sAction == 'EditRecord')
{

    $iMemberId = EditRecord();

    if($iMemberId)
    {

        header("location: EditMember.php?m=Member Edited Successfully");
    }
    else
    {
        header("location: Members.php?m=Can't Edit Member");
    }

}

else if($sAction == 'DeleteRecord')
{

    $iMemberId = $_GET['MemberId'];

    DeleteMember($iMemberId);

    header("location: Members.php?m=Member Deleted Successfully");
}
else if($sAction == 'AccountBalance')
{
    $iMemberId = $_POST['MemberId'];

    $aMembers = SelectAllMembers($iMemberId);

    foreach($aMembers as $aMember)
    {
        $iAccountBalance = $aMember['AccountBalance'];
    }
        echo $iAccountBalance;
}

?>