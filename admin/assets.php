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
<title>Assests Management</title>
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
        <li><a href="students.php"><i class="shortcut-icon icon-user"></i><span>Students</span> </a> </li>
        <li class="active"><a href="assets.php"><i class="icon-list-alt"></i><span>Assets</span> </a> </li>
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

        <div class="span5">
          
            <div class="widget">
              
              <div class="widget-header">
                <i class="icon-bookmark"></i>
                <h3>Add Departments</h3>
            </div> <!-- /widget-header -->

          <div class="widget-content">
                  <form action="./files/assetshandler.php" method="post" class="form-horizontal">

                    <input type="hidden" name="m" value="sd">

                    <div class="control-group">                     
                      <label class="control-label" for="name">Name</label>
                      <div class="controls">
                        <input type="text" class="span2" id="name" name="title" required >
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->
                  
                    <div class="control-group">                     
                      <div class="controls">
                        <button class="btn btn-primary">ADD</button>
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->

                  </form>

                  <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th class="td-actions"> Name </th>
                    <th class="td-actions"> </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    include('./files/database/assetsdb.php');
                    $departments = selectAllDepartments();

                    foreach ($departments as $department) {
                  ?>
                    <tr>
                      <td> <?php echo $department['title'] ?> </td>
                      <td class="td-actions"><a  href="./files/assetshandler.php?m=dd&departmentid=<?php echo $department['id'] ?>" title="Delete Student" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"> </i></td>
                    </tr>
                  <?php
                    }
                  ?>
                </tbody>
              </table>
          </div>
        </div>

          <!-- /widget -->
        </div>
        <!-- /span6 --> 

        <div class="span5">
          
            <div class="widget">
              
              <div class="widget-header">
                <i class="icon-book"></i>
                <h3>Add Subjects</h3>
            </div> <!-- /widget-header -->
          
          <div class="widget-content">
                  <form action="./files/assetshandler.php" method="post" class="form-horizontal">

                    <input type="hidden" name="m" value="ss" />

                    <div class="control-group">                     
                      <label class="control-label" for="name">Name</label>
                      <div class="controls">
                        <input type="text" class="span2" id="name" name="title" required>
                      </div> <!-- /controls -->
                    </div> <!-- /control-group -->
                  
                    <div class="control-group">                     
                      <div class="controls">
                        <button class="btn btn-primary">ADD</button>
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->

                  </form>

                  <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th class="td-actions"> Name </th>
                    <th class="td-actions"> </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $subjects = selectAllSubjects();
                    foreach($subjects as $subject){
                  ?>
                    <tr>
                      <td> <?php echo $subject['title'] ?> </td>
                      <td class="td-actions"><a href="./files/assetshandler.php?m=ds&subjectid=<?php echo $subject['id'] ?>" title="Delete Student" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"> </i></td>
                    </tr>
                  <?php
                    }
                  ?>
                
                </tbody>
              </table>
          </div>
        </div>

          <!-- /widget -->
        </div>
        <!-- /span6 --> 

        <div class="span5">
          
            <div class="widget">
              
              <div class="widget-header">
                <i class="icon-book"></i>
                <h3>Assign Subject To Teacher</h3>
            </div> <!-- /widget-header -->
          
          <div class="widget-content">
                  <form action="./files/assetshandler.php" method="post" class="form-horizontal">

                      <input type="hidden" name="m" value="as" />

                    <div class="control-group">                     
                      <label class="control-label" for="teacher">Teacher</label>
                      <div class="controls">
                        <select id="teacher" name="teacherid">
                          <?php
                            include("./files/database/teacherdb.php");
                            $teachers = selectAllTeachers();

                            foreach($teachers as $teacher){
                              echo "<option value=" .$teacher['id'] .">" .$teacher['name'] ."</option>";
                            }
                          ?>

                        </select>
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->

                    <div class="control-group">                     
                      <label class="control-label" for="subject">Subjects</label>
                      <div class="controls">
                        <select id="subject" name="subjectid">
                          <?php
                            $subjects = selectAllSubjects();

                            foreach($subjects as $subject){
                              echo "<option value=" .$subject['id'] .">" .$subject['title'] ."</option>";
                            }
                          ?>
                        </select>
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->
                  
                    <div class="control-group">                     
                      <div class="controls">
                        <button class="btn btn-primary">Assign</button>
                      </div> <!-- /controls -->       
                    </div> <!-- /control-group -->

                  </form>

                  <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th class="td-actions"> Teacher </th>
                    <th class="td-actions"> Subject </th>
                    <th class="td-actions"> </th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $results = selectTeachersAndTheirSubjects();
                    foreach($results as $result){
                  ?>
                  <tr>
                    <td> <?php echo $result['name'] ?> </td>
                    <td> <?php echo $result['title'] ?> </td>
                    <td class="td-actions"><a href="./files/assetshandler.php?m=rs&subjectid=<?php echo $result['subject_id'] ?>&teacherid=<?php echo $result['teacher_id'] ?>"title="Delete Student" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"> </i></td>
                  </tr>
                <?php
                  }
                ?>
                </tbody>
              </table>
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

<!-- /extra -->
<div class="footer">
  <div class="footer-inner">
    <div class="container">
      <div class="row">
        <div class="span12"> &copy; 2016 <a href="../index.html">QR Code Based Student Attendance System</a>. </div>
        <!-- /span12 --> 
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /footer-inner --> 
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
