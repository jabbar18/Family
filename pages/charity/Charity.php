<?php

session_start();

if(!isset($_SESSION['username'])){

    header("location: ../../index.php");

}

else if($_SESSION['username'] != 'admin'){
    header("location: ../../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Charity Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/w3css.css" rel="stylesheet">
    <link href="../css/bootstrap-responsive.min.css" rel="stylesheet">
    <link href="../../fonts.googleapis.com/css6454.css?family=Open+Sans:400italic,600italic,400,600"
          rel="stylesheet">
    <link href="../css/font-awesome.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/pages/dashboard.css" rel="stylesheet">
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','../../www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-59852500-1', 'auto');
        ga('send', 'pageview');

    </script>
</head>
<body data-post="http://www.egrappler.com/templatevamp-free-twitter-bootstrap-admin-template/">
<!-- /navbar -->
<div class="subnavbar">
    <div class="subnavbar-inner">
        <div class="container">
            <ul class="mainnav">
                <li ><a href="Members.php"><i class="shortcut-icon icon-user"></i><span>Members</span> </a> </li>
                <li ><a href="../Events/Events.php"><i class="shortcut-icon icon-user"></i><span>Events</span> </a> </li>
                <li class="active"><a href="../Charity/Charity.php"><i class="shortcut-icon icon-user"></i><span>Charity</span> </a> </li>
                <li ><a href="../To_do/To_Do.php"><i class="shortcut-icon icon-user"></i><span>To Do</span> </a> </li>
                <li ><a href="../Expense/Expense.php"><i class="shortcut-icon icon-user"></i><span>Expense</span> </a> </li>
                <li><a href="../settings.php"><i class="icon-cog "></i><span>Settings</span> </a> </li>
                <li><a href="../files/usershandler.php?m=lo"><i class="icon-off"></i><span>Logout</span> </a> </li>
            </ul>
        </div>
        <!-- /container -->
    </div>
    <!-- /subnavbar-inner -->
</div>
<!-- /subnavbar -->
<div >
    <div class="main-inner">
        <div class="container">
            <div >

                    <?php
                    if(isset($_GET['m'])){
                        ?>
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                            <?php
                            echo $_GET['m'];
                            ?>
                        </div>
                        <?php
                    }
                    ?>

                <!-- member List -->
                <div>
                    <div >
                        <div class="w3-card-4 ">

                          <div class="w3-display-container w3-teal" style="height:50px;">
                                <div class="w3-padding w3-display-topleft"><h3>Charity</h3></div>
                                <div class="w3-padding w3-display-topright"><a href="./AddCharity.php"><button class="w3-btn w3-blue">Add Charity</button></a></div>

                            </div>

                            <table class="w3-table-all w3-hoverable" style="border: 0px">

                            <thead>
                            <tr class="w3-blue ">
                                <th> S# </th>
                                <th> Name  </th>
                                <th> Charity Donor </th>
                                <th> Amount </th>
                                <th> View </th>
                                <th> Edit </th>
                                <th> Delete </th>

                            </tr>
                            </thead>

                            <?php
                            include('CharityDB.php');

                            $aMembers = SelectAllCharityMembers(0);
                           
                        
                            $iCounter = 0;

                            foreach($aMembers as $aMember)
                            {
                                $iCounter++;
                                $charityId = $aMember['MemberId'];
                                $iDonorMemberId = $aMember['DonorMemberId'];
                                $aMembersName = SelectAllMembers($charityId);
                                $aDonorMembersName = SelectAllMembers($iDonorMemberId);
                               
                               
                                $sMemberName = $aMembersName[0]['MemberName'];
                                $sDonorMemberName = $aDonorMembersName[0]['MemberName'];
                             ?>

                                <tr>
                                    <td> <?php echo $iCounter ?> </td>
                                    <td> <?php echo $sMemberName ?> </td>
                                    <td> <?php echo $sDonorMemberName ?> </td>
                                    <td> <?php echo $aMember['DonateAmount'] ?> </td>
                                    <td ><a href="./ViewCharity.php?CharityId=<?php echo $aMember['CharityId'] ?>" class="btn w3-blue btn-small"><i class="btn-icon-only icon-eye-open"> </i></a></td>
                                    <td ><a href="./EditCharity.php?CharityId=<?php echo $aMember['CharityId'] ?>" class="btn w3-blue btn-small"><i class="btn-icon-only icon-eye-open"> </i></a></td>
                                    <td ><a href="CharityHandler.php?action=DeleteRecord&CharityId=<?php echo $aMember['CharityId'] ?>" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"> </i></a></td>
                                   </tr>
                                <?php
                            }
                            ?>


                        </table>
                    </div>
                </div>
                <!-- /Table List -->



                <!-- /widget -->
            </div>
            <!-- /span6 -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container -->
</div>
<!-- /main-inner -->

</div>
<!-- /main -->

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="../js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="../wp-content/themes/piha/js/top-bar.js" ></script>
<script type="text/javascript" src="../wp-content/themes/piha/js/bsa-ads.js" ></script>
<script src="../js/excanvas.min.js"></script>
<script src="../js/chart.min.js" type="text/javascript"></script>
<script src="../js/bootstrap.js"></script>
<script language="javascript" type="text/javascript" src="../js/full-calendar/fullcalendar.min.js"></script>

<script src="../js/base.js"></script>

</body>

</html>
