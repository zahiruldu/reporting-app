<?php
session_start();
require_once('functions.php');
authenticate();

$db= dbconnect();


$email = $password = $emailError = $passwordError = $logError = "";

 if (isset($_POST['login'])) {

      $email = safe($_POST['email']);
      $password = $_POST['password'];


          if (empty($email)) {

          $emailError = "Email field can't be blank!";

          }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $emailError = "Error in your Email format!";

          } else {

            $email = $email;
          }


// password authentication
        if (empty($password)) {

          $passwordError = "Password can't be blank!";

        } elseif (strlen($password) > 10) {

          $passwordError = "We think your Password is not more than 10 characters!";

        }elseif(strlen($password) < 7){

          $passwordError = "We think your Password is not less than 7 characters!";

        }elseif (!preg_match("#[0-9]+#", $password)) {

          $passwordError = "We think your Password has at least one number!";

        } elseif (!preg_match("#[a-zA-Z]+#", $password)) {

          $passwordError = "We think your Password has at least one letter!";
        } else{
                         
                        $salting = md5($email);

                        $salt = sha1($salting.$password);

                        $pass = md5(sha1($salt));
                  }

                  if (empty($emailError) AND empty($passwordError)) {
                    
                    

                    $sql2 = "SELECT * FROM users WHERE email='$email' AND password= '$pass'";

                    $result2 = mysqli_query ($db, $sql2);
                  

                      if (mysqli_num_rows($result2) == "") {
                        
                        $logError = "<div class='error'>Your Email or Password is incorrect!</div>";

                      }elseif (mysqli_num_rows($result2) > 0) {
                        
                          while ($row = mysqli_fetch_assoc($result2)) {
                              
                              $user_id = $row["id"];
                              $last_name  = $row["last_name"];
                              $user_type   = $row["user_type"];
                              $activate   = $row["email_activated"];

                                if ($activate>1) {

                                  $logError = "<div class='warning'>Your account has been suspended! Contact support for any assistance.</div>";
                                }elseif ($activate<1) {

                                  $logError = "<div class='warning'>You have not activated your account yet! Please verify it.</div>";
                                } else {


                                  $logError = "<div class='success'>You are logging into a propitiatory system. This system is only for authorized users</div>";


                                  $_SESSION['username']   = $last_name;
                                  $_SESSION['user_type']   = $user_type;
                                  $_SESSION['user_id']     = $user_id;
                                  $_SESSION['user_ip']     = get_ip();
                                  $_SESSION['user_email']  = $email;                                                                  

                                  header('refresh: 2; url=index.php');

                                }
                          }
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
    <title>Login | Verizon</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    


    <link rel="stylesheet" type="text/css" href="media/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="css/dataTables.tableTools.css">
  
  
  
  

    


  </head>
  <body>

  <div class="container">
    
    
    <div class="container">
    <div class="container"><img src="img/verizon-logo.png" width="100" height="" alt="Verizon"></div> <br> <br>
        <div class="container">
            

          <div id="main_body">

          <div style="text-align:center; margin-bottom: 50px;">
          <h1>Verizon DreamFactory Admin Area</h1>
          
          <h3>User Login</h3></div>
          <?php echo $logError; ?>
          <div class="row"> 
              <div class="col-sm-8 col-md-offset-4">
                 <form class="form-horizontal" role="form" action="" method="post">
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="email">Email:</label>
                      <div class="col-sm-3">
                        <input type="email" class="form-control" id="email" placeholder="Enter email" name="email" value="<?php  echo $email;?>">
                        <span id="error"><?php  echo $emailError;?> </span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-sm-2" for="pwd">Password:</label>
                      <div class="col-sm-3">
                        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="password">
                        <span id="error"><?php  echo $passwordError;?> </span>
                         <label><a href="forgot_pass.php"> Forgot password?</a></label>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-offset-2 col-sm-3">
                        <input type="submit" class="btn btn" name="login" value="Login" style="background:#EE1A29; color:white;" />
                      </div>
                    </div>
                  </form>
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