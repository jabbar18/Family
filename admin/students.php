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
<title>Students Management</title>
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
        <li ><a href="teachers.php"><i class="shortcut-icon icon-user"></i><span>Teachers</span> </a> </li>
        <li class="active"><a href="students.php"><i class="shortcut-icon icon-user"></i><span>Students</span> </a> </li>
        <li><a href="assets.php"><i class="icon-list-alt"></i><span>Assets</span> </a> </li>
        <li ><a href="settings.php"><i class="icon-cog "></i><span>Settings</span> </a> </li>
        <li><a href="files/usershandler.php?m=lo"><i class="icon-off"></i><span>Logout</span> </a> </li>
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>
<!-- /subnavbar -->
<div>
  <div class="main-inner">
    <div class="container">
        <div class="span12">
          
            <div class="widget">
              
              <div class="widget-header">
                <i class="icon-user"></i>
                <h3>Add Students</h3>
            </div> <!-- /widget-header -->
          
          <div class="widget-content">

            <?php
              if(isset($_GET['m'])){
            ?>

            <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <?php echo $_GET['m'] ?>
            </div>
            <?php
              }
            ?>
                  <form  action="./files/studenthandler.php" method="post" class="form-horizontal">

                    <input type="hidden" name="m" value="s" />

                    <div class="control-group">                     
                      <label class="control-label" for="name">Name</label>
                      <div class="controls">
                        <input type="text" class="span4" id="name" name="name" required>
                      </div> <!-- /controls -->
                    </div> <!-- /control-group -->
                  
                    <div class="control-group">                     
                      <label class="control-label" for="fname">Father Name</label>
                      <div class="controls">
                        <input type="text" class="span4" id="fname" name="fathername" required>
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->

                    <div class="control-group">                     
                      <label class="control-label" for="cast">Caste</label>
                      <div class="controls">
                        <input type="text" class="span4" id="cast" name="cast" required>
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->

                    <div class="control-group">                     
                      <label class="control-label" for="rollno">Roll Number</label>
                      <div class="controls">
                        <input type="text" placeholder="2K12/SWE/02" class="span4" id="rollno" name="rollnumber" required>
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->


                    <div class="control-group">                     
                      <label class="control-label" for="address">Address</label>
                      <div class="controls">
                        <input type="text" class="span4" id="address" name="address" required>
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->

                    <div class="control-group">                     
                      <label class="control-label" for="year">Academic Year</label>
                      <div class="controls">
                        <input type="text" class="span4" id="year" name="year" required>
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->

                    <div class="control-group">                     
                      <label class="control-label" for="dept">Department</label>
                      <div class="controls">
                        <select id="dept" name="department_id" required>
                          <?php
                            include('./files/database/assetsdb.php');
                            $departments = selectAllDepartments();
                            foreach($departments as $department){
                              echo "<option value=" .$department['id'] .">" .$department['title'] ."</option>";
                            }
                          ?>
                        </select>
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->


                    <div class="control-group">                  
                      <div class="controls">
                        <button class="btn btn-primary">ADD</button>
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->

                  </form>
          </div>
        </div>


          <!-- Teacher List -->
          <div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-th-list"></i>
              <h3>Students</h3>
            </div>
            <div class="widget-content">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th class="td-actions"> Name </th>
                    <th class="td-actions"> Father Name </th>
                    <th class="td-actions"> Caste </th>
                    <th class="td-actions"> Address </th>
                    <th class="td-actions"> Roll# </th>
                    <th class="td-actions"> Academic Year </th>
                    <th class="td-actions"> Department </th>
                    <th class="td-actions"> </th>
                  </tr>
                </thead>
                <tbody>

                  <?php

                    include('./files/database/studentdb.php');
                    $students = selectAllStudents();
                    foreach ($students as $student){
                  ?>
                    <tr>
                      <td> <?php echo $student['name'] ?> </td>
                      <td> <?php echo $student['fathername'] ?> </td>
                      <td> <?php echo $student['cast'] ?> </td>
                      <td> <?php echo $student['address'] ?> </td>
                      <td> <?php echo $student['rollnumber'] ?> </td>
                      <td> <?php echo $student['year'] ?> </td>
                      <td> <?php echo $student['department'] ?> </td>
                      <td class="td-actions"><a href="./files/studenthandler.php?m=d&studentid=<?php echo $student['id'] ?>" title="Delete Student" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"> </i></a>
                        <a target="_blank" href="./qrcode_images/<?php echo base64_encode($student['id']) ?>.png" title="QR Code" class="btn btn-primary btn-small"><i class="btn-icon-only icon-barcode"> </i></a>
                        <a  href="./report.php?title=<?php echo $student['name'] ?>&studentid=<?php echo $student['id'] ?>" title="QR Code" class="btn btn-primary btn-small"><i class="btn-icon-only icon-book"> </i></a>
                      </td>
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
