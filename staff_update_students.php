<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin_update</title>
    <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap-icons.css">
    
</head>
<body class="">
<?php 
session_start();
include 'connection.php';
?>

<?php

if(isset($_POST['update'])) {

$id = stripslashes($_POST['id']);

$sql = "SELECT img.Image, re.* FROM `student` img, `report` re WHERE img.regNumber = re.regNumber AND re.id='$id'";
$result = mysqli_query($conn,$sql);
if($result) {
 while($row = mysqli_fetch_assoc($result)) {
     ?>

<!-- Form for updating students report  -->

<div class="container">
<div class="row">
<div class="col-sm-3"></div>
<div class="col-sm-6 shadow">
<p class="lead bg-dark text-warning p-3">
Update student report <a href="Staffs_Dashboard.php" class="btn btn-danger offset-5">Exit</a>

</p>

<form action="Admin_update.php" class="border-0 border-dark p-3 rounded-2" 

 style="border:3px solid " method="post">

 <?php echo "<img src='./uploads/".$row['Image']."' class='offset-5 p-0 mb-3 rounded-circle' style='width:70px; border-radius:3px;border:2px solid blue'/>"?>
<div class="form-group">
<input type="hidden" name="id" value="<?php echo $row['id'] ?>">

<input type="text" class="form-control" name="name" value="<?php echo $row['studentName']?>"

 placeholder="Name of student">
<br>
<input type="text" class="form-control" name="reg" value="<?php echo $row['regNumber'] ?>" 

placeholder="Registration Number">
<br>
<input type="text" class="form-control" name="department" value="<?php echo $row['department'] ?>"

 placeholder="Department">
<br>
<input type="text" name="level" class="form-control" value="<?php echo $row['level'] ?>"

 placeholder="Level">
<br>
<input type="number" name="number" class="form-control" value="<?php echo $row['mobile'] ?>"

 placeholder="Phone Number">
<br>
<input type="email" name="email" class="form-control" value="<?php echo $row['email'] ?>"

 placeholder="Email Address">
<br>
<label for="Misconduct Type" class="text-dark">Misconduct Case<b class="text-danger">*</b>
<br>
<input style="width:25vw" type="text" name="misType" value="<?php echo $row['misType'] ?>"

 class="form-control p-2" placeholder="Misconduct Type">
</label>
<br>
<br>
<label for="Description" class="text-dark">Description<b class="text-danger">*</b>
<br>
<input style="width:38vw" type="text" name="description" value=" <?php echo $row['description'] ?>"

 class="form-control p-5"

 placeholder="Describe report">


</label>
<br>
<br>
<label for="date" class="text-dark">date
<br>
<input type="date" class="form-control p-1" name="date" value="<?php echo $row['time'] ?>"

 placeholder="Date">

</label>
 &nbsp;&nbsp;&nbsp;<button type="submit" name="submit"  class="btn btn-success offset-4">Update</button>


</div>



</form>

</div>
<div class="col-sm-3"></div>
</div>
</div>

<?php
}
}else{

    echo "No record found";
}
}
?>
<br>




<?php

//  Getting data from form via the HTTP POST method.

    if(isset($_POST["submit"])) {

    $id = stripslashes($_POST['id']);    
    $studentName = stripcslashes($_POST['name']); 
    $regNumber = stripslashes($_POST['reg']); 
    $department = stripslashes($_POST['department']);
    $level = stripslashes($_POST['level']); 
    $mobile = stripslashes($_POST['number']);
    $email = stripslashes($_POST['email']);
    $misType = stripslashes($_POST['misType']); 
    $description = stripslashes($_POST['description']); 
    $date = stripslashes($_POST['date']);

    // Updating information in the database.

     $sql = "UPDATE `report` SET id='$id',studentName='$studentName',regNumber='$regNumber',
     department='$department',level='$level',mobile='$mobile',email='$email',misType='$misType',
     description='$description',time='$date' WHERE `report` . id='$id'";

     $result = mysqli_query($conn,$sql);
     if($result){

    // Redirecting to Admin dashboard.     
     header("Location: Admin_Dashboard.php?Report Updated successfully");

     }else{

         die(mysqli_error($conn));
     }
        
         }
    

    

    ?>
    
</body>
</html>