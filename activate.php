<?php
session_start();

require_once('functions.php');

authenticate();

$message = "";

if (isset($_GET['i']) && isset($_GET['s'])  && !empty($_GET['i']) && !empty($_GET['s'])) {

  $id = $_GET['i'];
  $salt = $_GET['s'];
  
      $db = dbconnect();

      $sql = "SELECT * FROM users WHERE id = '$id' AND salt = '$salt'";

      $result = mysqli_query($db, $sql);
        if (mysqli_num_rows($result) == "") {
          
          $message = " <div class='error'>There has some problem in your Verification link or you are not registerd with us!</div>";

        }elseif (mysqli_num_rows($result) > 0) {

          while($row = mysqli_fetch_assoc($result)) {

            $user_id = $row["id"];
            $last_name  = $row ["last_name"];
            $user_type  = $row["user_type"];
            $email    = $row["email"];
            $activate   = $row["email_activated"];

                    if ($activate > 0) {
                        
                        $message = "<div class='warning'>You are already activated ! </div><p class='activate-login'><a href='login.php'>Login</a></p>";

                      }  else {
                        // activating  user account
                          $sql2 = "UPDATE users SET email_activated='1', updated_at= NOW() WHERE id='$id' AND salt='$salt'";

                          $result2 = mysqli_query($db, $sql2);

                            if ($result2) {

                              $message = "<div class='success'>Congratulations ".$last_name."! Your email address has now been verified </div> <p ><a href='login.php' class='btn' style='background:#EE1A29; color:white;'>Login</a></p>";
                            }
                      }
                }
        }

} else{

   $message = "<div class='info'>Check your email and click on the activation link we sent you!</div>";

   //mysql_close($db);

}



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Activating email | Verizon</title>

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
          
          <h3>Email Verification</h3></div>
          
          <div class="row">

          <?php echo $message; ?> 

                         

                       
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