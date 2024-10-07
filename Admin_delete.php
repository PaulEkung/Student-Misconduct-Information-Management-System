<?php 
session_start();
include 'connection.php';

    if(isset($_GET['deleteId'])){
    $id = $_GET['deleteId'];
    $sql = "DELETE FROM `report` WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    if($result){
        // echo "<script type='text/javascript'> window.alert('Deleted successfully.')</script>";
        header("location: Admin_dashboard.php?report deleted successfully");
    }else{
        die(mysqli_error($conn));
    }
}




   


