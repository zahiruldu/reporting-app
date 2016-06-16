<?php
session_start();
require_once('functions.php');

authenticate();

login_check();


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

    <link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="css/dataTables.tableTools.css">



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
              <li role="presentation" class="active"><a href="monthly_report.php">Monthly Requests</a></li>
              <li role="presentation"><a href="monthly_trend_report.php">Monthly Trend Report Requests</a></li>
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
          <h3>Monthly Public laaS Requests</h3></div>
          
          <div class="row">
            

            <div class="col-sm-12">
              <form class="form-inline" role="form" action="" method="post">
                <div class="form-group">
                  <label >Start</label>
                  <div class='input-group date'>
                    <input type="text" id="from" name="from" class="form-control">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
                </div>
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                <div class="form-group">
                <label>End</label>
                <div class='input-group date'>
                    <input type="text" id="to" name="to" class="form-control">
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
                  
                </div>
                
                <input type="submit" class="btn btn-default" name="search_range" value="Search"/ >
              </form>             
              

            </div>
          </div>  <br> <br>

          <?php 
          $db=dbconnect();
          if (isset($_POST['search_range']) && !empty($_POST['from']) && !empty($_POST['to'])) {
              $start=$_POST['from'];
              $end= $_POST['to'];
              $starting = date("Y-m-d", strtotime($start));
              $ending = date("Y-m-d", strtotime($end));
              

                  $sql= "SELECT * FROM customer WHERE get_date>='$starting' AND get_date<='$ending'";
                  $result= mysqli_query($db, $sql);
                  if (mysqli_num_rows($result)>0) {

                      echo "<table id='myTable' class='table table-striped table-bordered tablesorter' cellspacing='0' width='100%'>";
                      echo "<thead id='heading_style'><tr><th>Last Name</th><th>First Name</th><th>Company</th><th>Phone</th><th>Email</th><th>Date</th><th>Time</th> </tr></thead>";
                      echo "<tbody>";
                      while($row=mysqli_fetch_array($result)){
                        $id=$row["id"];
                        $customer_id=$row["customer_id"];
                        $last_name=$row["last_name"];
                        $first_name=$row["first_name"];
                        $company=$row["company_name"];
                        $phone=$row["phone_number"];
                        $email=$row["email"];
                        $date=$row["get_date"];
                        $time=$row["get_time"];

                        echo "<tr>";
                        echo "<td>$last_name</td>";
                        echo "<td>$first_name</td>";
                        echo "<td>$company</td>";
                        echo "<td>$phone</td>";
                        echo "<td>$email</td>";
                        echo "<td>".date('M d Y', strtotime($date))."</td>";
                        echo "<td>".date('h:i A', strtotime($time))."</td>";
                        echo "</tr>";
                      }

                      echo "</tbody></table>";

                  }

          }else{

                    $sql= "SELECT * FROM customer";
                    $result= mysqli_query($db, $sql);
                    if (mysqli_num_rows($result)>0) {

                        echo "<table id='myTable' class='table table-striped table-bordered tablesorter' cellspacing='0' width='100%'>";
                        echo "<thead id='heading_style'><tr><th>Last Name</th><th>First Name</th><th>Company</th><th>Phone</th><th>Email</th><th>Date</th><th>Time</th> </tr></thead>";
                        echo "<tbody>";
                        while($row=mysqli_fetch_array($result)){
                          $id=$row["id"];
                          $customer_id=$row["customer_id"];
                          $last_name=$row["last_name"];
                          $first_name=$row["first_name"];
                          $company=$row["company_name"];
                          $phone=$row["phone_number"];
                          $email=$row["email"];
                          $date=$row["get_date"];
                          $time=$row["get_time"];

                          echo "<tr>";
                          echo "<td>$last_name</td>";
                          echo "<td>$first_name</td>";
                          echo "<td>$company</td>";
                          echo "<td>$phone</td>";
                          echo "<td>$email</td>";
                          echo "<td>".date('M d Y', strtotime($date))."</td>";
                          echo "<td>".date('h:i A', strtotime($time))."</td>";
                          echo "</tr>";
                        }

                        echo "</tbody></table>";

                    }

        }



          ?>

          </div>

        </div>

        
      
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script  src="js/dataTables.bootstrap.js"></script>
    <script  src="js/jquery.dataTables.js"></script>
  
    
    <script src="js/jquery-ui.js"></script>

<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
  <script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>
  <script type="text/javascript" language="javascript" src="js/dataTables.tableTools.js"></script>
  
    
   
    
    
    <script src="js/jquery-ui.js"></script>
    <script>
  $(function() {
    $( "#from" ).datepicker({
      defaultDate: "-4w",
      changeMonth: true,
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( "#to" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#to" ).datepicker({
      defaultDate: "+0w",
      changeMonth: true,
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( "#from" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });
  </script>

  
    <script type="text/javascript" src="js/jquery.tablesorter.js"></script>

    <script type="text/javascript">
    $(document).ready(function()
  {
    $("#myTable").tablesorter();
  }
);

</script>

  <script type="text/javascript" language="javascript" class="init">

$.fn.dataTable.TableTools.defaults.aButtons = ["csv", "xls","pdf","print" ];

$(document).ready(function() {
  $('#myTable').DataTable( {
    dom: 'T<"clear">lfrtip',
    tableTools: {
            "sSwfPath": "swf/copy_csv_xls_pdf.swf"
        },
  } );
} );


  </script>

  

  </body>
</html>