<?php
/*
	Some Short-cuts used in this file.
	
	m = MODE
	s = SAVE
	u = UPDATE
	d = DELETE
*/

//Include Event Database Functions
include("ExpenseDB.php");

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
        // echo 'YES';
        header("location: Expense.php?m=Member Created Successfully");
    }
    else
    {
        // echo 'NO';
        header("location: Expense.php?m=Can't Create Member");
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
        header("location: Expense.php?m=Can't Edit Member");
    }

}

else if($sAction == 'DeleteRecord')
{

    $iMemberId = $_GET['MemberId'];

    DeleteMember($iMemberId);

    header("location: Expense.php?m=Member Deleted Successfully");
}

?>