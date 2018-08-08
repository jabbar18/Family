<?php
   include('dbconnection.inc.php');

if(isset($_GET['submit'])) {
  
establishConnectionToDatabase();

    $Member_Name = $_GET['Member_Name'];
    $Qualification = $_GET['Qualification'];
    $Contact_Number = $_GET['Contact_Number'];
    $CNIC = $_GET['CNIC'];
    $Email = $_GET['Email'];
    $Gender = $_GET['Gender'];
    $Date_Of_Birth = $_GET['Date_Of_Birth'];
    $School_Name = $_GET['School_Name'];
    $School_Fees = $_GET['School_Fess'];
    $School_Contact = $_GET['School_Contact'];
    $School_Latitude = $_GET['School_Latitude'];
    $School_Longitude = $_GET['School_Longitude'];
    $School_Adress = $_GET['School_Adress'];
    $Monthly_Pocket = $_GET['Monthly_Pocket'];
    
    $sql = "insert into members (Member_Name, Qualification, Contact_Number, CNIC, Email, Gender, Date_Of_Birth, School_Name, School_Fees, School_Contact, School_Latitude, School_Longitude, School_Address, Monthly_Pocket) values('$Member_Name', '$Qualification', '$Contact_Number', '$CNIC', '$Email', '$Gender', '$Date_Of_Birth', '$School_Name', '$School_Fees', '$School_Contact', '$School_Latitude', '$School_Longitude', '$School_Adress', '$Monthly_Pocket')";

   

  if ($result = mysqli_query($link,$sql)) {
    header("location: clsMembers.php");
  }

   else 
   {
    echo "Please fill form.";
   }
 }
?>
