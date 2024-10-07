<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin_updateStaffs</title>
    <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap.css">
    <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap-icons.css">
    
</head>
<body class="bg-light">
<?php 
session_start();
include 'connection.php';
?>
<br>
<br>
<?php

if(isset($_POST['submit'])) {

$id = stripslashes($_POST['id']);
   
$sql = "SELECT * FROM `staffs` WHERE id='$id'";
$result = mysqli_query($conn,$sql);
if($result) {
 while($row = mysqli_fetch_assoc($result)) {

     $image = $row['Image'];
     
     ?>

<!-- Form for updating students report  -->

<div class="container">
<div class="row">
<div class="col-sm-3"></div>
<div class="col-sm-6">
<p class="lead bg-dark text-warning p-3">
Update staffs information <a href="view_staffs.php" class="btn btn-danger offset-6">Exit</a>

</p>

<form action="Admin_updateStaffs.php" class="border-2 border-dark p-3 rounded-2" 

style="border:3px solid " method="post" enctype="multipart/form-data">


<div class="form-group">
<input type="hidden" name="id" value="<?php echo $row['id'] ?>">
<span><?php echo "<img src='./uploads/$image' class='offset-4 p-0 rounded-circle' style='width:70px; border-radius:3px'/>" ?> </span>
<br>
<br>
<input type="text" class="form-control bg-transparent" name="name" value="<?php echo $row['name']?>">
<br>
<input type="text" class="form-control bg-transparent" name="department" value="<?php echo $row['department'] ?>" >
<br>
<input type="text" class="form-control bg-transparent" name="password" value="<?php echo $row['password'] ?>">
<br>
<input type="file" class="form-control" name="image" value="<?php echo $row['Image']?> ">
<br>
 &nbsp;&nbsp;&nbsp;<button type="submit" name="update"  class="btn btn-success offset-4">Update</button>

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

if(isset($_POST["update"]) && isset($_FILES['image']['name'])) {

    $id = stripslashes($_POST['id']);    
    $staffName = stripcslashes($_POST['name']); 
    $staffdept = stripslashes($_POST['department']); 
    $password = stripslashes($_POST['password']);
    $img_name = $_FILES['image']['name'];     
    $tmp_name = $_FILES['image']['tmp_name'];   
    $img_error = $_FILES['image']['error']; 
    if($img_error === 0){
    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_ex_to_lc = strtolower($img_ex);
    $allowed_exs = array('jpg','png','jpeg');
    if(in_array($img_ex_to_lc, $allowed_exs)){
    $new_img_name = uniqid("$name", true).'.'.$img_ex_to_lc;
    $img_upload_path = './uploads/'.$new_img_name;
    move_uploaded_file($tmp_name, $img_upload_path); 

    }else{

    echo "<script type='text/javascript'>
    window.alert('You cant upload images of this type.');
    </script>"; 
   }
   }else{

    echo "<script type='text/javascript'>
    window.alert('An unknown image error occured!');
    </script>";
 }


    if(!empty($staffName) && !empty($staffdept) && !empty($password) && !empty($img_name)){

 // Updating information in the database.

     $sql = "UPDATE `staffs` SET id='$id',name='$staffName',department='$staffdept',
     password='$password', Image='$new_img_name' WHERE `staffs`. id='$id'";

     $result = mysqli_query($conn,$sql);
     if($result){

    // Redirecting to Admin dashboard.     
     header("Location: view_staffs.php?Staff information updated successfully=$id");
     }else{

         die(mysqli_error($conn));
     }
        
         }
    
        }
    ?>
    
</body>
</html>