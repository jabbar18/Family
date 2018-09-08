<?php

  session_start();

  if(!isset($_SESSION['username'])){

      header("location: index.php");

  }

  if($_SESSION['username'] == 'admin'){
    header("location: index.php");
  }

?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<title>Take Attendance</title>
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
        <li><a href="subjects.php"><i class="shortcut-icon icon-book"></i><span>Subjects</span> </a> </li>
        <li class="active"><a href="attendence.php"><i class="shortcut-icon icon-group"></i><span>New Attendence</span> </a> </li>
        <li ><a href="settings.php"><i class="icon-cog "></i><span>Settings</span> </a> </li>
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
        <div class="span12">
          
            <div class="widget">
              
              <div class="widget-header">
                <i class="icon-group"></i>
                <h3>Todays Attendence</h3>
            </div> <!-- /widget-header -->
          
          <div class="widget-content">
            <?php
              if(!isset($_POST['subjectid'])){
            ?>
                  <form  method="post" class="form-horizontal" style="margin-left:20%;">
                    
                    <div class="control-group">                     
                      <label class="control-label" for="name">Subject</label>
                      <div class="controls">
                        <select name="subjectid">
                          <?php
                            include('./files/database/subjectdb.php');
                            $subjects = selectAllSubjects($_SESSION['id']);

                            foreach($subjects as $subject){
                              echo "<option value=" .$subject['id'] .">" .$subject['title'] ."</option>";
                            }
                          ?>
                        </select>  
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->

                    <div class="control-group">                     
                      <label class="control-label" for="name">Semester</label>
                      <div class="controls">
                        <select name="semester">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                          <option value="7">7</option>
                          <option value="8">8</option>
                        </select>  
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->

                    <div class="control-group">
                      <div class="controls">
                          <button class="btn btn-primary">Start</button>
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->

                  </form>
                <?php
                  }else{
                ?>
                  <!-- QRCODE Start -->
                  <div id="reader" style="width:290;height:290px;">
                  </div>
                
                  <div class="alert alert-success" id="status" align=center>
                    No QR Scanned.
                  </div>
                  <div class="alert alert-danger" id="error" align=center>
                    ----
                  </div>
                  <?php
                    }
                  ?>
                  <!-- QRCODE END -->
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

<!-- QRCODE Libraries -->
<script type="text/javascript" src="./js/qrcode_libs/html5-qrcode.min.js" ></script>
<script type="text/javascript" src="./js/qrcode_libs/jsqrcode-combined.min.js" ></script>

 <script type="text/javascript">
$(document).ready(function(){
  $('#reader').html5_qrcode(function(id){
      $.post( "./files/studenthandler.php", { m: "at", studentid: id, subjectid: <?php if(isset($_POST['subjectid'])) echo $_POST['subjectid'] ?>, semester: <?php if(isset($_POST['semester'])) echo $_POST['semester'] ?> })
      .done(function( data ) {

          if(data == 'no'){
            $('#error').html('Your Attendence Is Already Made For Today In This Subject');
            $('#status').html('');
          }else{
            $('#status').html(data);
            $('#error').html('-------------');
          }
      });

    },
    function(error){
      
    }, function(videoError){
      $('#status').html(videoError);
    }
  );
});

 </script>
	
</body>

</html>
