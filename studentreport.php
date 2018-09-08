<?php

session_start();


include('./files/database/reportdb.php');
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">

<head>
<meta charset="utf-8">
<title>Student Attendance Report Semester Wise</title>
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

<div >
  <div class="main-inner">
    <div class="container">
      <div class="span5" style="margin-left:5%;"> <a href="index.php"><img src="img/banner.png" width="800" height="150" alt=""/></a>
        <div class="span5" style="margin-left:30%;">




              </br>
              </br>

            </div> <!-- /widget-header -->

      <?php
        $reports = selectStudentCompleteReport($_GET['studentid']);

        if(!$reports){
          echo "<h1>No Record Found.</h1>";
        }

        for($i = 0; $i < count($reports); $i++){

          $lastYear = $reports[$i]['semester'];
          
      ?>
        <div class="span7" style="margin-left:20%;">

          <!-- Teacher List -->
          <div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-user"></i>
              <h3>Semester <?php echo $reports[$i]['semester'] .' - ' .$_GET['title']; ?> Attendance</h3>
            </div>
            <div class="widget-content">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th class="td-actions"> Subject </th>
                    <th class="td-actions"> Year </th>
                    <th class="td-actions"> Total Lectures </th>
                    <th class="td-actions"> Attended </th>

                  </tr>
                </thead>
                <tbody>
                  <?php
                      $j = 0;
                      for($j = $i; $j < count($reports); $j++, $i++){
                        $report = $reports[$j];

                        if($lastYear == $report['semester']){

                  ?>
                        <tr>
                          <td> <?php echo $report['title'] ?> </td>
                          <td> <?php echo $report['year'] ?> </td>
                          <td> 45 </td>
                          <td> <?php echo $report['report'] ?> </td>

                        </tr>
                  <?php
                        }else{
                          $i--;
                          $j--;
                          break;
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

        <?php
           if($j == count($reports)-1){
                break;
            }
          }
        ?>

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
