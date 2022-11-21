<?php
    // Include constants.php file here
    include('../config/constants.php');
    // Get the ID of Admin to be delete
    $id = $_GET['id'];
    // Create SQL Query to Delete Admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    // Execute the Query
    $res = mysqli_query($conn, $sql);

    // Check whether the query executed successfully or not
    if ($res==TRUE) {
        // Query Executed Successfully and Admin Deleted
        //Create Session Variable to Display Message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully! </div>";
        //Redirect to Manage Admin Page
        header('location:'.SITEURL.'admin/manage-admin.php');
    } else {
        // Failed to Delete Admin
        $_SESSION['delete'] = "<div class='error'>Failed to Delete Admin. Try Again Later.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    // Redirect to Manage admin page with message (success/error)
?>