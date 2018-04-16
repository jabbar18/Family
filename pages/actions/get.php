<?php

include('../database/inc/dbconnection.inc.php');
establishConnectionToDatabase();

$sType = $_GET['type'];

switch ($sType)
{
    case "AddMember": include('../members/MembersActions.php');
        $objMembersActions = new MembersActions();
        $sReturn = $objMembersActions->AddMember($link);
        break;
    case "DeleteMember": include('../members/MembersActions.php');
        $objMembersActions = new MembersActions();
        $sReturn = $objMembersActions->DeleteMember($link);
        break;
    

}

echo $sReturn;

?>