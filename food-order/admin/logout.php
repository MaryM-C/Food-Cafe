<?php 
    // Destroy the session and redirect to login page
    include('../config/constants.php');
    session_destroy();
    header('location:'.SITEURL.'admin/login.php');
?>