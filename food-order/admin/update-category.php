<?php include('partials/menu.php'); ?>
<!--MAIN CONTENT STARTS HERE-->
    <div class="main-content"> 
        <div class="wrapper"></div>
        <h1>Update Category</h1>
        <br><br>
        <?php 
            // Check whether the id is set or not
            if(isset($_GET['id'])) {
                // Get the ID and all other details
                $id = $_GET['id'];

                // Create SQL Query to get all other details
                $sql = "SELECT * FROM tbl_category WHERE id=$id";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                if($count==1) {
                    $row = mysqli_fetch_assoc($res);
                    $title = $row['title'];

                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
                } else {
                    $_SESSION['no-category-found'] = "<div class='error'>Category Not Found</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }

            } else {
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
        <table class="tbl-30">
            <tr>
                <td>Title:</td>
                <td>
                    <input type="text" name="title" value="<?php echo $title; ?>" required>
                </td>
            </tr>
            <tr>
                <td>Current Image:</td> 
                <td>
                  <?php  
                    if ($current_image != "") {
                        // display image
                        ?> <br>
                        <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image; ?>" width="70%" >
                        <?php
                    } else {
                        echo "<div class='error'>Image not Added.</div>";
                    }
                  ?>
                </td>
            </tr>
            <tr>
                <td>New Image:</td>
                <td><input type="file" name="image"></td>
            </tr>
            <tr>
                <td>Featured:</td>
                <td>
                    <input <?php if($featured=="Yes") {echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes
                    <input <?php if($featured=="No") {echo "checked";} ?> type="radio" name="featured" value="No"> No
                </td>
            </tr>
            <tr>
                <td>Active:</td>
                <td>
                    <input <?php if($active=="Yes") {echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                    <input <?php if($active=="No") {echo "checked";} ?> type="radio" name="active" value="No"> No
                </td>
            </tr>
            <tr>
                <td colspan="2">
                <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                </td>
            </tr>
        </table>
        </form>
        <?php 
            if(isset($_POST['submit'])) {
                $title = $_POST['title'];
                $id = $_POST['id'];
                $current_image = $_POST['current_image'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //update the new image
                if (isset($_FILES['image']['name']))  {
                    $image_name = $_FILES['image']['name'];

                    //check the image availability
                    if($image_name !="") {
                        //uploade new image
                        
                        // AUTORENAME
                        $ext=end(explode('.', $image_name));

                        $image_name="Food_Category_".rand(000,999).'.'.$ext;

                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path="../images/category/".$image_name;

                        $upload= move_uploaded_file($source_path, $destination_path);

                        //verify image upload

                        if($upload==FALSE) {
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image</div>";
                            header('location:'.SITEURL.'admin/manage-category.php');
                            die();
                        }
                    } 
                        //remove the current image
                        if($current_image!="") {
                            $remove_path = "../images/category/".$current_image;
                            $remove = unlink($remove_path);
    
                            // check whether the image is removed
                            if ($remove==FALSE) {
                                $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image.</div>";
                                header('location:'.SITEURL.'admin/manage-category.php');
                                die();
                            } 
                        }
                        
                    else{
                        $image_name = $current_image;
                    }

                } else {
                    $image_name = $current_image;
                }

                //update the database
                $sql2="UPDATE tbl_category SET
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
                WHERE id='$id'
                ";

                $res2= mysqli_query($conn, $sql2);
                
                //redirect to homepage
                if($res2==TRUE) {
                    $_SESSION['updated'] = "<div class='success'>'$title' Updated Successfully!</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                } else {
                    $_SESSION['updated'] = "<div class='error'>Failed to update '$title'</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
                

            }
        ?>
    </div>
</div>
<?php include('partials/footer.php'); ?>
