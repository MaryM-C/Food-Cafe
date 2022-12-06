<?php
    session_start();
    include "db_connect.php";
    $sql = "SELECT * FROM tbl_users WHERE id = ?";
    $user= $conn->prepare($sql);
    $id=$_SESSION['id'];
    $user->execute([$id]);

    if(isset($_POST['updateData']) ){
        
        $fname=$_POST['fullname'];
        $uname=$_POST['username'];
        $email=$_POST['emails'];

        $sql = "UPDATE tbl_users SET fname = '$fname' WHERE id='$id'";
        $result=$conn->query($sql);

        if(result){
            header("Location: ../index.php"); 
        }
        else{
            header("Location: ../cart.php"); 
        }

    }


?>
