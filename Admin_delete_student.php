<?php
require_once 'connection.php';
session_start();
if(isset($_GET['deleteStudent'])){
    $id = $_GET['deleteStudent'];
 
    $query = "DELETE FROM `student` WHERE id=$id";
    $result = mysqli_query($conn, $query);
    if($result){
       
    // echo "<script type='text/javascript'> window.alert('Deleted successfully.')</script>";
  header("location: admin_view_students.php?Student deleted successfully");
    }else{
        die(mysqli_error($conn));
    }
}
