<?php

include('../database/inc/dbconnection.inc.php');
establishConnectionToDatabase();

$sType = $_GET['type'];

switch ($sType)
{
    case "AddMember": include('../Members/clsMembersActions.php');
        $objMembersActions = new MembersActions();
        $sReturn = $objMembersActions->AddMember($link);
        break;
    case "DeleteMember": include('../Members/clsMembersActions.php');
        $objMembersActions = new MembersActions();
        $sReturn = $objMembersActions->DeleteMember($link);
        break;
    case "ViewMember": include('../members/MembersActions.php');
        $objMembersActions = new MembersActions();
        $sReturn = $objMembersActions->ViewMember($link);
        break;   
    

}

echo $sReturn;

?>