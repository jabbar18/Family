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

    public function addLocations($iMemberId, $iLatitude, $iLongitude)
    {
        $aReturn = array();
        $aReturn["MemberId"] = $iMemberId;
        $aReturn["Latitude"] = $iLatitude;
        $aReturn["Longitude"] = $iLongitude;

        $dLocationDate = date("Y-m-d H:i:s");

        $sQuery = "INSERT INTO tracking (MemberId, Latitude, Longitude, LocationDate) VALUES( '$iMemberId', '$iLatitude','$iLongitude', '$dLocationDate')";

        $sResult = mysqli_query($this->conn, $sQuery);

        if($sResult)
        {
            $isCreated = true;
        }
        else
        {
            $isCreated = false;
        }

        return($aReturn);

    }


    public function getHomeData($iMemberId)
    {
        $aReturn = array();
        $aReturn["MemberInfo"] = $this->getAllMembers($iMemberId);
        $aReturn["Events"] = $this->getEventsData($iMemberId);
        $aReturn["BirthDays"] = $this->getAllBirthDays();
        $aReturn["Members"] = $this->getAllMembers();
        $aReturn["Polls"] = $this->getPollsData($iMemberId);
        $aReturn["ToDos"] = $this->getAllTodos($iMemberId);
        $aReturn["Expenses"] = $this->getAllExpenses($iMemberId);
        $aReturn["Notifications"] = $this->getAllNotifications($iMemberId);


        return($aReturn);
    }

    public function getAllNotifications($iMemberId)
    {
        $dCurrentDate = date("Y-m-d");

        $aReturn = array();

        $sCondition = "";

        if($dCurrentDate != '')
            $sCondition = "WHERE TodoDate <='$dCurrentDate' AND DeadlineDate >= '$dCurrentDate' AND TodoMemberId ='$iMemberId'";


        $sQuery = "SELECT T.*, M.MemberName FROM todo AS T INNER JOIN members AS M ON T.TodoMemberId = M.MemberId $sCondition";


        $sResult = mysqli_query($this->conn, $sQuery);

        if($sResult)
        {
            while($row = mysqli_fetch_array($sResult))
            {
                $aToDo = array("Type" => "Todo", "TodoId"=>$row['TodoId'], "MemberName"=>$row['MemberName'],"Title"=>$row['Title'], "TodoDate"=>$row['TodoDate'], "TodoMemberId"=>$row['TodoMemberId'], "Description"=>$row['Description'], "Date"=>$row['DeadlineDate'], "Icon"=> 'create');
                array_push($aReturn, $aToDo);
            }
        }


        $dDay = date("d",strtotime($dCurrentDate));
        $dMonth = date("m",strtotime($dCurrentDate));

        if($dCurrentDate != '')
            $sCondition = "WHERE Day(DateOfBirth) = '$dDay' and Month(DateOfBirth) = '$dMonth'";


        $sQuery = "SELECT * FROM members $sCondition";

        $sResult = mysqli_query($this->conn, $sQuery);

        if($sResult)
        {



            while($row = mysqli_fetch_array($sResult))
            {
                $aBirthDay = array("Type" => "Birthday", "Title" => 'Today is '.$row["MemberName"].' Birthday', "MemberId"=>$row['MemberId'], "MemberName"=>$row['MemberName'], "Date"=>$row['DateOfBirth'], "Icon"=> 'archive');
                array_push($aReturn, $aBirthDay);
            }


        }

        echo mysqli_error($this->conn);

        return $aReturn;

    }


    public function getAllTodos($iMemberId)
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


        $sCondition = "";

        $sQuery = "SELECT P.*, COUNT(PA.QuestionId) AS 'Counting' FROM polls AS P LEFT JOIN polls_answers AS PA ON PA.QuestionId = P.PollId 
        GROUP BY P.PollId";

        $sResult = mysqli_query($this->conn, $sQuery);

        $aPolls = array();
        if($sResult)
        {
            while($row = mysqli_fetch_array($sResult))
            {
                $aPoll = array("PollId"=>$row['PollId'],"Question"=>$row['Question'], "Answer1"=>$row['Answer1'], "Answer2"=>$row['Answer2'], "Answer3"=>$row['Answer3'], "Answer4"=>$row['Answer4'],"PollStartDateTime"=>$row['PollStartDateTime'], "PollEndDateTime"=>$row['PollEndDateTime'], "PollAddedOn"=>$row['PollAddedOn'], "Notes"=>$row['Notes'], "PollAddedBy"=>$row['PollAddedBy'], "TotalVotes" => $row["Counting"]);
                array_push($aPolls, $aPoll);
            }
        }

        return $aPolls;

    }


    public function getAllExpenses($iMemberId)
    {
        $sCondition = "";

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

    public function getAllMembers($iMemberId = 0)
    {
        $sConditon = "";

        if($iMemberId  > 0)
            $sConditon = "WHERE MemberId = '$iMemberId'";

        $sQuery = "SELECT * FROM members $sConditon";
        $sResult = mysqli_query($this->conn, $sQuery);

        $aMembers = array();

        if($sResult)
        {
            $aBirthdays = array();

            while($row = mysqli_fetch_array($sResult))
            {
                if($row["Photo"] == "")
                {
                    if($row["Gender"] == 0)
                    {
                        $sPhoto = "http://techsvision.com/Family/dist/img/avatar5.png";
                    }
                    else
                    {
                        $sPhoto = "http://techsvision.com/Family/dist/img/avatar2.png";

                    }

                }
                else
                    $sPhoto = "http://techsvision.com/Family/files/".$row["Photo"];


                $aMember = array("MemberId"=>$row['MemberId'],"MotherId"=>$row['MotherId'],"FatherId"=>$row['FatherId'], "MemberName"=>$row['MemberName'], "UserName"=>$row['UserName'], "Password"=>$row['Password'], "Qualification"=>$row['Qualification'], "ContactNumber"=>$row['ContactNumber'], "CNIC"=>$row['CNIC'], "Email"=>$row['Email'], "Gender"=>$row['Gender'], "DateOfBirth"=>$row['DateOfBirth'], "SchoolName"=>$row['SchoolName'], "SchoolFees"=>$row['SchoolFees'], "SchoolContactNumber"=>$row['SchoolContactNumber'], "SchoolLatitude"=>$row['SchoolLatitude'], "SchoolLongitude"=>$row['SchoolLongitude'], "SchoolAddress"=>$row['SchoolAddress'], "MonthlyPocketMoney"=>$row['MonthlyPocketMoney'], "AccountBalance"=>$row['AccountBalance'], "Photo"=>$sPhoto);
                array_push($aMembers, $aMember);
            }



        }
        echo mysqli_error($this->conn);

        if($iMemberId > 0)
            return($aMember);

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

    public function addVote($iMemberId, $iPollId, $iAnswerId)
    {

        $sQuery = "INSERT INTO polls_answers (QuestionId, AnswerId, MemberId) VALUES('$iPollId', '$iAnswerId', '$iMemberId')";

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

    public function getMessages($iMemberId)
    {
        $sQuery = "SELECT M.* FROM messages AS M INNER JOIN members AS MM ON M.ToMemberId = MM.MemberId WHERE ((M.FromMemberId='$iMemberId') OR (M.ToMemberId='$iMemberId')) GROUP BY M.FromMemberId ORDER BY M.DataTime ";

        $sResult = mysqli_query($this->conn, $sQuery);

        $aMessages = array();

        if($sResult)
        {
            while($row2 = mysqli_fetch_array($sResult))
            {

                if($iMemberId == $row2['FromMemberId'])
                    $iMemberId = $row2['ToMemberId'];

                $sQuery2 = "SELECT * FROM members WHERE MemberId = '$iMemberId'";

                $sResult2 = mysqli_query($this->conn, $sQuery2);

                while($row = mysqli_fetch_array($sResult2))
                {

                    if ($row["Photo"] == "") {
                        if ($row["Gender"] == 0) {
                            $sPhoto = "http://techsvision.com/Family/dist/img/avatar5.png";
                        } else {
                            $sPhoto = "http://techsvision.com/Family/dist/img/avatar2.png";

                        }

                    } else
                        $sPhoto = "http://techsvision.com/Family/files/" . $row["Photo"];


                    $aMessage = array("MemberId"=>$row['MemberId'],"MotherId"=>$row['MotherId'],"FatherId"=>$row['FatherId'], "MemberName"=>$row['MemberName'], "UserName"=>$row['UserName'], "Password"=>$row['Password'], "Qualification"=>$row['Qualification'], "ContactNumber"=>$row['ContactNumber'], "CNIC"=>$row['CNIC'], "Email"=>$row['Email'], "Gender"=>$row['Gender'], "DateOfBirth"=>$row['DateOfBirth'], "SchoolName"=>$row['SchoolName'], "SchoolFees"=>$row['SchoolFees'], "SchoolContactNumber"=>$row['SchoolContactNumber'], "SchoolLatitude"=>$row['SchoolLatitude'], "SchoolLongitude"=>$row['SchoolLongitude'], "SchoolAddress"=>$row['SchoolAddress'], "MonthlyPocketMoney"=>$row['MonthlyPocketMoney'], "AccountBalance"=>$row['AccountBalance'], "Photo"=>$sPhoto, "Message"=>$row2['Message']);
                    array_push($aMessages, $aMessage);

                }


            }

        }
        echo mysqli_error($this->conn);

        return $aMessages;
    }

    public function addMessage($iMemberId)
    {
        $sMessage = $_GET['msg'];
        $iToMemberId = $_GET['to_id'];

        $dMessageDateTime = date('Y-m-d H:i:s');

        $sQuery = "INSERT INTO messages (Message, FromMemberId, ToMemberId, DateTime) VALUES('$sMessage', '$iMemberId','$iToMemberId', '$dMessageDateTime')";

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


    function ChatMessages($iMemberId)
    {
        $iToMemberId = $_GET['to_id'];

        $sQuery = "SELECT M.* FROM messages AS M WHERE ((M.FromMemberId='$iMemberId' AND M.ToMemberId='$iToMemberId') OR (M.FromMemberId='$iToMemberId' AND M.ToMemberId='$iMemberId'))";



        $sResult = mysqli_query($this->conn, $sQuery);

        $aMessages = array();
        if($sResult)
        {
            while($row = mysqli_fetch_array($sResult))
            {
                $aMessage = array("messageId"=>$row['MessageId'],"message"=>$row['Message'],"userId"=> $row['FromMemberId'], "toUserId"=>$row['ToMemberId'], "time"=>$row['DateTime']);
                array_push($aMessages, $aMessage);
            }

        }

        echo mysqli_error($this->conn);

        return $aMessages;

    }

}


