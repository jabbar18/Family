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


    public function getSubjects($teacher_id)
    {
        $result_array = array();
        $result_array["subjects"] = array();
        $stmt = $this->conn->prepare("SELECT * FROM 1095089.subject WHERE subject_id IN (SELECT subject_id FROM teacher_has_subjects WHERE teacher_id = ? )");
        $stmt->bind_param("i", $teacher_id);
        $stmt->execute();

        $result = $stmt->get_result();

        $stmt->store_result();

        while ($row = $result->fetch_assoc()) {
            $tmp = array();
            $tmp["subject_id"] = $row["subject_id"];
            $tmp["title"] = $row["title"];
            array_push($result_array["subjects"], $tmp);
        }


        $stmt->close();
        return $result_array;

    }

    public function canMarkAttendance($teacher_id, $subject_id, $student_id, $date)
    {
        $stmt = $this->conn->prepare("SELECT *  FROM attendence where teacher_id = ? AND subject_id = ? AND student_id = ? AND date = ?");

        $stmt->bind_param("iiis", $teacher_id, $subject_id, $student_id, $date);

        $stmt->execute();

        $stmt->store_result();

        if (!$stmt->num_rows > 0) {
            // can mark
            $stmt->close();
            return true;
        } else {
            // can not mark
            $stmt->close();
            return false;
        }
    }

    public function markAttendance(
        $teacher_id, $student_id, $subject_id, $date, $attendance_year, $semester
    )
    {


        $stmt = $this->conn->prepare("INSERT INTO attendence (teacher_id, subject_id, student_id, date, attendence_year, semester) values(?, ?, ?, ?, ?, ?)");
         $stmt->bind_param("iiissi",  $teacher_id, $subject_id, $student_id, $date, $attendance_year, $semester);





        $result = $stmt->execute();



        $stmt->close();

        // check for successful store
        if ($result) {
            return true;
        } else {
            return false;
        }
    }


    //Get Student Name by Id

    public function getStudentName_Id($id)
    {

      $stmt = $this->conn->prepare("SELECT name FROM student WHERE student_id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        $result = $stmt->get_result();

        $stmt->store_result();

        while ($row = $result->fetch_assoc()) {
            return $row["name"];
        }

        $stmt->close();


    }





}


