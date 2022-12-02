<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style-user.css">
</head>
<body>
	<div>
		<div class="d-flex justify-content-center align-items-center vh-100">
			
			<form class="shadow w-450 p-3" 
				action="config/login.php" 
				method="post">

				<h4 class="font-weight-bold text-center text-warning h1">LOGIN</h4><br>
				<?php if(isset($_GET['error'])){ ?>
				<div class="alert alert-danger" role="alert">
				<?php echo $_GET['error']; ?>
				</div>
				<?php } ?>

			<div class="mb-3">
				<label class="form-label text-warning">Username</label>
				<input type="text" 
					class="form-control"
					name="uname"
					value="<?php echo (isset($_GET['uname']))?$_GET['uname']:"" ?>">
			</div>

			<div class="mb-3">
				<label class="form-label text-warning">Password</label>
				<input type="password" 
					class="form-control"
					name="pass">
			</div>
			
			<button type="submit" class="btn btn-warning">Login</button>
			<a href="SignUp.php" class="link-secondary text-warning">Sign Up</a>
			</form>
		</div>
	</div>
    
</body>
</html>