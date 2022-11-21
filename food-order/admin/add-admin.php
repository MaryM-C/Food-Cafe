<?php include('partials/menu.php'); ?>

       <!--Main Content Section Starts-->
       <div class="main-content">
        <div class="wrapper">
            <h1>Add Admin</h1>
            <br><br>
            <?php 
               if(isset($_SESSION['add'])) { // checking whether the session is set or not
                    echo $_SESSION['add']; // displaying session message
                    unset($_SESSION['add']); // removing session message
               }
               ?>

            <form action="" method="POST" class="">
                <table class="tbl-30">
                    <tr>
                        <td>Full Name:</td>
                        <td><input type="text" class="type" name="full_name" placeholder="Enter your name"></td>
                    </tr>
                    <tr>
                        <td>Username: </td>
                        <td>
                            <input type="text" name="username" placeholder="Username">
                        </td>
                    </tr>
                    <tr>
                        <td>Password:</td>
                        <td><input type="password" name="password" placeholder="Password"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
       </div>
       <!--Main Content Section Ends-->
<?php include('partials/footer.php'); ?>
<?php 
// process the value from Form and save it in database
//check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        //clicked
        //get data data from form
        $full_name=$_POST['full_name'];
        $username=$_POST['username'];
        $password=md5($_POST['password']); // Password hashing with md5

        // TO DO: SHA - Hashing
        


        // SQL query to save the data into database
        $sql = "INSERT INTO tbl_admin SET 
            full_name='$full_name',
            username= '$username',
            password='$password'
            ";
        
        // Execute query and save data in database
        $res = mysqli_query($conn, $sql) or die(mysqli_error());
        
        // check whether the  (query is executed) data is insert or not and display appropriate message
        if($res==TRUE) {
            // Data inserted
            // create a session variable to display message
            $_SESSION['add'] = "Admin Added Successfully!";
            // redirect page to manage admin
            header("location:".SITEURL.'admin/manage-admin.php');
        }
        else {
            echo"Data not inserted";
            $_SESSION['add'] = "Admin Not Added!";

        }
        // redirect page to manage admin
        header("location:".SITEURL.'admin/manage-admin.php');

    } 
    
?>