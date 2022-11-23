<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style-user.css">
</head>
<body>
    <div class="d-flex justify-content-center align-content-center vh-100">
    
        <form class="shadow w-450 p-3 " 
              action="config\register.php" 
              method="post">
                <p class="font-weight-bold text-center text-warning h1">Create Account</p>

                <?php if(isset($_GET['error'])){ ?>
                <div class="alert alert-danger" role="alert"><?php echo $_GET['error'];?></div>
                <?php } ?>

                <?php if(isset($_GET['success'])){ ?>
                <div class="alert alert-success" role="success"><?php echo $_GET['success'];?></div>
                <?php } ?>

                <div class="mb-3">
                    <label class="form-label text-warning" >Full Name</label>
                    <input type="text" class="form-control" name="fname" value="<?php echo(isset($_GET['fname']))?$_GET['fname']:""?>" >
                </div>

                <div class="mb-3">
                    <label class="form-label text-warning">User Name</label>
                    <input type="text" class="form-control" name="uname" value="<?php echo(isset($_GET['uname']))?$_GET['uname']:""?>">
                </div>

                <div class="mb-3">
                    <label class="form-label text-warning">Email</label>
                    <input type="email" class="form-control" name="email" value="<?php echo(isset($_GET['email']))?$_GET['email']:""?>" >
                </div>

                <div class="mb-3">
                    <label class="form-label text-warning">Password</label>
                    <input type="password" class="form-control" name="pass">
                </div>
               
                <button type="submit" class="btn btn-warning w-50 position-relative">Sign Up</button>
                <a href="LogIn.php" class="text-warning">I already have an Account</a>
        </form>
    </div>
</body>
</html>