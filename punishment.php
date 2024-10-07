<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Post_Punishment</title>
<link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap.css">
<link rel="stylesheet" href="bootstrap-5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
<br>
<div class="container">
<div class="row">
<div class="container">
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6">
<div class="modal-header bg-dark">
<p class="lead text-warning">Add punishment to student's report</p>
</div>
<div class="modal-dialog shadow">
<div class="modal-content">
<div class="modal-body">
<a href="Admin_dashboard.php" class="close offset-10 mb-3  text-light btn btn-dark">Exit</a>

<?php 
session_start();
include 'connection.php';

if (isset($_POST['submit'])) {

    $id = $_POST['id'];



    $sql = "SELECT * FROM `report` WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {

        while ($row = mysqli_fetch_array($result)) {

            ?>

<form action="punishment.php" method="post">
<input type='hidden' name='id' value="<?php echo $row['id'] ?>">
<label for="date" class="text-danger"> Date of effection</label>
<input type='date' name='date' class="form-control shadow">

<br>
<textarea class="form-control p-5 shadow" name="punishment" value="<?php echo $row['punishment'] ?>"></textarea>
<br>
<input type="submit" class="btn btn-danger w-25 offset-4 shadow" name="Insert" value="Post">

</form>

<?php

}

} else {

    echo "no report found";
}

}

?>

<?php 

if (isset($_POST['Insert'])) {

    $id = stripslashes($_POST['id']);
    $punishment = stripslashes($_POST['punishment']);
    $punishmentDate = stripslashes($_POST['date']);
    $punishment = mysqli_real_escape_string($conn, $punishment);
    $punishmentDate = mysqli_real_escape_string($conn, $punishmentDate);

    $sql = "UPDATE `report` SET id ='$id', punishment ='$punishment', punishmentDate='$punishmentDate' 
    WHERE `report`.`id` ='$id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {

        header("Location: Admin_Dashboard.php?Posted successfully");

    } else {

        die(mysqli_error($conn));
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