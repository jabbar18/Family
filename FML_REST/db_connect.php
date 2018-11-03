<?php
class DB_Connect {
    private $conn;
 
    // Connecting to database
    public function connect() {

         // Connecting to mysql database
        $DB_USER_NAME = "root";
        $DB_PASSWORD = "root";
        $DB_HOST = "localhost";
        $DB_NAME = "family";

        $this->conn = mysqli_connect($DB_HOST, $DB_USER_NAME, $DB_PASSWORD, $DB_NAME) ;

        // return database handler
        return $this->conn;
    }
}
 
?>