<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>
        <br><br>

        <?php 
            if (isset($_GET['id'])) {
                $id=$_GET['id'];
            }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Old Password:</td>
                    <td><input type="password" name="current_password" placeholder="Current Password"></td>
                </tr>
                <tr>
                    <td>New Password:</td>
                    <td><input type="password" name="new_password" placeholder="New Password"></td>
                </tr>

                <tr>
                    <td>Confirm Password:</td>
                    <td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Change Password" class="btn-secondary"> </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php 
    //Check whether the Submit button is clicked or not
    if(isset($_POST['submit'])) {
        //get the data from Form
        $id=$_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);
        //check whether the user with current id and current password exists or not
        $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'"; // id = int, password is string

        // execute query 
        $res = mysqli_query($conn, $sql);

        if($res==TRUE) {
            // check the whether the data is available or not
            $count = mysqli_num_rows($res);
            
            if($count==1) {
                // user exists and password can be changed
                // check whether new password and confirm password matched
                if($new_password==$confirm_password) {
                    $sql2 = "UPDATE tbl_admin SET 
                    password='$new_password'
                    WHERE id=$id;
                    ";

                    //Execute the query
                    $res2=mysqli_query($conn, $sql2);

                    //Check whether the query executed
                    if($res2==TRUE) {
                        //display success message
                        $_SESSION['change_password']="<div class='success'>Password has been changed.</div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    } else {
                        //Display error messge
                        $_SESSION['change_password']="<div class='error'>Failed to change password.</div>";
                        header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                } else {
                    $_SESSION['unmatched_password'] = "<div class='error'>Passwords do not match.</div>";
                // redirect user
                header('location:'.SITEURL.'admin/manage-admin.php');
                }

            } else {
                // user does not exist

                $_SESSION['user-not-found'] = "<div class='error'>User Not Found</div>";
                // redirect user
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
        //check whether the new password and confirm password match or not
        //change password if all above is true
    }
?>
<?php include('partials/footer.php'); ?>
