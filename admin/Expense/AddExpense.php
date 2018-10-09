<?php

session_start();

if(!isset($_SESSION['username']))
{
    header("location: ./index.php");
}

else if($_SESSION['username'] != 'admin')
{
    header("location: ../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Members Management</title>
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
                <li><a href="../Events/Events.php"><i class="shortcut-icon icon-user"></i><span>Events</span> </a> </li>
                 <li ><a href="../Charity/Charity.php"><i class="shortcut-icon icon-user"></i><span>Charity</span> </a> </li>
                 <li><a href="../To_do/To_Do.php"><i class="shortcut-icon icon-user"></i><span>To Do</span> </a> </li>
                 <li class="active" ><a href="Expense.php"><i class="shortcut-icon icon-user"></i><span>Expense</span> </a> </li>
                <li><a href="../assets.php"><i class="icon-list-alt"></i><span>Assets</span> </a> </li>
                <li><a href="../settings.php"><i class="icon-cog "></i><span>Settings</span> </a> </li>
                <li class="active" ><a href="Expense.php"><i class="shortcut-icon icon-user"></i><span>Expense</span> </a> </li>
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
                        <h3>Add Expense</h3>
                    </div> <!-- /widget-header -->

                    <div class="widget-content">
                        <?php
                            if(isset($_GET['m']))
                            {
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

                        <!-- <form action="ExpenseHandler.php" method="post" class="form-horizontal"> -->
                            <!-- <input type="hidden" name="action" value="AddRecord" /> -->

                            <div class="control-group">
                                <label class="control-label" for="name">Members</label>
                                <div class="controls">
                                    <select id="member_id" name="member_id" required>
                                        <option value="0">Select A Member</option>
                                      <?php
                                        include('../Members/MembersDB.php');
                                        $members = SelectAllMembers(0);
                                        foreach($members as $member)
                                        {
                                          echo "<option value=" .$member['MemberId'] .">" .$member['MemberName'] ."</option>";
                                        }
                                      ?>
                                    </select>
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->

                            <div class="control-group">
                                <label class="control-label" for="Balance">Balance</label>
                                <div class="controls">
                                    <input type="number" disabled="disabled" class="span4" id="balance" value="0" name="balance" required range=" min=5 ">
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->

                            <div class="control-group">
                                <label class="control-label" for="Expense Date">Expense Date</label>
                                <div class="controls">
                                    <input type="date" class="span4" id="exp_date" name="exp_date" required range=" min=5 ">
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->

                            <div class="control-group">
                                <label class="control-label" for="Items">Add Items</label>
                                <div class="controls">
                                    <input type="text" class="span2" id="item" name="">
                                    <input type="number" class="span2" id="amount" name="">
                                    <button type="button" class="btn btn-info btn-xs" id="item_add" name="">+</button>
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->


                            <div class="control-group">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Amount</th>
                                            <th>Remove</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tmp_tbody"></tbody>
                                </table>
                            </div>

                            <div class="control-group">
                                <div class="controls">
                                    <button class="btn btn-primary" id="add_exp" style="width: 200px">Add Expense</button>
                                </div> <!-- /controls -->
                            </div> <!-- /control-group -->

                        <!-- </form> -->
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
<script>
    $(document).ready(function(){
        var action= 'AccountBalance';
        $("#member_id").change(function(){
            var MemberId= $(this).val();
            // alert(MemberId);
            $.ajax({
                url:'../Members/MembersHandler.php',
                type:'POST',
                data:{action:action,MemberId:MemberId},
                success:function(msg)
                {
                    $("#balance").val(msg);
                }
            })
        })

        $("#item_add").click(function(){
            var item= $("#item").val();
            if(item==''){alert("Item Fiels Can Not Be Blank!");return false;}
            var amount= $("#amount").val();
            if(amount < 0 || amount == '')
            {
                amount=0;
                // alert("Amount Fiels Can Not Be Negative!");
                // return false;
            }
            var data= "<tr><td class='item'>"+item+"</td><td class='amount'>"+amount+"</td><td><button class='btn btn-danger rmv'>X</button></td></tr>";
            $("#tmp_tbody").append(data);
        })

     $(document).on('click','.rmv', function(){
           $(this).closest('tr').remove();
       })

        $("#add_exp").click(function(){
            var tmp_tbody= $("#tmp_tbody").html();
            if(tmp_tbody==0)
            {
                alert("Add Some Item To The Table");
                return false;
            }
            else
            {
                var items=[];
                var amount=[];
                var amount_sum=0;
                $("#tmp_tbody tr").each(function(){
                    items.push($(this).closest('tr').find('.item').html());
                    amount.push($(this).closest('tr').find('.amount').html());
                    amount_sum+= +$(this).closest('tr').find('.amount').html();
                })
            }
            var member_id= $("#member_id").val();
            if(member_id==0){alert("Select A Member!");return false;}
            var balance= $("#balance").val();
            var exp_date= $("#exp_date").val();
            if(exp_date==0){alert("Select A Date!");return false;}
            var action= "AddRecord";
            $.ajax({
                url:'ExpenseHandler.php',
                type:'POST',
                data:{action:action, amount_sum:amount_sum, items:items, amount:amount, member_id:member_id, balance:balance, exp_date:exp_date},
                success:function(msg)
                {
                    // alert(msg);
                    location.assign(msg);
                }
            })
        })
    })
</script>

</body>
</html>