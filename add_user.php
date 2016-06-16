<?php
session_start();
require_once('functions.php');

authenticate();

login_check();


$message= $last_nameError= $emailError= $passwordError="";

if(isset($_POST['add'])){

  $last_name = safe($_POST['last_name']);
  $first_name = safe($_POST['first_name']);
  $email = safe($_POST['email']);
  $password = $_POST['password'];
  $user_type = $_POST['user_type'];

    


// Email authentication
    if (empty($email)) {
      $emailError = "Email field can't be blank!";
    }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailError = "Error in your Email format!";
    } else{

            $db= dbconnect();

                     $sql = "SELECT email FROM users WHERE email='$email'";

                     $result = mysqli_query($db, $sql);

                     if (mysqli_num_rows($result) != 0) {
                            
                            $emailError = "The Email address already exists!";
                     } else {

                            $email = $email;
                     }

                     
    }



// password authentication
    if (empty($password)) {

      $passwordError = "Password can't be blank!";

    } elseif (strlen($password) <7) {

      $passwordError = "Password can't be less than 7 characters!";

    }elseif(strlen($password) >10){
      $passwordError = "Password can't be more than 10 characters!";

    }elseif (!preg_match("#[0-9]+#", $password)) {

      $passwordError = "Password must include at least one number!";

    } elseif (!preg_match("#[a-zA-Z]+#", $password)) {

      $passwordError = "Password must include at least one letter!";
    } else{

      
          $salting = md5($email);

          $salt = sha1($salting.$password);

          $pass = md5(sha1($salt));
    }



//Last Name authentication
    if (empty($last_name)) {

      $last_nameError = "Please write your last name!";
    } else{

      $last_name = $last_name;
    }





// all error checking and inserting into database
      if (empty($emailError) && empty($last_nameError) && empty($passwordError)) {

        $sql2 = "INSERT INTO users (last_name,first_name, email, password, user_type, salt, created_at) 
                    VALUES('$last_name','$first_name', '$email', '$pass', '$user_type', '$salt',  NOW())";
          if(mysqli_query($db, $sql2)){

            $id = mysqli_insert_id($db);

            send_mail_confirm ($email, $last_name, $id, $salt);

            $message= "<div class='btn btn-success fade-in flash'>You have added $last_name $first_name successfully!</div>";
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
    <title>Home | Verizon</title>

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
          <h3>Add New User</h3>
              <?php echo $message; ?>
          </div>

          <div class="row">           

                        <form class="form-horizontal" role="form" action="" method="post">
                            <div class="form-group">
                              <label class="control-label col-sm-3" for="last_name">Last Name:</label>
                              <div class="col-sm-4">
                                <input type="text" class="form-control" id="last_name" placeholder="Last name" name="last_name" value="">
                                <span id="error"><?php  echo $last_nameError;?> </span>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-3" for="first_name">First Name:</label>
                              <div class="col-sm-4">
                                <input type="text" class="form-control" id="first_name" placeholder="First name" name="first_name" value="">
                                
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-3" for="email">Email:</label>
                              <div class="col-sm-4">
                                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?php  //echo $email;?>">
                                <span id="error"><?php  echo $emailError;?> </span>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-3" for="pwd">Password:</label>
                              <div class="col-sm-4">
                                <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
                                <span id="error"><?php  echo $passwordError;?> </span>
                                 
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="control-label col-sm-3" for="type">User Type:</label>
                              <div class="col-sm-4">
                               <select name="user_type" class="form-control">                                 
                                 <option value="a">Report User</option>
                                 <option value="b">Admin User</option>
                               </select>
                                
                                 
                              </div>
                            </div>
                            <div class="form-group">
                              <div class="col-sm-offset-3 col-sm-4">
                                <input type="submit" class="btn" name="add" value="Create" style="background:#EE1A29; color: white;" />
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