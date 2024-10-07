<?php
require_once 'connection.php';
session_start();
if(isset($_GET['deleteStudent'])){
    $id = $_GET['deleteStudent'];
    $query = "DELETE FROM `student` WHERE id=$id";
    $result = mysqli_query($conn, $query);
    if($result){
        // echo "<script type='text/javascript'> window.alert('Deleted successfully.')</script>";
        header("location: Staff_View_Students.php?Student deleted successfully");
    }else{
        die(mysqli_error($conn));
    }
}


