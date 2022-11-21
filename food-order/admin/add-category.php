<?php include ('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>
        
        <?php 
            if(isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
        ?>
        <?php 
            if(isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>
        <br><br>
        <!-- Add Category Form Starts -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Category title" minlength="5" required> <br>
                    </td>
                </tr>
                <tr>
                    <td>Select Image: </td>
                    <td><input type="file" name="image" required></td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                    <input type="radio" name="featured" value="Yes" checked> Yes
                    <input type="radio" name="featured" value="No"> No <br>
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes" checked> Yes
                        <input type="radio" name="active" value="No"> No <br>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Add Category Form Ends -->

        <?php 
            // Check whether the Submit is clicked or not
            if(isset($_POST['submit'])) {

                // Get the value from the From
                $title = $_POST['title'];
                
                //For radio input
                if(isset($_POST['featured'])) {
                    $featured = $_POST['featured'];
                }
                else {
                    // default value
                    $featured="Yes";
                }

                if(isset($_POST['active'])) {
                    $active = $_POST['active'];
                }
                else {
                    // default value
                    $active="Yes";
                }

                // check image is selected
                if(isset($_FILES['image']['name'])) {
                    //upload the image
                    $image_name= $_FILES['image']['name'];
                    
                    // Upload the Image only if image is selected
                    if($image_name !="") {

                    // AUTORENAME
                    $ext=end(explode('.', $image_name));

                    $image_name="Food_Category_".rand(000,999).'.'.$ext;

                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path="../images/category/".$image_name;

                    $upload= move_uploaded_file($source_path, $destination_path);

                    //verify image upload

                    if($upload==FALSE) {
                        $_SESSION['upload'] = "<div class='error'>Failed to Upload Image</div>";
                        header('location:'.SITEURL.'admin/add-category.php');
                        die();
                        }
                    } 
                } else {
                    //set image blank, if empty
                    $image_name="";
                }


                // Create SQL query to insert category
                $sql = "INSERT INTO tbl_category SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                    ";

                $res = mysqli_query($conn, $sql);

                //Check whether the query executed or not and data added or not
                if($res==TRUE) {
                    //Query executed and Category Added
                    
                    $_SESSION['add'] = "<div class='success'>'$title' Added Successfully!</div>";
                    //redirect
                    header('location:'.SITEURL.'admin/manage-category.php');
                } else {
                    // Failed to add Category
                    
                    $_SESSION['add'] ="<div class='error'> '$title' Failed to Add</div>";
                    //redirect
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
            }
        ?>
    </div>
</div>
<?php include('partials/footer.php'); ?>