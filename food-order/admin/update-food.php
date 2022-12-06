<?php 
    include('partials/menu.php');
?>
<?php 
    if(isset($_GET['id'])) {
        $id = $_GET['id'];

        $sql2 = "SELECT * FROM tbl_food WHERE id=$id";

        $res2 = mysqli_query($conn, $sql2);

        //get the values
        $row2 = mysqli_fetch_assoc($res2);
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $featured = $row2['featured'];
        $active = $row2['active'];

    } else {
        header('location:'.SITEURL.'admin/manage-food.php');
    }
    ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title:</td>
                    <td>
                        <input type="text" name="title"  value="<?php echo $title;?>"required>
                    </td>
                </tr>
                <tr>
                    <td>Description:</td>
                    <td>
                    <textarea name="description" cols="30" rows="5" required><?php echo $description; ?></textarea>
                    </td>
                </tr>
                <tr>
                    <td>Price:</td>
                    <td>
                        <input type="number" name="price" value ="<?php echo $price;?>">
                    </td>
                </tr>
                <tr>
                    <td>Current image::</td>
                    <td>
                       <?php 
                            if($current_image == "") {
                                echo "<div class='error'>Image not Available.</div>";
                            } else {
                                ?>
                                <img src="<?php echo SITEURL;?>images/food/<?php echo $current_image;?>" width="40%">
                                <?php
                            }
                       ?>
                    </td>
                </tr>
                <tr>
                    <td>Select new image:</td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>
                <tr>
                    <td>Category:</td>
                    <td>
                        <select name="category">
                            <?php 
                                $sql = "SELECT * FROM tbl_category WHERE active='Yes'";
                                $res = mysqli_query($conn, $sql);
                                $count  = mysqli_num_rows($res);

                                // check whether category available or not
                                if($count>0) {
                                     //Category available
                                     while($row=mysqli_fetch_assoc($res)) {
                                        $category_title = $row['title'];
                                        $category_id = $row['id'];
                                       
                                    ?>
                                        <option <?php if($current_category==$category_id) {echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title?> </option>
                                    <?php
                                     }
                                } else {
                                    //category not available
                                    echo "<option value='0'>Category not available</option>";
                                    
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Feature:</td>
                    <td>
                        <input <?php if($featured=="Yes") {echo "checked";}?> type="radio" name="featured" value="Yes">Yes
                        <input <?php if($featured=="No") {echo "checked";}?> type="radio" name="featured" value="No">No
                    </td>
                </tr>
                <tr>
                    <td>Active:</td>
                    <td>
                        <input  <?php if($active=="Yes") {echo "checked";}?> type="radio" name="active" value="Yes">Yes
                        <input  <?php if($active=="No") {echo "checked";}?> type="radio" name="active" value="No">No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="submit" name="submit" value="Update Food" class="btn-primary">
                    </td>
                </tr>
            </table>
        </form>
        <?php 
            if(isset($_POST['submit'])) {
                //get all details from form
                $id = $_POST['id'];
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $current_image = $_POST['current_image'];
                $category = $_POST['category'];
                $featured = $_POST['featured'];
                $active = $_POST['active'];
                
                //upload image if selected
                if(isset($_FILES['images']['name'])) {
                    $image_name = $_FILES['images']['name'];

                    if($image_name !="") {
                        $temp=explode('.', $image_name);
                        $ext = end($temp);
                        $image_name = "Food_Name_".rand(0000,9999).'.'.$ext;
    
                        $src = $_FILES['images']['tmp_name'];
                        $dst = "../images/food/".$image_name;
    
                        $upload = move_uploaded_file($src, $dst);
    
                        if($upload==False) {
                            $_SESSION['upload'] = "<div class='error'>Failed to upload new image</div>";
                            header('location:'.SITEURL.'admin/manage-food.php');
                            die();
                        }
                    }

                }   else {
                    $image_name = $current_image;
                }
                //remove the image if it is being replaced
                //update the food in database
                $sql3 = "UPDATE tbl_food SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id = '$category',
                    featured = '$featured',
                    active = '$active' 
                    WHERE id = $id;";

                $res3 = mysqli_query($conn, $sql3);

                //redirect to manage food with session message
                if ($res3 == true) {
                    $_SESSION['update'] = "<div class='success'>Successfully updated '$title'</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                } else {
                    $_SESSION['update'] = "<div class='error'>Failed to update '$title'</div>";
                    header('location:'.SITEURL.'admin/manage-food.php');
                }
            }
        ?>
    </div>
</div>
<?php 
    include('partials/footer.php');
?>