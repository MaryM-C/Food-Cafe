<?php 
 include('db_connect.php');
    $order_id = $_GET['order_id'];
    $sql="DELETE FROM tbl_order WHERE order_id= $order_id";
    $result=$conn->query($sql); 
    header("Location: ../cart.php");
    exit;
?>