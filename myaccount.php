<?php
session_start();
require_once('functions.php');
authenticate();

$db = dbconnect();


login_check();

$password = $password2 = $passwordError = $password2Error = $message = "";

      if (isset($_POST['update'])) {

        $id = $_SESSION['user_id'];
        $email = $_SESSION['user_email'];
        $last_name = safe($_POST['last_name']);
        $first_name = safe($_POST['first_name']);
        $password = safe($_POST['password']);
        $password2 = safe($_POST['password2']);

        // Name authentication
        if (empty($last_name)) {
            $last_nameError="Please write your last name!";
        }else{
          $last_name=$last_name;
        }

      // password authentication
          if (empty($password)) {

            $passwordError = "Password can't be blank!";

          } elseif (strlen($password) < 7) {

            $passwordError = "Password can't be less than 7 characters!";

          }elseif(strlen($password) > 10){

            $passwordError = "Password can't be more than 10 characters!";

          }elseif (!preg_match("#[0-9]+#", $password)) {

            $passwordError = "Password must include at least one number!";

          } elseif (!preg_match("#[a-zA-Z]+#", $password)) {

            $passwordError = "Password must include at least one letter!";
          } else{

            $password = $password;
          }


      //Confirmation password authentication
          if (empty($password2)) {

            $password2Error = "Please enter confirmation password same!";

          } elseif ($password2 !== $password) {

            $password2Error = "Confirmation password must be same !";

          } elseif ($password2 == $password) {

                 $salting = md5($email);

                 $salt = sha1($salting.$password);

                 $pass = md5(sha1($salt));

                      if (empty($passwordError) AND empty($password2Error)) {
                        

                         $sql = "UPDATE users SET last_name='$last_name', first_name='$first_name', password='$pass', salt='$salt', updated_at= NOW() WHERE id='$id' AND email='$email'";

                          if (mysqli_query($db, $sql)) {

                              $message = "<div class='success'>You have successfully updated your profile!</div>";

                              header('refresh: 1; url=index.php');
                            } else{
                              $message = "There is a problem to update your profile! Contact to our support.";
                            }
                      }
                      mysqli_close($db);
          }

      }else{

        $id= get_logged_id();
        $sql2= "SELECT * FROM users WHERE id='$id'";
        $result2 = mysqli_query($db, $sql2);
        while($row=mysqli_fetch_array($result2)){
          $last_name= $row["last_name"];
          $first_name= $row["first_name"];
          $email= $row["email"];
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
    <title>Profile | Verizon</title>

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
                <li role="presentation" ><a href="index.php">Home</a></li>
                <li role="presentation"><a href="monthly_report.php">Monthly Requests</a></li>
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

          <div style="text-align:center; margin-bottom: 50px;">
          <h1>Verizon DreamFactory Admin Area</h1>
          
          <h3>Your Profile</h3></div>
          
          <div class="row">
          <div><?php  echo $message; ?></div>

           <form class="form-horizontal" role="form" action=""  method="post">
               <div class="form-group">
                <label class="control-label col-sm-2">Last Name:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control"  placeholder="Last Name"  name="last_name" value="<?php echo $last_name;?>">
                  <span id="error"><?php  echo $last_nameError;?> </span>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2">First Name:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control"  placeholder="First Name"  name="first_name" value="<?php echo $first_name;?>">
                  <span id="error"><?php  //echo $last_nameError;?> </span>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-sm-2">New Password:</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control"  placeholder="Enter New Password"  name="password" value="<?php echo $password;?>">
                  <span id="error"><?php  echo $passwordError;?> </span>
                </div>
              </div>
              
              <div class="form-group">
                <label class="control-label col-sm-2">Confirm Password:</label>
                <div class="col-sm-10">
                  <input type="password" class="form-control" placeholder="Confirm Password"  name="password2"  value="">
                  <span id="error"><?php  echo $password2Error;?> </span>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-default" name="update">Submit</button>
                </div>
              </div>

          </form> 
              


            
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