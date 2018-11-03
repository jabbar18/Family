<?php

class DB_Functions
{

    private $conn;

    // constructor
    function __construct()
    {
        require_once 'db_connect.php';
        // connecting to database
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }

    public function getUserByUsernameAndPassword($username, $password)
    {

        $query = "SELECT * FROM members WHERE UserName = '$username' AND Password = '$password'";
        $result = mysqli_query($this->conn, $query);

        $user = false;

        if($result){
            if($row = mysqli_fetch_array($result)){
                $user = array("MemberId"=>$row['MemberId'], "UserName"=>$row['UserName']);
            }
        }

        echo mysqli_error($this->conn);

        mysqli_close($this->conn);
        return $user;
    }


    public function getHomeData($iMemberId)
    {
        $aReturn = array();
        $aReturn["Events"] = $this->getEventsData($iMemberId);
        $aReturn["BirthDays"] = $this->getAllBirthDays();
        $aReturn["Members"] = $this->getAllMembers();
        $aReturn["ToDos"] = $this->getAllNotifications($iMemberId);

        return($aReturn);
    }

    public function getAllNotifications($iMemberId)
    {
        $dCurrentDate = date("Y-m-d");

        $sCondition = "";
        $iToDoId = $_SESSION['id'];


//      if($dCurrentDate != '')
//            $sCondition = "WHERE TodoDate <='$dCurrentDate' AND DeadlineDate >= '$dCurrentDate' AND TodoMemberId ='$iMemberId'";

        $sQuery = "SELECT * FROM todo $sCondition";

        $sResult = mysqli_query($this->conn, $sQuery);

        $aToDos = array();

        if($sResult)
        {
            while($row = mysqli_fetch_array($sResult))
            {
                $aToDo = array("TodoId"=>$row['TodoId'],"Title"=>$row['Title'], "TodoDate"=>$row['TodoDate'], "TodoMemberId"=>$row['TodoMemberId'], "Description"=>$row['Description'], "DeadlineDate"=>$row['DeadlineDate']);
                array_push($aToDos, $aToDo);
            }

            return $aToDos;

        }

        echo mysqli_error($this->conn);

        mysqli_close($this->conn);
        return $aToDos;

    }

    public function getEventsData()
    {

        $sQuery = "SELECT E.*, M.MemberName AS 'Organizor' FROM events AS E INNER JOIN members AS M ON M.MemberId = E.EventOrganizorId";
        $sResult = mysqli_query($this->conn, $sQuery);

        $aEvents = array();

        if($sResult)
        {
            $aEvents = array();

            while($row = mysqli_fetch_array($sResult))
            {
                $aEvent = array("EventId"=>$row['EventId'],"EventName"=>$row['EventName'], "DateTime"=>$row['DateTime'], "Location"=>$row['Location'], "EventOrganizorId"=>$row['EventOrganizorId'],"Organizor"=>$row['Organizor'], "Description"=>$row['Description']);
                array_push($aEvents, $aEvent);
            }

            return $aEvents;

        }

        echo mysqli_error($this->conn);

        mysqli_close($this->conn);
        return $aEvents;

    }

    public function getAllBirthDays()
    {
        $dCurrentDate = date("Y-m-d");

        $sQuery = "SELECT * FROM members WHERE DateOfBirth = '$dCurrentDate'";
        $sResult = mysqli_query($this->conn, $sQuery);

        $aBirthdays = array();

        if($sResult)
        {
            $aBirthdays = array();

            while($row = mysqli_fetch_array($sResult))
            {
                $aBirhtday = array("MemberId"=>$row['MemberId'],"MotherId"=>$row['MotherId'],"FatherId"=>$row['FatherId'], "MemberName"=>$row['MemberName'], "UserName"=>$row['UserName'], "Password"=>$row['Password'], "Qualification"=>$row['Qualification'], "ContactNumber"=>$row['ContactNumber'], "CNIC"=>$row['CNIC'], "Email"=>$row['Email'], "Gender"=>$row['Gender'], "DateOfBirth"=>$row['DateOfBirth'], "SchoolName"=>$row['SchoolName'], "SchoolFees"=>$row['SchoolFees'], "SchoolContactNumber"=>$row['SchoolContactNumber'], "SchoolLatitude"=>$row['SchoolLatitude'], "SchoolLongitude"=>$row['SchoolLongitude'], "SchoolAddress"=>$row['SchoolAddress'], "MonthlyPocketMoney"=>$row['MonthlyPocketMoney'], "AccountBalance"=>$row['AccountBalance']);
                array_push($aBirthdays, $aBirhtday);
            }

            return $aBirthdays;

        }

        echo mysqli_error($this->conn);

        mysqli_close($this->conn);
        return $aBirthdays;

    }

    public function getAllMembers()
    {
         $sQuery = "SELECT * FROM members";
        $sResult = mysqli_query($this->conn, $sQuery);

        $aMembers = array();

        if($sResult)
        {
            $aBirthdays = array();

            while($row = mysqli_fetch_array($sResult))
            {
                $aMember = array("MemberId"=>$row['MemberId'],"MotherId"=>$row['MotherId'],"FatherId"=>$row['FatherId'], "MemberName"=>$row['MemberName'], "UserName"=>$row['UserName'], "Password"=>$row['Password'], "Qualification"=>$row['Qualification'], "ContactNumber"=>$row['ContactNumber'], "CNIC"=>$row['CNIC'], "Email"=>$row['Email'], "Gender"=>$row['Gender'], "DateOfBirth"=>$row['DateOfBirth'], "SchoolName"=>$row['SchoolName'], "SchoolFees"=>$row['SchoolFees'], "SchoolContactNumber"=>$row['SchoolContactNumber'], "SchoolLatitude"=>$row['SchoolLatitude'], "SchoolLongitude"=>$row['SchoolLongitude'], "SchoolAddress"=>$row['SchoolAddress'], "MonthlyPocketMoney"=>$row['MonthlyPocketMoney'], "AccountBalance"=>$row['AccountBalance']);
                array_push($aMembers, $aMember);
            }



        }
        echo mysqli_error($this->conn);

        mysqli_close($this->conn);
       return $aMembers;

    }

}


