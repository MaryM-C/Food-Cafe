<?php 
session_start();
include_once "config/db_connect.php";
$sql = "SELECT * FROM tbl_user";
$user= $conn->prepare($sql);
$user->execute();
$row=$user->fetch();

$fullName=$row['fname'];
$uname=$row['unames'];
$email=$row['email'];




if (isset($_SESSION['id']) && isset($_SESSION['fname'])) {?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        <a class="nav-link active ms-0 text-warning" href="index.php" >Back to Home</a>
        
    </nav>
    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Profile Picture</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img class="img-account-profile rounded-circle mb-2" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <!-- Profile picture upload button-->
                    <button class="btn btn-primary" type="button">Upload new image</button>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Account Details</div>
                <div class="card-body">
                    <form>
                        <!-- Form Group (username)-->
                        <div class="mb-1">
                            <label class="h3 mb-1">Username: <?=$uname?></label>
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (full name)-->
                            <div class="col-md-6">
                                <label class="h3 mb-1">Full name: <?=$fullName?></label>
                                
                            </div>
                        
                        <!-- Form Group (email address)-->
                        <div class="mb-3">
                            <label class="h3 mb-1">Email address: <?=$email?></label>
                        </div>
                        <!-- Save changes button-->
                        <button class="btn btn-primary bt1 mb-1" type="button">Edit Profile</button>
                        <button class="btn btn-success bt1"  type="button">LOG OUT</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
</div>

</body>
</html>

<?php }

else {
	header("Location: login.php");
	exit;} ?>