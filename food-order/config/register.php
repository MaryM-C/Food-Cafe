<?php

if(isset($_POST['fname']) && isset($_POST['uname']) && isset($_POST['email']) && isset($_POST['pass'])){
    include "db_connect.php";

    $fname=$_POST['fname'];
    $uname=$_POST['uname'];
    $pass=$_POST['pass'];
    $email=$_POST['email'];

    $data="fname=".$fname."&uname=".$uname."&email=".$email;


    if (empty($fname)){
        $em="Full name is required!";
        header("Location:../SignUp.php?error=$em&$data");
        exit;
    }
    else if(empty($uname)){
        $em="User name is required!";
        header("Location:../SignUp.php?error=$em&$data");
        exit;
    }
    else if(empty($email)){
        $em="Email is required!";
        header("Location:../SignUp.php?error=$em&$data");
        exit;
    }
    else if(empty($pass)){
        $em="Password is required!";
        header("Location:../SignUp.php?error=$em&$data");
        exit;
    }
   
    else{

        if(strlen($pass)<8){
            $em="Password must be eight (8) characters!";
            header("Location:../SignUp.php?error=$em&$data");
            exit;
           
        }
        else{
            $sql = "SELECT * FROM users WHERE unames = ?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$uname]);
    
            if($stmt->rowCount() == 1){
                $em="Username is already used!";
                header("Location:../SignUp.php?error=$em&$data");
                exit;
            }
            else{
                // hashing the password
                $pass = password_hash($pass, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users(fname,unames,email,passw) VALUES(?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$fname, $uname, $email, $pass]);
                header("Location: ../SignUp.php?success=Your account has been created successfully");
            }
        }
        
  
    }

}
else{
    header("Location:../SignUp.php?error=error");
    exit;
}