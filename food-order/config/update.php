<?php

if(isset($_POST['fullname']) && isset($_POST['username']) && isset($_POST['emails'])){
    include('db_connect.php');

    $fname=$_POST['fullname'];
    $uname=$_POST['username'];
    $email=$_POST['emails'];

    


    if (empty($fname)){
        
    }
    else{
        
    }
    if(empty($uname)){
        
    }
    if(empty($email)){
        $em="Email is required!";
        header("Location:../SignUp.php?error=$em&$data");
        exit;
    }
    
    

    if(strlen($pass)<8){
        $sql = "SELECT * FROM tbl_user WHERE unames = ?";
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
                $sql = "INSERT INTO tbl_user(fname,unames,email,passw) VALUES(?,?,?,?)";
                $stmt = $conn->prepare($sql);
                $stmt->execute([$fname, $uname, $email, $pass]);
                header("Location: ../SignUp.php?success=Your account has been created successfully");
            }
           
    }
    

}
else{
    header("Location:../SignUp.php?error=error");
    exit;
}