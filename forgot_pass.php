<?php
session_start();
require_once('functions.php');

authenticate();

  $message = "";


    if (isset($_POST['reset'])) {

        $email = safe($_POST["email"]);

          if (empty($email)) {

            $message = "<div class='warning'>Please enter Email and request for reset!</div>";

          }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

            $message = "<div class='error'>Error in your Email format!</div>";

          }else{

                    

                     $db= dbconnect();

                     $sql = "SELECT * FROM users WHERE email='$email'";

                     $result = mysqli_query($db, $sql);

                     if (mysqli_num_rows($result) != 1) {
                            
                            $message = "<div class='info'>We haven't find your Email in our record!</div>";

                     } elseif (mysqli_num_rows($result) !=0) {

                        while ($row = mysqli_fetch_assoc($result)) {

                          $id  = $row["id"];
                          $last_name = $row["last_name"];
                          $email = $row["email"];
                          $salt = $row["salt"];
                          $activate = $row["email_activated"];
                          $request_ip = get_ip();

                          $try = resetpass($email, $last_name, $id, $salt, $request_ip);

                            if ($try) {

                              $message = "<div class='success'>We have sent a link to reset your password! Please check your email.</div>";

                            } else{

                                $message = "<div class='warning'>There has some problem to send you a email. Please contact to our support. </div>";

                            }


                          
                        }

                      
                     }

                     mysqli_close($db);
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
    <title>Reset Password | Verizon</title>

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
          <div><?php echo $message; ?></div>

          <div class="row"> 
          <form class="form-inline" role="form" action="" method="POST" style="text-align:center;" >
            <div class="form-group">
              <label for="email">Email:</label>
              <input type="email" class="form-control" id="email" name="email" placeholder="Email address used in register">
            </div>
                       
            <input type="submit" value="Reset" name="reset" class="btn" style="background:#EE1A29; color:white;" />
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