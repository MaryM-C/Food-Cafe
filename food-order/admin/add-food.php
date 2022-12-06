<?php include('partials/menu.php'); ?>
<div class="main-content">
    <div class="wrapper">
        <h1>ADD FOOD</h1>
        <br><br> <br>
        <?php 

            if(isset($_SESSION['add2'])) {
                echo $_SESSION['add2'];
                unset($_SESSION['add2']);
            }
            
            if(isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            
        ?>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title" placeholder="Food Title">
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="Food Description"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>
                <tr>
                    <td>Select Image:</td>
                    <td>
                        <input type="file" name="image" required>
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">

                            <?php //Retrieve all active categories
                                $sql = "SELECT * FROM tbl_category WHERE active='YES'";
                                $res = mysqli_query($conn, $sql);
                                $count = mysqli_num_rows($res);

                                if($count>0) {
                                    // We have categories

                                    while($rows=mysqli_fetch_assoc($res)) {
                                        $id = $rows['id'];
                                        $title = $rows['title'];

                                        ?> 
                                        <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                                        <?php
                                    } 

                                } else {
                                    //No Categories
                                    ?>
                                    <option value="0">No Category</option>
                                    <?php

                                }

                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Featured:</td>
                    <td>
                        <input type="radio" name="featured" value="Yes" checked>Yes
                        <input type="radio" name="featured" value="No" >No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input type="radio" name="active" value="Yes" checked>Yes
                        <input type="radio" name="active" value="No" >No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Food" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>

        <?php 
            if(isset($_POST['submit'])) {
                //retrieve data from Form
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];

                //upload image
                if(isset($_FILES['image']['name'])) {
                  
                   $image_name= $_FILES['image']['name'];

                    //check image availability
                    if($image_name != "") { 
                        //rename it
                        $temp=explode('.', $image_name);
                        $ext = end($temp);
                        $image_name = "Food_Name_".rand(0000,9999).'.'.$ext;
                        $src = $_FILES['image']['tmp_name'];
                        $dst="../images/food/".$image_name;
                        $upload = move_uploaded_file($src, $dst);

                        if($upload==FALSE) {
                            $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                            header('location'.SITEURL.'admin/add-food.php');
                            die();
                        }
                        //remove current image
                        if($current_image !="") {
                            $remove_path = "../images/food/".$current_image;
                            $remove = unlink($remove_path);

                            if($remove==FALSE) {
                                $_SESSION['remove-failed'] = "<div class='error'>Failed to remove the current image.</div>";
                                header('location:'.SITEURL.'admin/manage-food.php');
                                die();
                            }
                        }
                    }
                } else {
                    $image_name="";
                }
                //insert into database
                $sql2 = "INSERT INTO tbl_food SET
                title ='$title',
                description = '$description',
                price = $price,
                image_name = '$image_name',
                category_id = $category,
                featured = '$featured',
                active = '$active'
                ";
                 
                
                $res2=mysqli_query($conn, $sql2);

                //redirect with a message
                if($res2==TRUE) {
                    $_SESSION['add2'] = "<div class='success'>'$title' Added Successfully!</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                } else {
                    $_SESSION['add2'] = "<div class='error'>Failed to add '$title'</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
                
            }
        ?>
    </div>
</div>
<?php include('partials/footer.php'); ?>