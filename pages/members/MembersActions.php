<?php


class MembersActions 
{   
    public $sLink;
   

    function __construct()
    {
    
    }


    function AddMember($link)
    {   

        $sMemberName = $_POST['name'];
        $sUserName = $_POST['uname'];
        $sPassword = $_POST['password'];
        $sQualification = $_POST['qulatification'];
        $dContactNumber = $_POST['cnumber'];
        $dCNIC = $_POST['cnic'];
        $sEmail = $_POST['email'];
        $sGender = $_POST['gender'];
        $dDateofBirth = $_POST['dob'];
        $sSchoolName = $_POST['sname'];
        $sSchoolFees = $_POST['sfees'];
        $sSchoolContact = $_POST['scontact'];
        $dSchoolLatitude = $_POST['slatitude'];
        $dSchoolLongitude = $_POST['slongitude'];
        $sSchoolAddress = $_POST['saddress'];
        $dMoney = $_POST['money'];

        
        $sQuery = "INSERT INTO family_members (MemberName, UserName, Password, Qualification, ContactNumber, CNIC, Email, Gender, DateOfBirth, SchoolName, SchoolFees, SchoolContactNumber, SchoolLatitude, SchoolLongitude, SchoolAddress, MonthlyPocketMoney) VALUES('$sMemberName', '$sUserName', '$sPassword', '$sQualification', '$dContactNumber', '$dCNIC', '$sEmail', '$sGender', '$dDateofBirth', '$sSchoolName', '$sSchoolFees', '$sSchoolContact', '$dSchoolLatitude', '$dSchoolLongitude', '$sSchoolAddress', '$dMoney')";

        if ($result = mysqli_query($link,$sQuery)) 
        {
            header("location: ../members/Members.php");
        }
        else 
        {
             return("Please fill form.");
        }


    }

    function DeleteMember($link)
    {   

        $iMemberId = $_GET['MemberId'];
               
        $sQuery = "DELETE From family_members WHERE MemberId = $iMemberId";
        
        if ($result = mysqli_query($link,$sQuery)) 
        {
            header("location: ../members/Members.php");
        }
        else 
        {
             return("Please fill form.");
        }

    }


    function ViewMember($link)
    {   

        $iMemberId = $_GET['MemberId'];
               
        $sQuery = "SELECT MemberId, MemberName, SchoolName, SchoolFees, SchoolContactNumber, SchoolLatitude, SchoolLongitude, SchoolAddress, MonthlyPocketMoney From family_members WHERE MemberId = $iMemberId";

         $result = mysqli_query($link,$sQuery);

        if ($result->num_rows > 0) {
            
            echo '<div class="body table-responsive">
                  <table class="table table-hover" >
                  <thead>
                  <tr>
                  <th>#</th>
                  <th>Member Name</th>
                  <th>School Name</th>
                  <th>School Fees</th>
                  <th>School Contact Number</th>
                  <th>School Latitude</th>
                  <th>School Longitude</th>
                  <th>School Address</th>
                  <th>Monthly Pocket Money</th>
                  </tr>
             </thead>'; 

             
        while($row = mysqli_fetch_array($result))
        {
            echo '<tbody>
                  <tr>      
                  <td>'.$row["MemberId"].'</td>
                  <td>'.$row["MemberName"].'</td>
                  <td>'.$row["SchoolName"].'</td>                                    
                  <td>'.$row["SchoolFees"].'</td>
                  <td>'.$row["SchoolContactNumber"].'</td>
                  <td>'.$row["SchoolLatitude"].'</td>
                  <td>'.$row["SchoolLongitude"].'</td>
                  <td>'.$row["SchoolAddress"].'</td>
                  <td>'.$row["MonthlyPocketMoney"].'</td>
                  </tr>';
                  
        }

    }

      else
                {

                    echo '<tr><td>Data is not Available</td></tr>';

                }
     
    }


}   //end class

?>