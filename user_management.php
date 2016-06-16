<?php
session_start();
require_once('functions.php');

authenticate();

login_check();

$user_type= $_SESSION['user_type'];

$message="";
 
 $db=dbconnect();


// deleting the user
 if (isset($_GET['did'])) {

  $user_id= $_GET['did'];

  if ($user_type=="b" || $user_type=="c") {
    $db= dbconnect();

      $sql= "DELETE FROM users WHERE id='$user_id'";
      $result= mysqli_query($db, $sql);

      if ($result) {
         $message="<div class='success fade-in flash'>You have successfully deleted the user!</div>";
      }else{
         $message="<div class='error fade-in flash'>Sorry, Could not delete the user!</div>";
      }
  }
  

}




?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>User Management | Verizon</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    


    <link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="css/dataTables.tableTools.css">
  
  
  
  

    


  </head>
  <body>

  <div class="container">
    
    
    <div class="container">
    <div class="container">
    <img src="img/verizon-logo.png" width="100" height="" alt="Verizon">
    <?php require_once('logmenu.php'); ?>

    </div> <br> <br>
        <div class="container">
            <div>
            <ul class="nav nav-tabs">            
              <li role="presentation"><a href="index.php">Home</a></li>
              <li role="presentation"><a href="monthly_report.php">Monthly Requests</a></li>
              <li role="presentation"><a href="monthly_trend_report.php">Monthly Trend Report Requests</a></li>
              <li role="presentation"><a href="weekly_report.php">Weekly Request</a></li>
              <li role="presentation"><a href="index.php">Ad-Hoc Report</a></li>
              <?php 
            if (logged_in() && $_SESSION['user_type']=="b" || $_SESSION['user_type']=="c") {
              echo "<li role='presentation' class='active'><a href='user_management.php'>User Management</a></li>";
            }

            ?>
              
            </ul>
          </div>

          <div id="main_body">

          <div style="text-align:center; margin-bottom: 50px;"><h1>Verizon Global Wholesale</h1>
          <h3>User Management</h3></div>
          <div class="row">           

            <div class="col-sm-12">
             
              

            

          <?php 
              
              echo $message;
                  

                  $sql= "SELECT * FROM users";
                  $result= mysqli_query($db, $sql);
                  if (mysqli_num_rows($result)>0) {

                      echo "<table id='myTable' class='table table-striped table-bordered tablesorter' cellspacing='0' width='100%'>";
                      echo "<thead id='heading_style'><tr><th>Last Name</th><th>First Name</th><th>Email</th><th>Last Login Date</th><th>Last Login Time</th><th>User Type</th><th>Action</th></tr></thead>";
                      echo "<tbody>";
                      while($row=mysqli_fetch_array($result)){
                        $id=$row["id"];
                        $last_name=$row["last_name"];  
                        $first_name=$row["first_name"];                      
                        $email=$row["email"];
                        $log_ip=$row["log_ip"];
                        $last_login=$row["last_login"];
                        $user_type= $row["user_type"];

                        //user edit option for supper admin
                        if ($_SESSION['user_type']=="c") {
                           $edit_user="<a href='edit_user.php?uid=$id'  class='btn btn-default btn-sm' style='background:#DDDDDD !important;'>Edit</a>";
                           $action_show="<a href='user_management.php?did=$id' onclick=\"return confirm('Are you sure you want to remove this user?');\" class='btn btn-default btn-sm' style='background:#DDDDDD !important;'>Remove</a>";
                        }elseif($_SESSION['user_type']=="b" && $user_type =="b"){
                           $edit_user="<a href='edit_user.php?uid=$id'  class='btn btn-default btn-sm' style='background:#DDDDDD !important;'>Edit</a>";
                           $action_show="<a href='user_management.php?did=$id' onclick=\"return confirm('Are you sure you want to remove this user?');\" class='btn btn-default btn-sm' style='background:#DDDDDD !important;'>Remove</a>";
                        }elseif($_SESSION['user_type']=="b" && $user_type =="c"){
                          $edit_user="";
                          $action_show="<div class='btn btn-default btn-sm' style='background:#DDDDDD !important;'>Disabled</div>";

                        }//Ends user edit option for supper admin

                          if ($user_type=="a") {
                            $user_show= "Report User";
                            
                          }elseif ($user_type=="b") {
                            $user_show="Admin";
                            
                          }elseif ($user_type=="c") {
                            $user_show="Super Admin";
                           // $action_show="<a href='#'  class='btn btn-default btn-sm' style='background:#DDDDDD !important;'>Disabled</a>";
                          }

                          //Login time calculation
                          if ($last_login=="") {
                              $last_login_date="Not yet";
                              $last_login_time="Not yet";
                          }else{
                              $last_login_date= date('M d,Y', strtotime($last_login));
                              $last_login_time=date('h:i A', strtotime($last_login));
                          }
                        

                        echo "<tr>";                        
                        echo "<td>$last_name</td>";
                        echo "<td>$first_name</td>";
                        echo "<td>$email</td>";                        
                      
                        echo "<td>$last_login_date</td>";
                        echo "<td>$last_login_time</td>";
                        echo "<td>$user_show</td>";
                        echo "<td>$action_show $edit_user</td>";
                        echo "</tr>";
                      }

                      echo "</tbody></table>";
                      echo "<a href='add_user.php' class='btn btn-sm' style='background:#EE1A29 !important; color:white;'>Add user</a> <br> <br>";

                  }

      



          ?>
              </div>
          </div>

        </div>
        </div>

        
      
    </div>








    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/dataTables.bootstrap.js"></script>   
   

    
    <script type="text/javascript" src="js/jquery.tablesorter.js"></script>

    <script type="text/javascript">
    $(document).ready(function()
  {
    $("#myTable").tablesorter();
  }
);

</script>

<script type="text/javascript" language="javascript" src="media/js/jquery.js"></script>
  <script type="text/javascript" language="javascript" src="media/js/jquery.dataTables.js"></script>
  <script type="text/javascript" language="javascript" src="js/dataTables.tableTools.js"></script>
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

    <!-- fade out any alert box after 5 seconds automatically. Use in class name "fade-in flash" -->
<script type="text/javascript">
    window.setTimeout(function() {
  $(".flash").fadeTo(500, 0).slideUp(500, function(){
      $(this).remove();
      });
    }, 5000);

</script>

  </body>
</html>