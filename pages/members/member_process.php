<?php
   include('dbconnection.inc.php');

if(isset($_GET['submit'])) {

    $Member_Name = $_GET['Member_Name'];
    $Qualification = $_GET['Qualification'];
    $Contact_Number = $_GET['Contact_Number'];
    $Email = $_GET['Email'];
    $Gender = $_GET['Gender'];
    $Date_Of_Birth = $_GET['Date_Of_Birth'];
    

    $sql = "insert into members (Member_Name, Qualification, Contact_Number, Email, Gender, Date_Of_Birth) values('$Member_Name', '$Qualification', '$Contact_Number', '$Email', '$Gender', '$Date_Of_Birth')";
   

  if ($result = $conn->query($sql)) {
    echo "Your data is saved.";
  }

   else 
   {
    echo "Please fill form.";
   }
 }
?>
