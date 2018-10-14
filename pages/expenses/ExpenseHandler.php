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
        echo 'Expenses.php?m=Expense Created Successfully';
        // header("location: );
    }
    else
    {
        echo 'Expenses.php?m=Can\'t Create Expense';
    }

}
else if($sAction == 'EditRecord')
{

    $iMemberId = EditRecord();

    if($iMemberId)
    {

        header("location: Expenses.php?m=Expense Edited Successfully");
    }
    else
    {
        header("location: Expenses.php?m=Can't Edit Expense");
    }

}

else if($sAction == 'DeleteRecord')
{

    $iMemberId = $_GET['ExpenseId'];

    DeleteMember($iMemberId);

    header("location: Expenses.php?m=Expense Deleted Successfully");
}

?>