<?php 
session_start();
include 'connection.php';

if(isset($_GET['deleteAppealMsg'])){
    $appeal_id = $_GET['deleteAppealMsg'];
    $sql = "DELETE FROM `appeal` WHERE  id=$appeal_id";
    $result = mysqli_query($conn, $sql);
    if($result){
        header("location: Admin_dashboard.php");
        echo "<script type='text/javascript'> window.alert('Deleted successfully.')</script>";
    }else{
        die(mysqli_error($conn));
    }
}