<?php
session_start();
require_once('functions.php');

authenticate();

login_check();

$db=dbconnect();


// Day calculation

  $db=dbconnect();

      if (isset($_POST['search']) && !empty($_POST['start_from'])) {
            $year_name= $_POST['start_from']; 
            $month1="Jan"; 
            $month2="Feb"; 
            $month3="Mar"; 
            $month4="Apr";
            $month5="May"; 
            $month6="Jun"; 
            $month7="Jul"; 
            $month8="Aug"; 
            $month9="Sep"; 
            $month10="Oct"; 
            $month11="Nov"; 
            $month12="Dec";


             
           } else{
             $year_name= date('Y');
            $month1="Jan"; 
            $month2="Feb"; 
            $month3="Mar"; 
            $month4="Apr";
            $month5="May"; 
            $month6="Jun"; 
            $month7="Jul"; 
            $month8="Aug"; 
            $month9="Sep"; 
            $month10="Oct"; 
            $month11="Nov"; 
            $month12="Dec"; 
             
           }

        



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Monthly Trend Report | Verizon</title>

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
      text: "Monthly User Registration Trends"  
      },
      data: [
      {        
        type: "line",
        showInLegend: true, 
        name: "series1",
        legendText: "Monthy Report of <?=$year_name; ?>",
        dataPoints: [
        { <?php monthly_line_data($month1,$year_name); ?>},
        { <?php monthly_line_data($month2,$year_name); ?>},
        { <?php monthly_line_data($month3,$year_name); ?>},
        { <?php monthly_line_data($month4,$year_name); ?> },
        { <?php monthly_line_data($month5,$year_name); ?> },
        { <?php monthly_line_data($month6,$year_name); ?> },
        { <?php monthly_line_data($month7,$year_name); ?> },
        { <?php monthly_line_data($month8,$year_name); ?> },
        { <?php monthly_line_data($month9,$year_name); ?> },
        { <?php monthly_line_data($month10,$year_name); ?> },
        { <?php monthly_line_data($month11,$year_name); ?> },
        { <?php monthly_line_data($month12,$year_name); ?>}
        
      
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

            <div class="col-sm-12">
            <div class="container">
                <form class="form-inline" role="form" action="" method="post">
                <div class="form-group">
                  <label >Year start</label>
                  <div class='input-group date'>
                    
                    <select name="start_from" class="form-control">
                    <option>2010</option>
                    <option>2011</option>
                    <option>2012</option>
                    <option>2013</option>
                    <option>2014</option>
                    <option>2015</option>
                    <option>2016</option>
                    <option>2017</option>
                    <option>2018</option>
                    <option>2019</option>
                    <option>2020</option>
                    <option>2021</option>
                    <option>2022</option>
                    <option>2023</option>
                    <option>2024</option>
                    <option>2025</option>
                    <option>2026</option>
                    <option>2027</option>
                    <option>2028</option>
                    <option>2029</option>
                    <option>2030</option>
                      
                    </select>
                    
                </div>
                </div>
               
                <input type="submit" class="btn btn-default" name="search" value="Search"/ >
              </form>
            </div>
            <br> <br>
              <div class="row">

              
                
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
      format: " yyyy", // Notice the Extra space at the beginning
    viewMode: "years", 
    
      
    });


   
  });
  </script>

  </body>
</html>