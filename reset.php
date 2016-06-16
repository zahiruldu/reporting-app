<?php
session_start();

require_once('functions.php');

authenticate();

$message = $form = "";

 $db= dbconnect();

if (isset($_GET['i']) && isset($_GET['s'])  && isset($_GET['p']) && !empty($_GET['i']) && !empty($_GET['s']) && !empty($_GET['p'])) {
    
    $id     = $_GET['i'];
    $salt     = $_GET['s'];
    $request_ip = $_GET['p'];

        if ($request_ip != get_ip()) {

          $message = "<div class='warning'>Your reset request was from diffrent device. Please do it from same device.</div>";

        }else {
         

          $sql = "SELECT * FROM users WHERE id = '$id' AND salt = '$salt'";

          $result = mysqli_query($db, $sql);

            if (mysqli_num_rows($result) == "") {

              $message = "<div class='error'>There has some problem in your verification link!</div>";

            } else{

              $form = "<form class='form-horizontal' role='form' action='' method='POST'>
                          <div class='form-group'>
                            <label class='control-label col-sm-2' for='password'>Password:</label>
                            <div class='col-sm-10'>
                              <input type='password' class='form-control' id='newpass' name='newpass' placeholder='New password'>
                            </div>
                          </div>
                          <div class='form-group'>
                            <label class='control-label col-sm-2' for='confirm'>Confirm:</label>
                            <div class='col-sm-10'>          
                              <input type='password' class='form-control' id='confirm' name='newpass2' placeholder='Confirm password'>
                            </div>
                          </div>              
                          <div class='form-group'>        
                            <div class='col-sm-offset-2 col-sm-10'>
                              <input type='submit'  name='reset' value='Submit' class='btn' style='background:#EE1A29; color:white;' />
                            </div>
                          </div>
                        </form>";

                      while ($row = mysqli_fetch_assoc($result)) {

                        $user_email = $row["email"];
                        $last_name = $row["last_name"];
                      }

            }


        }

  } else{

    $message = "<div class='info'>Check your email and click on the Reset link we sent you!</div>";

  }// getting the reset information and executing Ends here


// Processing the password reset form data
  if (isset($_POST['reset'])) {


     $email = $user_email;

     $pass1 = $_POST['newpass'];

     $pass2 = $_POST['newpass2'];

      if (empty($pass1) || empty($pass2)) {
        
        $message = "<div class='warning'>You can't keep blank any field!</div>";

      } elseif (strlen($pass1) <7) {

        $message = "<div class='warning fade-in flash'>Password can't be less than 7 characters!</div>";

      }elseif(strlen($pass1) >10){
        $message = "<div class='warning fade-in flash'>Password can't be more than 10 characters!</div>";

      } elseif (!preg_match("#[0-9]+#", $pass1)) {

        $message = "<div class='warning fade-in flash'>Password must include at least one number!</div>";

      } elseif (!preg_match("#[a-zA-Z]+#", $pass1)) {

        $message ="<div class='warning fade-in flash'>Password must include at least one letter!</div>";

      } elseif ($pass2 !== $pass1) {

        $message = "<div class='warning fade-in flash'>Confirmation password must be same !</div>";

      } elseif ($pass2 == $pass1) {

           $salting = md5($email);

           $salt2 = sha1($salting.$pass1);

           $pass = md5(sha1($salt2));

            if (empty($message)) {
              
              $sql = "UPDATE users SET password='$pass', salt='$salt2', updated_at= NOW() WHERE email='$email'";

                     $result = mysqli_query($db, $sql);

                      if (!$result) {

                        $message = "<div class='info fade-in flash'>There is some problem to create your new password! Contact admin.</div>";

                      } else {

                        send_sms_change_pass($email, $last_name, $request_ip);

                        $message = "<div class='success fade-in flash'>Thanks! Your new password has been successfully created.</div>";

                        header('refresh: 2; url=login.php');
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
    <title>Changing password | Verizon</title>

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
          
          <h3>Reset Password</h3></div>
          
          <div class="row"> 

            <div class="activate-page">
              <?php echo $message; ?>
            </div>
          
            <div class="col-sm-6">
              <?php echo $form; ?>
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