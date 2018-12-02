<?php

class DB_Functions
{

    private $conn;

    // constructor
    function __construct()
    {
        header('Access-Control-Allow-Origin: *');
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

        return $user;
    }


    public function getHomeData($iMemberId)
    {
        $aReturn = array();
        $aReturn["Events"] = $this->getEventsData($iMemberId);
        $aReturn["BirthDays"] = $this->getAllBirthDays();
        $aReturn["Members"] = $this->getAllMembers();
        $aReturn["ToDos"] = $this->getAllNotifications($iMemberId);
        $aReturn["Expenses"] = $this->getAllExpenses($iMemberId);
        $aReturn["Polls"] = $this->getPollsData($iMemberId);

        return($aReturn);
    }

    public function getAllNotifications($iMemberId)
    {
        $dCurrentDate = date("Y-m-d");

        $sCondition = "WHERE TodoMemberId ='$iMemberId' ORDER BY DeadlineDate DESC";


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

        return $aEvents;

    }

    public function getPollsData($iMemberId)
    {

        $dDate = date('Y-m-d');


        $sCondition = "WHERE P.PollStartDateTime >= '$dDate 00:00:00' AND PS.MemberId = '$iMemberId'";

        $sQuery = "SELECT P.*, PS.MemberId FROM polls AS P INNER JOIN polls_members AS PS ON PS.PollId = P.PollId INNER JOIN members AS M ON P. $sCondition";

        $sResult = mysqli_query($this->conn, $sQuery);

        $aPolls = array();
        if($sResult)
        {


            while($row = mysqli_fetch_array($sResult))
            {
                $aPoll = array("PollId"=>$row['PollId'],"Question"=>$row['Question'], "Answer1"=>$row['Answer1'], "Answer2"=>$row['Answer2'], "Answer3"=>$row['Answer3'], "Answer4"=>$row['Answer4'],"PollStartDateTime"=>$row['PollStartDateTime'], "PollEndDateTime"=>$row['PollEndDateTime'], "PollAddedOn"=>$row['PollAddedOn'], "Notes"=>$row['Notes'], "PollAddedBy"=>$row['PollAddedBy']);
                array_push($aPolls, $aPoll);
            }


        }

        return $aPolls;

    }


    public function getAllExpenses($iMemberId)
    {

        if($iMemberId > 0)
            $sCondition = "WHERE E.MemberId ='$iMemberId'";


        $sQuery = "SELECT E.*, M.MemberName FROM expenses AS E INNER JOIN members AS M ON E.MemberId = M.MemberId $sCondition";

        $sResult = mysqli_query($this->conn, $sQuery);

        $aExpenses = array();

        if($sResult)
        {

            while($row = mysqli_fetch_array($sResult))
            {
                $aExpensesItems = array();

                $aExpensesItems = $this->SelectAllExpensesItems($row['ExpenseId']);

                $aExpense = array("MemberId"=>$row['MemberId'], "MemberName"=>$row['MemberName'], "ExpenseId"=>$row['ExpenseId'], "Amount"=>$row['Amount'], "DateTime"=>$row['DateTime'], "ExpensesItems" => $aExpensesItems);
                array_push($aExpenses, $aExpense);




            }


        }

        echo mysqli_error($this->conn);

        return $aExpenses;

    }

    function SelectAllExpensesItems($iExpenseId)
    {
        $sCondition = "";

        if($iExpenseId > 0)
            $sCondition = "WHERE EI.ExpenseId ='$iExpenseId'";


        $sQuery = "SELECT EI.* FROM expenses_items AS EI $sCondition";

        $sResult = mysqli_query($this->conn, $sQuery);

        if($sResult)
        {
            $aExpensesItems = array();

            while($row = mysqli_fetch_array($sResult))
            {
                $aExpensesItem = array("ExpenseId"=>$row['ExpenseId'], "Amount"=>$row['Amount'], "Item"=>$row['Item']);
                array_push($aExpensesItems, $aExpensesItem);
            }

            return $aExpensesItems;

        }

        mysqli_close($GLOBALS['link']);
        return false;
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

       return $aMembers;

    }

    public function addTodo($iMemberId)
    {
        $sTitle = $_GET['title'];
        $sToDoDate = $_GET['tododate'];
        $sDeadlineDoDate = $_GET['tododeadlinedate'];
        $sDescription = $_GET['description'];


        $sToDoDate = date('Y-m-d', strtotime($sToDoDate));
        $sDeadlineDoDate = date('Y-m-d', strtotime($sDeadlineDoDate));

        $sQuery = "INSERT INTO todo (Title, TodoDate, DeadlineDate, Description, TodoMemberId ) VALUES( '$sTitle', '$sToDoDate','$sDeadlineDoDate', '$sDescription', '$iMemberId')";

        $sResult = mysqli_query($this->conn, $sQuery);

        if($sResult)
        {
            $isCreated = true;
        }
        else
        {
            $isCreated = false;
        }



        return $isCreated;


    }

}


