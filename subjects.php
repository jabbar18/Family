<?php

session_start();

if(!isset($_SESSION['username'])){

      header("location: index.php");

  }

  else if($_SESSION['username'] == 'admin'){
    header("location: index.php");
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<title>Teachers</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="../../fonts.googleapis.com/css6454.css?family=Open+Sans:400italic,600italic,400,600"
        rel="stylesheet">
<link href="css/font-awesome.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/pages/dashboard.css" rel="stylesheet">
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
      <li class="active"><a href="#"><i class="shortcut-icon icon-user"></i><span><?php echo strtoupper($_SESSION['username']) ?> </a> </li>
        <li class="active"><a href="subjects.php"><i class="shortcut-icon icon-book"></i><span>Subjects</span> </a> </li>
        <li><a href="attendence.php"><i class="shortcut-icon icon-group"></i><span>New Attendence</span> </a> </li>
        <li><a href="settings.php"><i class="icon-cog "></i><span>Settings</span> </a> </li>
        <li><a href="files/usershandler.php?m=lo"><i class="icon-off"></i><span>Logout</span> </a> </li>
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
        <div class="span4">

          <!-- Teacher List -->
          <div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-book"></i>
              <h3>Subjects</h3>
            </div>
            <div class="widget-content">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th class="td-actions"> Subject Name </th>
                    <th class="td-actions"> Check Attendence </th>
                    <th class="td-actions"> Report </th>
                  </tr>
                </thead>
                <tbody>

                  <?php
                    include('./files/database/subjectdb.php');
                    $subjects = selectALlSubjects($_SESSION['id']);

                    foreach($subjects as $subject){
                  ?>

                  <tr>
                    <td> <?php echo $subject['title'] ?> </td>
                    <td class="td-actions"><form method='post'> <input type="hidden" name="subjectid" value="<?php echo $subject['id'] ?>" /> <button class="btn btn-danger btn-small"> <i class="btn-icon-only icon-group"> </i></button></form></td>
                    <td class="td-actions"><form action="report.php" method='get'> <input type="hidden" name="title" value="<?php echo $subject['title'] ?>" /><input type="hidden" name="subjectid" value="<?php echo $subject['id'] ?>" /> <button class="btn btn-danger btn-small"> <i class="btn-icon-only icon-book"> </i></button></form></td>
                  </tr>

                  <?php
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /Table List --> 
          <!-- /widget -->
        </div>
        <!-- /span6 -->


        <div class="span7">

          <!-- Teacher List -->
          <div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-user"></i>
              <h3>Attandence</h3>
            </div>
            <div class="widget-content">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th class="td-actions"> Student </th>
                    <th class="td-actions"> Roll Number </th>                
                    <th class="td-actions"> Department </th>
                    <th class="td-actions"> Year </th>
                    <th class="td-actions"> Semester </th>
                    <th class="td-actions"> Date </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    if(isset($_POST['subjectid'])){
                      $subjects = selectSubjectsAttendence($_POST['subjectid'], $_SESSION['id']);
                      if($subjects){
                      foreach($subjects as $subject){
                  ?>
                        <tr>
                          <td> <?php echo $subject['name'] ?> </td>
                          <td> <?php echo $subject['roll_number'] ?> </td>
                          <td> <?php echo $subject['title'] ?> </td>
                          <td> <?php echo $subject['year'] ?> </td>
                          <td> <?php echo $subject['semester'] ?> </td>
                          <td> <?php echo $subject['date'] ?> </td>
                        </tr>
                  <?php
                      }
                    }
                    }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- /Table List --> 
          <!-- /widget -->
        </div>

      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>
<!-- /main -->

</div>
<!-- /footer --> 
<!-- Le javascript
================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="../wp-content/themes/piha/js/top-bar.js" ></script>
<script type="text/javascript" src="../wp-content/themes/piha/js/bsa-ads.js" ></script>
<script src="js/excanvas.min.js"></script> 
<script src="js/chart.min.js" type="text/javascript"></script> 
<script src="js/bootstrap.js"></script>
<script language="javascript" type="text/javascript" src="js/full-calendar/fullcalendar.min.js"></script>
 
<script src="js/base.js"></script> 
	
</body>

</html>
