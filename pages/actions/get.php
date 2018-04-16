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
    case "Settings": $sReturn = $this->Settings($objGeneral->fnGet("action"));
        break;

}

echo $sReturn;

?>