<?php include('../config/constants.php');?>
<html>
    <head>
        <title>PNC Cafe | Admin Login</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class="login">
            <h1 class="text-center">Login</h1>
            <br><br>

            <?php
                if(isset($_SESSION['login'])) {
                    echo $_SESSION['login'];
                    unset ($_SESSION['login']);
                }
                if(isset($_SESSION['no-login-message'])) {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
            <br><br>
            <!--Login Form Starts Here-->
            <form action="" method="POST" class="text-left-align">
                Username <br>
                <input type="text" name="username" placeholder="Enter Username"><br><br>
                Password <br>
                <input type="password" name="password" placeholder="Enter Password"><br><br>
                
                <input type="submit" name="submit" value="Login" class="btn-primary-30">
            </form>
            <!--Login Form Ends Here-->
        </div>
    </body>
</html>

<?php 
    //check whether the submit button is clicked
    if(isset($_POST['submit'])) {
        // process for login
        // get the data from From
        $username=$_POST['username'];
        $password=md5($_POST['password']);

        //sql to check whether the credentials match
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //execute the query
        $res = mysqli_query($conn, $sql);

        $count=mysqli_num_rows($res);

        if($count==1) {
            $_SESSION['login'] = "<div class='success'> Login Successful. </div>";
            $_SESSION['user'] = $username;
            //redirect to home
            header('location:'.SITEURL.'admin/');
        } else {
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
            // redirect to home
            header('location:'.SITEURL.'admin/login.php');
        }
        
    }
?>