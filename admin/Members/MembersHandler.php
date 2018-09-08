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

if(isset($_POST['m'])){
	$mode = $_POST['m'];
}else{
	$mode = $_GET['m'];
}

//If Request is to Create An New Event
if($mode == 's')
{
    $iMemberId = createMember();

    if($iMemberId){

        header("location: Members.php?m=Member Created Successfully");
    }else{
        header("location: Members.php?m=Can't Create Member");
    }

}

else if($mode == 'd'){
	$iMemberId = $_GET['MemberId'];
    DeleteMember($iMemberId);

	header("location: Members.php?m=Member Deleted Successfully");
}

?>