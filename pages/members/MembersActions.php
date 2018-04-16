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


}






?>