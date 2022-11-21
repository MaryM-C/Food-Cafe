<?php 
    include('../config/constants.php');

    if(isset($_GET['id']) AND isset($_GET['image_name'])) {
        // proceed to delete
        $id = $_GET['id']; 
        $image_name = $_GET['image_name'];
        //get id and image name

        // remove the image if available
        if ($image_name != "") {
            //image path
            $path = "../images/food/".$image_name;

            $remove= unlink($path);

            if($remove==FALSE) {
                $_SESSION['upload'] = "<div class='error'>Fail to remove image file</div>";
                header('location:'.SITEURL.'admin/manage-food.php');
                die();
            }
        }   
        
        //delete food from database
            $sql =  "DELETE FROM tbl_food where id=$id";
            $res = mysqli_query($conn, $sql);
        // redirecto manage food with session message
            if($res) {
                $_SESSION['delete'] = "<div class='error'>Successfully deleted</div>";
            header('location:'.SITEURL.'admin/manage-food.php');
            } else {
                $_SESSION['delete'] = "<div class='error'> Failed to delete </div>";
            header('location:'.SITEURL.'admin/manage-food.php');
            }
        
        

        

    } else {
        // redirect to manage food page
        $_SESSION['unathorized'] = "<div class='error'> Unauthorized Access. </div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
?>