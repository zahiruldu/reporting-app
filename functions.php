<?php

require_once('db.php');

// checking against sql injection and tags
function safe($value){
    $check =  strip_tags($value);

      return $check;
    }


// getting user ip address
 function get_ip (){

  $ip = $_SERVER['REMOTE_ADDR'];

  return $ip;
 }

 
//Getting user agent / Browser information
 function get_agent(){

  $agent = $_SERVER['HTTP_USER_AGENT'];

  return $agent;
 }


// logged in check
 function logged_in (){

    if (isset($_SESSION['user_id']) AND !empty($_SESSION['user_id'])) {

        return true;

    } else {

      return false;
    } 

 }


 function logout(){

  $out = session_destroy();

  if ($out) {

      return true;
  } else {

    return false;
  }

 }


// user authentication

 function authenticate(){

  $user_id = $name =$user_agent = $user_ip = "";

    if (isset($_SESSION['user_id'])) {

      

        if ($_SESSION['user_ip'] !== get_ip()) {
          
          session_destroy();


        } else{
          return true;
        }
    }
 }



// logged in  check and  redirect to login page
 function login_check(){

  if (!logged_in()) {

    $redirect = header("location:login.php");

    return $redirect;
  }
 }


// weekly report display

function weekly_report($start_week, $end_week){

	$week1= $start_week;
	$week2= $end_week;

	$db=dbconnect();

	$sql="SELECT get_date, COUNT(id) 
                  FROM customer  WHERE get_date>='$week1' AND get_date<='$week2'
                  GROUP BY YEAR(get_date), MONTH(get_date), DAY(get_date)";
              

              $result=mysqli_query($db, $sql);
              if (mysqli_num_rows($result)>0) {
                  
                  echo "<table cellpadding='5' cellspacing='2' bgcolor='#DDD'><tr><th>Day</th><th>Sign Up</th></tr>";
                  while($row=mysqli_fetch_array($result)){
                    $total_reg= $row["COUNT(id)"];
                    $reg_day= $row["get_date"];
                    $wow_day= date('l', strtotime($reg_day));

                    echo "<tr><td>$wow_day</td><td>$total_reg</td></tr>";                    

                  }

                  echo "</table>";
              }


}


function daily_report($day1){

			$day1= $day1;
			$db=dbconnect();

	          $sql="SELECT get_date, COUNT(id) 
                  FROM customer  WHERE get_date='$day1'
                  GROUP BY YEAR(get_date), MONTH(get_date), DAY(get_date)";
                $result= mysqli_query($db,$sql);
                if (mysqli_num_rows($result)>0) {
                    while($row=mysqli_fetch_array($result)){
                      $total_reg= $row["COUNT(id)"];
                      $reg_day= $row["get_date"];
                      $wow_day= date('l', strtotime($reg_day));

                      echo "<tr><td>$wow_day</td><td><a href='customer.php?rd=$day1'>$total_reg</a></td></tr>";

                    }
                  } else{
                    echo "<tr><td>".date('l', strtotime($day1))."</td><td>0</td></tr>";
                  }


}


function weekly_total($day1,$day2){

			$start_day= $day1;
			$end_day= $day2;

			$db=dbconnect();

	         $sql="SELECT get_date, COUNT(id) 
                  FROM customer  WHERE get_date>='$start_day' AND get_date<='$end_day'";
                  $result= mysqli_query($db, $sql);
                  if (mysqli_num_rows($result)>0) {
                    while($row=mysqli_fetch_array($result)){

                      $total= $row["COUNT(id)"];
                     echo "<tr><td>Total</td><td>$total</td></tr>";
                    }
                    
                  }else{
                  	 echo "<tr><td>Total</td><td>0</td></tr>";
                  }


}


function day_line_data($day_name){
	       $day_name= $day_name;
			

			$db=dbconnect();

	         $sql="SELECT get_date, COUNT(id) 
                  FROM customer  WHERE get_date='$day_name'";
                  $result= mysqli_query($db, $sql);
                  if (mysqli_num_rows($result)>0) {
                    while($row=mysqli_fetch_array($result)){

                      $total= $row["COUNT(id)"];
                      $wow_day= date ("D", strtotime($day_name));
                     echo "label: '$wow_day', y: $total ";
                    }
                    
                  }else{
                  	 echo "label: '$wow_day', y: 0 ";
                  }

}

function monthly_line_data($month_name, $year_name){
         $month_name= $month_name;
         $year_name= $year_name;
                        if ($month_name=="Jan") {
                            $name="1";
                        }elseif ($month_name=="Feb") {
                            $name="2";
                        }elseif ($month_name=="Mar") {
                            $name="3";
                        }elseif ($month_name=="Apr") {
                            $name="4";
                        }elseif ($month_name=="May") {
                            $name="5";
                        }elseif ($month_name=="Jun") {
                            $name="6";
                        }elseif ($month_name=="Jul") {
                            $name="7";
                        }elseif ($month_name=="Aug") {
                            $name="8";
                        }elseif ($month_name=="Sep") {
                            $name="9";
                        }elseif ($month_name=="Oct") {
                            $name="10";
                        }elseif ($month_name=="Nov") {
                            $name="11";
                        }elseif ($month_name=="Dec") {
                            $name="12";
                        }

      

      $db=dbconnect();

           $sql="SELECT get_date, COUNT(id) 
                  FROM customer  WHERE MONTH(get_date)='$name' AND YEAR(get_date)='$year_name'";
                  $result= mysqli_query($db, $sql);
                  if (mysqli_num_rows($result)>0) {
                    while($row=mysqli_fetch_array($result)){

                      $total= $row["COUNT(id)"];
                      //$day_name= $row["get_date"];
                      //$wow_month= date ("M", strtotime($day_name));
                     echo "label: '$month_name', y: $total ";
                    }
                    
                  }else{

                        
                    //$monthly= "$year_name-$month_name-15";
                    //$name= date('M', strtotime($monthly));
                     echo "label: '$month_name', y: 0 ";
                  }

}


function update_login($user_id){

       $ip= get_ip();

       $id= $user_id;

       $db=dbconnect();
                                 
       $sql3="UPDATE users SET log_ip= '$ip', last_login= NOW() WHERE id='$id'";
       $hello= mysqli_query($db, $sql3);

       return $hello;

        
}


// get loggedin user id
 function get_logged_id(){

  if (logged_in()) {

    $user_id = $_SESSION['user_id'];

    return $user_id;
  }


 }






 // get loggedin user Email
 function get_logged_email($user_id){

  

    $id= $user_id;
    $db = dbconnect();
    $sql = "SELECT email FROM users WHERE id='$id'";

    $result = mysqli_query($db, $sql);
      while ($row = mysqli_fetch_assoc($result)) {
        
        $email = $row["email"];

        return $email;
      }     
  }



// Sending registration confirmation function
  function send_mail_confirm ($email, $name, $id, $salt){

    $message = "
<html lang='en-US'>
<body style='background:#F4F4F4;'>
      <center><img style='width:150px; padding-top:5px;' src='".get_logo()."' alt='' /></center>
    <div style='margin:0px auto; width:640px; height:380px; background:#fff; border:1px solid #e7e7e7; border-radius:15px; text-align:center;'>
      <h2 style='color: #16488a;font-family: Arial,Helvetica,sans-serif;font-size: 22px;font-weight: bold;line-height: 1.4;'>Verify your email address.</h2>
      <h3 style='color: #777777;font-family: Arial,Helvetica,sans-serif;font-size: 17px;line-height: 1.4;font-weight:normal;'>Dear ".$name.",</h3>
      <p style='color: #777777;font-family: Arial,Helvetica,sans-serif;font-size: 17px;line-height: 1.4;padding: 10px 30px;'>Welcome to Verizon Cloud!You are invited to use verizon cloud reports! Confirm your email address for use</p>
      <div style='font-family:arial;font-size:8px;background:#F0F0F0;border-radius:5px;display:inline-block;color:#777777;'><h1 style='padding:0px 15px;'>Account Name: <span style='color:#256BCF;text-decoration:underline;'>".$email."</span></h1></div><br />
      <div style='font-family:arial;font-size:8px;background:#F8B028;border-radius:5px;display:inline-block;margin-top:30px;'><h1 style='padding:0px 15px;color:#256BCF;text-decoration:underline;'><a href='".get_domain()."/activate.php?i=$id&s=$salt'>Verify this email</a>.</h1></div>
    </div>
    <div style='width: 100%; height:80px; background: none;'></div>
</body>
</html>";
        
  require ('vendor/phpmailer/phpmailer/PHPMailerAutoload.php');

      $mail = new PHPMailer;

      //$mail->SMTPDebug = 3;                               // Enable verbose debug output

      $mail->isSMTP();                                      // Set mailer to use SMTP
      $mail->Host = get_smtp_host();  // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = get_smtp_user();                 // SMTP username
      $mail->Password = get_smtp_pass();                           // SMTP password
      $mail->SMTPSecure = get_smtp_secure();                            // Enable TLS encryption, `ssl` also accepted
      $mail->Port = get_smtp_port();                                    // TCP port to connect to

      $mail->From = 'do-not-reply@Verizon.com';
      $mail->FromName = 'Verizon Cloud';
      $mail->addAddress($email, $name);     // Add a recipient
      //$mail->addAddress('emammahadi@gmail.com');               // Name is optional
      //$mail->addReplyTo('zahirul.arb@gmail.com', 'Test message');
      //$mail->addCC('zahir.arb@gmail.com');
      //$mail->addBCC('info@rainbowbrush.com');

      //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
      //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
      $mail->isHTML(true);                                  // Set email format to HTML

      $mail->Subject = 'Verify your Email';
      $mail->Body    = $message;
      $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

      $sendmail = $mail->send();

      return $sendmail;

      
 } //Sending registration confirmation function  ends


// Sending Email re-confirmation function
  function send_mail_reconfirm ($email, $name, $id, $salt){

    $message = "
<html lang='en-US'>
<body style='background:#F4F4F4;'>
      <center><img style='width:150px; padding-top:5px;' src='".get_logo()."' alt='' /></center>
    <div style='margin:0px auto; width:640px; height:380px; background:#fff; border:1px solid #e7e7e7; border-radius:15px; text-align:center;'>
      <h2 style='color: #16488a;font-family: Arial,Helvetica,sans-serif;font-size: 22px;font-weight: bold;line-height: 1.4;'>Verify your email address.</h2>
      <h3 style='color: #777777;font-family: Arial,Helvetica,sans-serif;font-size: 17px;line-height: 1.4;font-weight:normal;'>Dear ".$name.",</h3>
      <p style='color: #777777;font-family: Arial,Helvetica,sans-serif;font-size: 17px;line-height: 1.4;padding: 10px 30px;'>Welcome to Verizon Cloud! You are requested  to verify Email! Confirm your email address for use</p>
      <div style='font-family:arial;font-size:8px;background:#F0F0F0;border-radius:5px;display:inline-block;color:#777777;'><h1 style='padding:0px 15px;'>Account Name: <span style='color:#256BCF;text-decoration:underline;'>".$email."</span></h1></div><br />
      <div style='font-family:arial;font-size:8px;background:#F8B028;border-radius:5px;display:inline-block;margin-top:30px;'><h1 style='padding:0px 15px;color:#256BCF;text-decoration:underline;'><a href='".get_domain()."/activate.php?i=$id&s=$salt'>Verify this email</a>.</h1></div>
    </div>
    <div style='width: 100%; height:80px; background: none;'></div>
</body>
</html>";
        
  require ('vendor/phpmailer/phpmailer/PHPMailerAutoload.php');

      $mail = new PHPMailer;

      //$mail->SMTPDebug = 3;                               // Enable verbose debug output

      $mail->isSMTP();                                      // Set mailer to use SMTP
      $mail->Host = get_smtp_host();  // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = get_smtp_user();                 // SMTP username
      $mail->Password = get_smtp_pass();                           // SMTP password
      $mail->SMTPSecure = get_smtp_secure();                            // Enable TLS encryption, `ssl` also accepted
      $mail->Port = get_smtp_port();                                    // TCP port to connect to

      $mail->From = 'do-not-reply@Verizon.com';
      $mail->FromName = 'Verizon Cloud';
      $mail->addAddress($email, $name);     // Add a recipient
      //$mail->addAddress('emammahadi@gmail.com');               // Name is optional
      //$mail->addReplyTo('zahirul.arb@gmail.com', 'Test message');
      //$mail->addCC('zahir.arb@gmail.com');
      //$mail->addBCC('info@rainbowbrush.com');

      //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
      //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
      $mail->isHTML(true);                                  // Set email format to HTML

      $mail->Subject = 'Verify your Email';
      $mail->Body    = $message;
      $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

      $sendmail = $mail->send();

      return $sendmail;

      
 } //Sending  re-confirmation function  ends





  // Sending registration confirmation function
  function resetpass($email, $name, $id, $salt, $request_ip){

    $message = "
<html lang='en-US'>
<body style='background:#F4F4F4;'>
      <center><img style='width:150px; padding-top:5px;' src='".get_logo()."' alt='' /></center>
    <div style='margin:0px auto; width:640px; height:380px; background:#fff; border:1px solid #e7e7e7; border-radius:15px; text-align:center;'>
      <h2 style='color: #16488a;font-family: Arial,Helvetica,sans-serif;font-size: 22px;font-weight: bold;line-height: 1.4;'>Reset Password.</h2>
      <h3 style='color: #777777;font-family: Arial,Helvetica,sans-serif;font-size: 17px;line-height: 1.4;font-weight:normal;'>Dear ".$name.",</h3>
      <p style='color: #777777;font-family: Arial,Helvetica,sans-serif;font-size: 17px;line-height: 1.4;padding: 10px 30px;'>Thank you for requesting to reset your password! Please click on the reset link bellow to setup a new password.</p>
      <div style='font-family:arial;font-size:8px;background:#F0F0F0;border-radius:5px;display:inline-block;color:#777777;'><h1 style='padding:0px 15px;'>Account Name: <span style='color:#256BCF;text-decoration:underline;'>".$email."</span></h1></div><br />
      <div style='font-family:arial;font-size:8px;background:#F8B028;border-radius:5px;display:inline-block;margin-top:30px;'><h1 style='padding:0px 15px;color:#256BCF;text-decoration:underline;'><a href='".get_domain()."/reset.php?i=$id&p=$request_ip&s=$salt'>Reset Password</a>.</h1></div>
    </div>
    <div style='width: 100%; height:80px; background: none;'></div>
</body>
</html>";
        
  require ('vendor/phpmailer/phpmailer/PHPMailerAutoload.php');

      $mail = new PHPMailer;

      //$mail->SMTPDebug = 3;                               // Enable verbose debug output

      $mail->isSMTP();                                      // Set mailer to use SMTP
      $mail->Host = get_smtp_host();  // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = get_smtp_user();                 // SMTP username
      $mail->Password = get_smtp_pass();                           // SMTP password
      $mail->SMTPSecure = get_smtp_secure();                            // Enable TLS encryption, `ssl` also accepted
      $mail->Port = get_smtp_port();                                    // TCP port to connect to

      $mail->From = 'do-not-reply@Verizon.com';
      $mail->FromName = 'Verizon Cloud Report';
      $mail->addAddress($email, $name);     // Add a recipient
      //$mail->addAddress('emammahadi@gmail.com');               // Name is optional
      //$mail->addReplyTo('zahirul.arb@gmail.com', 'Test message');
      //$mail->addCC('zahir.arb@gmail.com');
      //$mail->addBCC('info@rainbowbrush.com');

      //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
      //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
      $mail->isHTML(true);                                  // Set email format to HTML

      $mail->Subject = 'Reset Password';
      $mail->Body    = $message;
      $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

      $sendmail = $mail->send();

      return $sendmail;

      
 } //Sending password reset function  ends



  // send message on password change
  function send_sms_change_pass($email, $name, $request_ip){

    $message = "
<html lang='en-US'>
<body style='background:#F4F4F4;'>
      <center><img style='width:150px; padding-top:5px;' src='".get_logo()."' alt='' /></center>
    <div style='margin:0px auto; width:640px; height:380px; background:#fff; border:1px solid #e7e7e7; border-radius:15px; text-align:center;'>
      <h2 style='color: #16488a;font-family: Arial,Helvetica,sans-serif;font-size: 22px;font-weight: bold;line-height: 1.4;'> Confirmation of Password Change.</h2>
      <h3 style='color: #777777;font-family: Arial,Helvetica,sans-serif;font-size: 17px;line-height: 1.4;font-weight:normal;'>Dear ".$name.",</h3>
      <p style='color: #777777;font-family: Arial,Helvetica,sans-serif;font-size: 17px;line-height: 1.4;padding: 10px 30px;'>You have successfully changed your password!</p>
      <div style='font-family:arial;font-size:8px;background:#F0F0F0;border-radius:5px;display:inline-block;color:#777777;'><h1 style='padding:0px 15px;'> For Account: <span style='color:#256BCF;text-decoration:underline;'>".$email."</span></h1></div><br /><br>
      <div style='font-family:arial;font-size:8px;background:#F0F0F0;border-radius:5px;display:inline-block;color:#777777;'><h1 style='padding:0px 15px;'> From IP Address: <span style='color:#256BCF;text-decoration:none;'>".$request_ip."</span></h1></div>
    </div>
    <div style='width: 100%; height:80px; background: none;'></div>
</body>
</html>";
        
  require ('vendor/phpmailer/phpmailer/PHPMailerAutoload.php');

      $mail = new PHPMailer;

      //$mail->SMTPDebug = 3;                               // Enable verbose debug output

      $mail->isSMTP();                                      // Set mailer to use SMTP
      $mail->Host = get_smtp_host();  // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = get_smtp_user();                 // SMTP username
      $mail->Password = get_smtp_pass();                           // SMTP password
      $mail->SMTPSecure = get_smtp_secure();                            // Enable TLS encryption, `ssl` also accepted
      $mail->Port = get_smtp_port();                                    // TCP port to connect to

      $mail->From = 'do-not-reply@Verizon.com';
      $mail->FromName = 'Verizon Cloud Report';
      $mail->addAddress($email, $name);     // Add a recipient
      //$mail->addAddress('emammahadi@gmail.com');               // Name is optional
      //$mail->addReplyTo('zahirul.arb@gmail.com', 'Test message');
      //$mail->addCC('zahir.arb@gmail.com');
      //$mail->addBCC('info@rainbowbrush.com');

      //$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
      //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
      $mail->isHTML(true);                                  // Set email format to HTML

      $mail->Subject = 'Password Confirmation';
      $mail->Body    = $message;
      $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

      $sendmail = $mail->send();

      return $sendmail;

      
 } //Sending password reset function  ends

