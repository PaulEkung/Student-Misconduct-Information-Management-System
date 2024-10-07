<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Admin_feedback</title>
<link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap.css">
<link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap-icons.css">
</head>
<body>

<div class="container">
<div class="row">
<div class="container">
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6">
<div class="modal-dialog">
<div class="modal-content">
<div class="modal-header bg-dark">
<p class="lead text-warning">Send feedback to student</p>
<a href="Admin_dashboard.php" class=" btn btn-danger close text-light">Exit</a>
</div>
<div class="modal-body">

<?php 
session_start();
include 'connection.php';

if(isset($_POST['sendFeed'])){

 $reg = $_POST['regnumber'];  



 $sql = "SELECT * FROM `appeal` WHERE regnumber='$reg'";
 $result = mysqli_query($conn, $sql);
 if($result){
 
 $row = mysqli_fetch_array($result);

echo "

<form action=\"feedback.php\" method=\"post\">
<input type='text' name='reg' value=\" $reg\" class=\"form-control\">
<br>
<textarea class=\"form-control \" style=\"padding:5rem\" name=\"message\"></textarea>
<br>
<input type=\"submit\" class=\"btn btn-primary w-50 offset-3 fw-semibold\" name=\"submit\" value=\"Send\">

</form>
";


}else{

echo "no report found";

   }

  }

?>

 <?php 

if(isset($_POST['submit'])) {

// $reg = $_POST['regnumber'];   
$regNum = $_POST['reg'];   
$message = $_POST['message'];

$regNum = stripslashes($regNum);
$message = stripslashes($message);
$regNum = mysqli_real_escape_string($conn, $regNum);
$message = mysqli_real_escape_string($conn, $message);



$sql = "INSERT INTO  `feedback` (feedbackMsg,regNumber) VALUES ('$message','$regNum')";
$result = mysqli_query($conn, $sql);
if($result) {

$_SESSION['success'] = "<div class=\"alert alert-success p-2 text-center\">Feedback message successfully sent</div>";
echo $_SESSION['success'];

}else{

  echo  "<div class=\"alert alert-danger p-2\" id=\"successMessage\">Failed to send Feedback message</div>";  
}
}

?>

</div>
</div>
</div>
</div>
<div class="col-md-3"></div>
</div>
</div>
</div>
</div>
</div>

</body>
</html>



                