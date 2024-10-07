<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Send_mail</title>
    <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-icons/bootstrap-icons.css">
    </head>
    <body>

    <br>
    <br>
    <br>
    <?php 
    session_start();
    require 'connection.php';
    if(isset($_POST["submit"])) {

    $regNumber = stripslashes($_POST["reg"]);
    $sql = "SELECT * FROM `report` WHERE regNumber = '$regNumber'";
    $result = mysqli_query($conn, $sql);
    if($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $name = $row['studentName'];
    $email = $row['email'];

    $selector = bin2hex(random_bytes(4));
    $token = bin2hex(random_bytes(16));
    $url = "Dear $name, a misconduct report has been posted to your profile. Click the link below to see report.\r\n";
    $url .= "https://www.polyunwana.edu/Intro.php?selector="
    . $selector."&validator=" . $token;
    ?>

    
    <div class="container">
    <div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
    <div class="panel-header bg-dark p-3 text-warning">Send mail to&nbsp;
    <span class="fw-semibold"><?php echo $name ?> </span>
     <a href="Admin_dashboard.php" class="btn btn-danger btn-sm offset-3">Exit
     </a> </div>
    <br>
    <form action='Mail.php' method='post' class="p-4 shadow">
    <div class="form-group">
    <input type="text" name='email' class="form-control" value="<?php echo $email ?>">
    <br>
    <input type="text" name='subject' class="form-control" placeholder="Subject">
    <br>
    <textarea type="text" name='message' cols="20" rows="20" class="form-control textarea p-3"
     style="height:20vh"><?php echo $url ?></textarea>
    <br>
    <br>
    &nbsp;&nbsp;&nbsp;
    <input type="submit" name='send' class="btn btn-dark offset-4 w-25" value="Send">
    </div>
   
    </form>
    </div>
    <div class="col-sm-3"></div>
    </div>
    </div>
    
    <?php
        
    }
        
    }
    ?>
     <?php

    if(isset($_POST["send"])) {

    $message_send = false; 
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    $to ="$email";
    $headers = "From: pauldrums32@gmail.com \r\n";
    $message_2 ="You recieved a mail from " . $headers . ". \n\n" . $message;

      if(mail($to, $subject, $message_2, $headers)){

        echo "<div class=\"alert alert-success p-4 text-center\">Mail successfully sent to $email</div>";
        echo "<br>";
        echo "<br>";
        echo " &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='Admin_Dashboard.php' class=\"center offset-4\">" . "<button class=\"btn btn-primary w-25\">OK</button>" . "</a>";

      }else{

        echo "<div class=\"alert alert-danger p-2 text-center\"><span class='bi bi-envelope-fill text-light'></span>
          Failed to send mail! Something went wrong.</div>";
        echo "<br>";
        echo "<br>";
        echo "<div class=\"text-center fs-4\">". "Error: <b class='fs-2'>404</b>" ."</div>";
        echo "<br>";

        echo "<div class=\"text-center\">". "Kindly check your network connection and retry." ."</div>";
        echo "<br>";
        echo "<br>";
        echo "<br>";
        // echo "<center>";
        echo "<span class=\"center offset-5\">" . "<button class=\"btn btn-primary\" onclick=\"refresh()\">Retry</button>" . "</span>";
        echo "<a href='Admin_Dashboard.php' class=\"center offset-1\">" . "<button class=\"btn btn-danger\">Exit</button>" . "</a>";

        // echo "</center>";
    }

    }

    $message_send = true;
    ?>

  

   <script type="text/javascript">
    function refresh() {
     window.location.reload();
  }
 
 </script>
 
  </body>
  </html>