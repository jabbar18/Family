<?php

session_start();

if(!isset($_SESSION['username'])){

    header("location: ./index.php");

}

else  if($_SESSION['username'] != 'admin'){
    header("location: ../index.php");
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
            <div class="span12">

                <div class="widget">

                    <div class="widget-header">
                        <i class="icon-user"></i>
                        <h3>Add Charity</h3>
                    </div> <!-- /widget-header -->

                    <div class="widget-content">

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
                         <?php
                            include('CharityDB.php');
                            // include_once('../Members/MembersDB.php'); 

                            $iCharityId = $_GET['CharityId'];
                            // $iMemberId = $_GET['MemberId'];

                            $aCharityMembers = SelectAllCharityMembers($iCharityId);
                            
                       
                            foreach($aCharityMembers as $aCharityMember)
                            {
                                
                             ?>

                        <form action="CharityHandler.php" method="post" class="form-horizontal">

                            <input type="hidden" name="action" value="EditRecord" />
                            <input type="hidden" name="id" value="<?php echo $iCharityId; ?>" />

                            <div class="control-group">
                                <label class="control-label" for="name">Name</label>
                                <div class="controls">
                                <select  name="name" id="name" class="mdb-select md-form colorful-select dropdown-primary" style="width: 23em" searchable="Search here..">
                                <option value="" disabled selected>Select Member Name</option>
                                
                                <?php 
                                    
                                      $aMembers = SelectAllMembers(0);
                                      
                                        foreach($aMembers as $aMember)
                                    {
                                        $select="";
                                    if($aMember['MemberId']  == $aCharityMember['MemberId']  ) 
                                        { $select="Selected='true'";} 
                                     ?>
                                  <option value="<?php echo $aMember['MemberId']; ?>" <?php  echo $select;  ?>   ><?php echo $aMember['MemberName'] ."( ".   $aMember['UserName'] .")" ?></option>

                                      <?php } ?>  
                               
                            </select>
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->
                                    
                          <div class="control-group">
                                <label class="control-label" for="name">Donor Name</label>
                                <div class="controls">
                            <select name="donorid"  id="donorid" class="mdb-select md-form colorful-select dropdown-primary" style="width: 23em" searchable="Search here..">
                                <option value="" disabled selected>Select Donor Name</option>
                                
                                <?php 
                                    
                                      $aMembers = SelectAllMembers(0);
                                      
                                        foreach($aMembers as $aMember)
                                    {
                                        $select="";
                                    if($aMember['MemberId']  == $aCharityMember['DonorMemberId']  ) 
                                        { $select="Selected='true'";} 
                                     ?>
                                  <option value="<?php echo $aMember['MemberId']; ?>" <?php  echo $select;  ?>   ><?php echo $aMember['MemberName'] ."( ".   $aMember['UserName'] .")" ?></option>

                                      <?php } ?>  
                            </select>
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->
                           
                            <div class="control-group">
                                <label class="control-label" for="slongitude">Account Balance</label>
                                <div class="controls">
                                    <input type="number" class="span4" id="donateammount"  name="donateammount" value="<?php  echo $aCharityMember['DonateAmount'] ?>" required range=" min=5 ">
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->

                            <div class="control-group">
                                <label class="control-label" for="dob">Date</label>
                                <div class="controls">
                                    <input type="date" class="span4" id="donatedate"  value="<?php echo $aCharityMember['DonateDateTime'] ?>" name="donatedate" required range=" min=5 ">
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->

                            

            
                           


                            <div class="control-group">
                                <div class="controls">
                                    <button class="btn btn-primary" style="width: 200px">Update Charity</button>
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->

                        </form>
                        <?php }?>
                    </div>
                </div>

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
