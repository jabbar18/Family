<?php

  session_start();

  if(isset($_SESSION['username'])){

      if($_SESSION['username'] == 'admin'){
        header('location: ./admin/index.php');
      }else{
        header("location: subjects.php");
      }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8">
<title>Teacher Login with QR-CODE</title>
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
	<div class="span5" style="margin-left:5%;"> <a href="index.php"><img src="img/banner.png" width="800" height="100" alt=""/></a>
        
<div class="widget" style="margin-left:30%; margin-top:5%; margin-right:-50%;" >
              
          <div class="widget-header">
                <i class="icon-user"></i>
                <h3>Teacher Login with QR-CODE</h3>
                
          </div> 
              <!-- /widget-header -->
          
          <div class="widget-content">
                  <!-- QRCODE Start -->
                  <div id="reader" style="width:290;height:290px;">
                  </div>
                
                  <div class="alert alert-success" id="status" style="margin-top:3%;" align=center>
                    No QR Scanned.
                  </div>
                  <!-- QRCODE END -->

                  <a  style="margin-left:30%;" href='index.php'>Login with username & passowrd</a>
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
  $('#reader').html5_qrcode(function(qrdata){
      $.post( "./files/usershandler.php", { m: "ql", data: qrdata})
      .done(function( data ) {
          if(data == 'n'){
            $('#status').html('Sorry, Your QR Can\'t Be Use As Login');
          }else{
            window.location = "./subjects.php"; 
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
