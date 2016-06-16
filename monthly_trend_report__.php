<?php
session_start();
require_once('functions.php');

authenticate();

login_check();

$db=dbconnect();

             

              $sql="SELECT MONTH(get_date), YEAR(get_date), DAY(get_date), COUNT(id) 
                  FROM customer 
                  GROUP BY YEAR(get_date), MONTH(get_date)";

                    $result= mysqli_query($db, $sql);
                    if (mysqli_num_rows($result)>0) { ?>

                     <script type="text/javascript">
                      window.onload = function () {
                        var chart = new CanvasJS.Chart("chartContainer",
                        {

                          title:{
                          text: "Monthly Trend Report Request"
                          },
                           data: [
                          {
                            type: "line",

                            dataPoints: [

                            <?php
                       
                        while($row=mysqli_fetch_array($result)){
                          $total_customer=$row["COUNT(id)"];
                          $month=$row["MONTH(get_date)"];
                          $year=$row["YEAR(get_date)"];
                          $day=$row["DAY(get_date)"]; ?>

                          { x: new Date(<?php echo $year; ?>, <?php echo $month; ?>, <?php echo $day; ?>), y: <?php echo $total_customer; ?> },
                         
                          

                          

                      <?php  } ?>

                                      ]
                        }
                        ]
                      });

                      chart.render();
                    }
              </script>
           <?php

                    }





?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Monthly Report | Verizone</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui.theme.css">
      <script type="text/javascript">
    /*    window.onload = function () {
          var chart = new CanvasJS.Chart("chartContainer",
          {

            title:{
            text: "Monthly Trend Report Request"
            },
             data: [
            {
              type: "line",

              dataPoints: [
              { x: new Date(2012, 00, 1), y: 450 },
              { x: new Date(2012, 01, 1), y: 414 },
              { x: new Date(2012, 02, 1), y: 520 },
              { x: new Date(2012, 03, 1), y: 460 },
              { x: new Date(2012, 04, 1), y: 450 },
              { x: new Date(2012, 05, 1), y: 500 },
              { x: new Date(2012, 06, 1), y: 480 },
              { x: new Date(2012, 07, 1), y: 480 },
              { x: new Date(2012, 08, 1), y: 410 },
              { x: new Date(2012, 09, 1), y: 500 },
              { x: new Date(2012, 10, 1), y: 480 },
              { x: new Date(2012, 11, 1), y: 710 }
              ]
            }
            ]
          });

          chart.render();
        } */
  </script>
 <script type="text/javascript" src="js/canvasjs.js"></script>



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
              <li role="presentation" ><a href="monthly_report.php">Monthly Requests</a></li>
              <li role="presentation" class="active"><a href="monthly_trend_report.php">Monthly Trend Report Requests</a></li>
              <li role="presentation"><a href="weekly_report.php">Weekly Request</a></li>
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
            

            <div class="col-sm-9">
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
    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script>
  $(function() {
    $( "#from" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 2,
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#to" ).datepicker({
      defaultDate: "+1w",
      changeMonth: true,
      numberOfMonths: 2,
      onClose: function( selectedDate ) {
        $( "#from" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });
  </script>

  </body>
</html>