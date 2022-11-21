<?php
    // include constants file
    include('../config/constants.php');

    //check the value of id and image_name
    if(isset($_GET['id']) AND isset($_GET['image_name'] )) {
        //get the value and delete
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];
        $title = $_GET['title'];

        // remove the physical image file if available
        if($image_name!="") {
           $path="../images/category/".$image_name;
           
           
           $remove = unlink($path);

           if($remove==FALSE) {
                $_SESSION['remove']="<div class='error'> Failed to remove the image. </div>";
                header('location:'.SITEURL.'admin/manage-category.php');
                //stop the process
                die();
           }
        }
        // delete data from database
        // query
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        $res = mysqli_query($conn, $sql);

        if($res==TRUE) {
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully!</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        } else {
            $_SESSION['delete'] = "<div class='error'>Failed to delete the category.</div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        
        //redirect to manage category with message
        
    } else {
        // redirect to manage category
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>