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
    <title>Events Management</title>
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
                <li ><a href="../Members/Members.php"><i class="shortcut-icon icon-user"></i><span>Members</span> </a> </li>
                <li class="active"><a href="Events.php.php"><i class="shortcut-icon icon-user"></i><span>Events</span> </a> </li>
                <li><a href="../assets.php"><i class="icon-list-alt"></i><span>Assets</span> </a> </li>
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
                        <h3>Add Event</h3>
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

                        <form action="EventsHandler.php" method="post" class="form-horizontal">

                            <input type="hidden" name="action" value="AddRecord" />

                            <div class="control-group">
                                <label class="control-label" for="name">Name</label>
                                <div class="controls">
                                    <input type="text" class="span4" id="name" name="name" required>
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->

                            <div class="control-group">
                                <label class="control-label" for="dob">Date of Birth</label>
                                <div class="controls">
                                    <input type="date" class="span4" id="dob" name="dob" required range=" min=5 ">
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->

                            <div class="control-group">
                                <label class="control-label" for="uname">Gender</label>
                                <div class="controls">
                                    <input type="radio" class="" id="male" name="gender" checked range=" min=5 "> Male
                                    <input type="radio" class="" id="female" name="gender" required range=" min=5 "> Female
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->


                            <div class="control-group">
                                <label class="control-label" for="uname">User Name</label>
                                <div class="controls">
                                    <input type="text" class="span4" id="uname" name="uname" required range=" min=5 ">
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->

                            <div class="control-group">
                                <label class="control-label" for="password">Password</label>
                                <div class="controls">
                                    <input type="password" class="span4" id="password" name="password" range=" min=5 ">
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->

                            <div class="control-group">
                                <label class="control-label" for="cnumber">Contact Number</label>
                                <div class="controls">
                                    <input type="number" class="span4" id="cnumber" name="cnumber" required>
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->

                            <div class="control-group">
                                <label class="control-label" for="cnic">CNIC</label>
                                <div class="controls">
                                    <input type="number" class="span4" id="cnic" name="cnic">
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->



                            <div class="control-group">
                                <label class="control-label" for="email">Email Address</label>
                                <div class="controls">
                                    <input type="email" class="span4" id="email" name="email" range=" min=5 ">
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->

                            <div class="control-group">
                                <label class="control-label" for="money">Monthely Pocket Money</label>
                                <div class="controls">
                                    <input type="number" class="span4" id="money" name="money" range=" min=5 ">
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->

                            <div class="control-group">
                                <label class="control-label" for="qualification">Qualification</label>
                                <div class="controls">
                                    <input type="text" class="span4" id="qualification" name="qualification" range=" min=5 ">
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->

                            <div class="control-group">
                                <label class="control-label" for="sname">School Name</label>
                                <div class="controls">
                                    <input type="text" class="span4" id="sname" name="sname" range=" min=5 ">
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->

                            <div class="control-group">
                                <label class="control-label" for="scontact">School Contact Number</label>
                                <div class="controls">
                                    <input type="text" class="span4" id="scontact" name="scontact" range=" min=5 ">
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->

                            <div class="control-group">
                                <label class="control-label" for="sfees">School Fees</label>
                                <div class="controls">
                                    <input type="text" class="span4" id="sfees" name="sfees" range=" min=5 ">
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->

                            <div class="control-group">
                                <label class="control-label" for="saddress">School Address</label>
                                <div class="controls">
                                    <input type="text" class="span4" id="saddress" name="saddress" range=" min=5 ">
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->

                            <div class="control-group">
                                <label class="control-label" for="slatitude">School Latitude</label>
                                <div class="controls">
                                    <input type="text" class="span4" id="slatitude" name="slatitude" range=" min=5 ">
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->

                            <div class="control-group">
                                <label class="control-label" for="slongitude">School Longitude</label>
                                <div class="controls">
                                    <input type="text" class="span4" id="slongitude" name="slongitude" required range=" min=5 ">
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->


                            <div class="control-group">
                                <div class="controls">
                                    <button class="btn btn-primary" style="width: 200px">Add Event</button>
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->

                        </form>
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
