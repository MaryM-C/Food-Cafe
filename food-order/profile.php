<?php 
session_start();
include_once "config/db_connect.php";
$sql = "SELECT * FROM tbl_user WHERE id = ?";
$user= $conn->prepare($sql);
$id=$_SESSION['id'];
$user->execute([$id]);



if($user->rowCount() == 1){
   
    $row=$user->fetch();

    $fullName=$row['fname'];
    $uname=$row['unames'];
    $email=$row['email'];
    $id=$row['id'];
}




if (isset($_SESSION['id']) && isset($_SESSION['fname'])) {?>
<!DOCTYPE html lang="en">
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Home</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<!-- update modal-->
<div class="modal fade" id="editProfile" tabindex="-1" role="dialog" aria-labelledby="editProfileLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <label for="fullname">Fullname</label>
            <input type="text" class="form-control w-100 mb-1" id="fullname" placeholder="<?=$fullName?>">

            <label for="username">Username</label>
            <input type="text" class="form-control w-100 mb-1" id="username" placeholder="<?=$uname?>">
            
            <label for="emails">Email</label>
            <input type="email" class="form-control w-100 mb-1" id="emails" placeholder="<?=$email?>">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- Change password modal-->
<div class="modal fade" id="changePassword" tabindex="-1" role="dialog" aria-labelledby="changePasswordLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <label for="oldpassword">Old Password</label>
            <input type="password" class="form-control w-100 mb-3" id="oldpassword" placeholder="Enter your old password">

            <label for="newpassword">New Password</label>
            <input type="password" class="form-control w-100 mb-1" id="newpassword" placeholder="Enter new password">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
           
<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        <a class="nav-link active ms-0 text-warning" href="index.php">Back to Home</a>
        
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
                    <button class="btn btn-primary p-6" type="button">Upload new image</button>
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
                        
                        <a class="btn btn-primary bt1 mb-2" data-toggle="modal" data-target="#editProfile" role="button" >Edit Profile</a>
                        <a class="btn btn-primary bt1 mb-2" data-toggle="modal" data-target="#changePassword" role="button" >Change password</a>
                        <a class="btn btn-success " href="logout.php" role="button">LOG OUT</a>
                        
                    </form>
                </div>
            </div>
        </div>
        </div>     
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>

<?php }

else {
	header("Location: login.php");
	exit;} ?>
