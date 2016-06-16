<?php
session_start();
require_once('functions.php');

authenticate();

login_check();

$db=dbconnect();


// Day calculation

  $db=dbconnect();

      if (isset($_POST['search']) && !empty($_POST['start_from'])) {
              $start_from= $_POST['start_from'];
              $week1= date('Y-m-d', strtotime($start_from));
              $week2= date('Y-m-d', strtotime($week1. ' + 7 days'));
              $week3= date('Y-m-d', strtotime($week2. ' + 7 days'));
              $week4= date('Y-m-d', strtotime($week3. ' + 7 days'));
              $week5= date('Y-m-d', strtotime($week4. ' + 7 days'));

             
           } else{
             $today= date('Y-m-d');
             $week1= date('Y-m-d', strtotime($today . ' - 28 days'));
           }

         // Day counting
              $day1= date ("Y-m-d", strtotime("+1 day", strtotime($week1)));
              $day2= date ("Y-m-d", strtotime("+1 day", strtotime($day1)));
              $day3= date ("Y-m-d", strtotime("+1 day", strtotime($day2)));
              $day4= date ("Y-m-d", strtotime("+1 day", strtotime($day3)));
              $day5= date ("Y-m-d", strtotime("+1 day", strtotime($day4)));
              $day6= date ("Y-m-d", strtotime("+1 day", strtotime($day5)));
              $day7= date ("Y-m-d", strtotime("+1 day", strtotime($day6)));
              $day8= date ("Y-m-d", strtotime("+1 day", strtotime($day7)));
              $day9= date ("Y-m-d", strtotime("+1 day", strtotime($day8)));
              $day10= date ("Y-m-d", strtotime("+1 day", strtotime($day9)));
              $day11= date ("Y-m-d", strtotime("+1 day", strtotime($day10)));
              $day12= date ("Y-m-d", strtotime("+1 day", strtotime($day11)));
              $day13= date ("Y-m-d", strtotime("+1 day", strtotime($day12)));
              $day14= date ("Y-m-d", strtotime("+1 day", strtotime($day13)));
              $day15= date ("Y-m-d", strtotime("+1 day", strtotime($day14)));
              $day16= date ("Y-m-d", strtotime("+1 day", strtotime($day15)));
              $day17= date ("Y-m-d", strtotime("+1 day", strtotime($day16)));
              $day18= date ("Y-m-d", strtotime("+1 day", strtotime($day17)));
              $day19= date ("Y-m-d", strtotime("+1 day", strtotime($day18)));
              $day20= date ("Y-m-d", strtotime("+1 day", strtotime($day19)));
              $day21= date ("Y-m-d", strtotime("+1 day", strtotime($day20)));
              $day22= date ("Y-m-d", strtotime("+1 day", strtotime($day21)));
              $day23= date ("Y-m-d", strtotime("+1 day", strtotime($day22)));
              $day24= date ("Y-m-d", strtotime("+1 day", strtotime($day23)));
              $day25= date ("Y-m-d", strtotime("+1 day", strtotime($day24)));
              $day26= date ("Y-m-d", strtotime("+1 day", strtotime($day25)));
              $day27= date ("Y-m-d", strtotime("+1 day", strtotime($day26)));
              $day28= date ("Y-m-d", strtotime("+1 day", strtotime($day27)));



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Weekly Report | Verizon</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.theme.css">
      
 <script type="text/javascript" src="js/canvasjs.js"></script>

 <script type="text/javascript">
  window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer",
    {
      title:{
      text: "Weekly User Registration Trends"  
      },
      data: [
      {        
        type: "line",
        showInLegend: true, 
        name: "series1",
        legendText: "Week-1",
        dataPoints: [
        { <?php day_line_data($week1) ?> },
        { <?php day_line_data($day1) ?>},
        {  <?php day_line_data($day2) ?> },
        {  <?php day_line_data($day3) ?> },
        {  <?php day_line_data($day4) ?> },
        {  <?php day_line_data($day5) ?> },
        {  <?php day_line_data($day6) ?> }
        
      
        ]
      },
        {        
        type: "line",
        showInLegend: true, 
        name: "series1",
        legendText: "Week-2",
        dataPoints: [
        { <?php day_line_data($day7) ?> },
        { <?php day_line_data($day8) ?>},
        {  <?php day_line_data($day9) ?> },
        {  <?php day_line_data($day10) ?> },
        {  <?php day_line_data($day11) ?> },
        {  <?php day_line_data($day12) ?> },
        {  <?php day_line_data($day13) ?> }
      
        ]
      },
        {        
        type: "line",
        showInLegend: true, 
        name: "series1",
        legendText: "Week-3",
        dataPoints: [
        { <?php day_line_data($day14) ?> },
        { <?php day_line_data($day15) ?>},
        {  <?php day_line_data($day16) ?> },
        {  <?php day_line_data($day17) ?> },
        {  <?php day_line_data($day18) ?> },
        {  <?php day_line_data($day19) ?> },
        {  <?php day_line_data($day20) ?> }
      
        ]
      },
        {        
        type: "line",
        showInLegend: true, 
        name: "series1",
        legendText: "Week-4",
        dataPoints: [
        { <?php day_line_data($day21) ?> },
        { <?php day_line_data($day22) ?>},
        {  <?php day_line_data($day23) ?> },
        {  <?php day_line_data($day24) ?> },
        {  <?php day_line_data($day25) ?> },
        {  <?php day_line_data($day26) ?> },
        {  <?php day_line_data($day27) ?> }
      
        ]
      }
      ]
    });

    chart.render();
  }
  </script>



  </head>
  <body>
    
    <div class="container">
    <div class="container">
    <img src="img/verizon-logo.png" width="100" height="" alt="Verizon">
    <?php require_once('logmenu.php'); ?>

    </div> <br> <br>
        <div class="container">

          <div>
            <ul class="nav nav-tabs">
              <li role="presentation" ><a href="index.php">Home</a></li>
              <li role="presentation"><a href="monthly_report.php">Monthly Requests</a></li>
              <li role="presentation"><a href="monthly_trend_report.php">Monthly Trend Report Requests</a></li>
              <li role="presentation" class="active"><a href="weekly_report.php">Weekly Request</a></li>
              <li role="presentation"><a href="index.php">Ad-Hoc Report</a></li>
              <?php 
            if (logged_in() && $_SESSION['user_type']=="b" || $_SESSION['user_type']=="c") {
              echo "<li role='presentation'><a href='user_management.php'>User Management</a></li>";
            }
            
            ?>
            </ul>
          </div>

          <div id="main_body">

         <div style="text-align:center; margin-bottom: 50px;"><h1>Verizon Global Wholesale</h1>
          </div>
          <div class="row">            

            <div class="col-sm-12">
            <div class="container">
                <form class="form-inline" role="form" action="" method="post">
                <div class="form-group">
                  <label >Week start</label>
                  <div class='input-group date'>
                    <input type="text" id="week_start" name="start_from" class="form-control">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
                </div>
               
                <input type="submit" class="btn btn-default" name="search" value="Search"/ >
              </form>
            </div>
            <br> <br>
              <div class="row">
                <div class="col-sm-3">
                <strong>Week-1(<?php echo date ("M d", strtotime($week1))." - ". date ("M d", strtotime($day6)); ?>)</strong>
                <table class="table table-striped table-bordered"><tr><th>Day</th><th>Sign Up</th></tr>
                  <?php 
                  // Data of first week
                    daily_report($week1);
                    daily_report($day1);
                    daily_report($day2);
                    daily_report($day3);
                    daily_report($day4);
                    daily_report($day5);
                    daily_report($day6);

                    weekly_total($week1,$day6);

                  ?>
                  </table>



                </div>
                <div class="col-sm-3">
                  <strong>Week-2(<?php echo date ("M d", strtotime($day7))." - ". date ("M d", strtotime($day13)); ?>)</strong>
                  <table class="table table-striped table-bordered"><tr><th>Day</th><th>Sign Up</th></tr>
                  <?php
                  // Data of 2nd week
                    daily_report($day7);
                    daily_report($day8);
                    daily_report($day9);
                    daily_report($day10);
                    daily_report($day11);
                    daily_report($day12);
                    daily_report($day13);

                    weekly_total($day7,$day13);

                  ?>
                  </table>
                </div>
                <div class="col-sm-3">
                <strong>Week-3(<?php echo date ("M d", strtotime($day14))." - ". date ("M d", strtotime($day20)); ?>)</strong>
                  <table class="table table-striped table-bordered"><tr><th>Day</th><th>Sign Up</th></tr>
                  <?php
                  // Data of 3rd Week
                    daily_report($day14);
                    daily_report($day15);
                    daily_report($day16);
                    daily_report($day17);
                    daily_report($day18);
                    daily_report($day19);
                    daily_report($day20);

                    weekly_total($day14,$day20);

                  ?>
                  </table>
                </div>
                <div class="col-sm-3">
                <strong>Week-4(<?php echo date ("M d", strtotime($day21))." - ". date ("M d", strtotime($day27)); ?>)</strong>
                  <table class="table table-striped table-bordered"><tr><th>Day</th><th>Sign Up</th></tr>
                  <?php
                  // Data of 4th Week
                    daily_report($day21);
                    daily_report($day22);
                    daily_report($day23);
                    daily_report($day24);
                    daily_report($day25);
                    daily_report($day26);
                    daily_report($day27);

                    weekly_total($day21, $day27);

                  ?>
                  </table>
                </div>
              </div>



             <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                           
              

            </div>
          </div>

          </div>


        </div>

        
      
    </div>








    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.js"></script>
    <script type="text/javascript">
      $(document).ready(function() {
    $('#example').dataTable();
    $('#hello').dataTable();
    

     } );
    </script>
    <script  src="js/dataTables.bootstrap.js"></script>
    <script  src="js/jquery.dataTables.js"></script>
    <script  src="js/dataTables.tableTools.js"></script>
    
    <script src="js/jquery-ui.js"></script>
    <script>
  $(function() {
    $( "#week_start" ).datepicker({
      defaultDate: "-4w",
      changeMonth: false,
      numberOfMonths: 2,
      showWeek: true,
      
    });
   
  });
  </script>

  </body>
</html>