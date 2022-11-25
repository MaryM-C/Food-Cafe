<?php 
session_start();
include_once "config/db_connect.php";
$sql = "SELECT * FROM tbl_user";
$user= $conn->prepare($sql);
$user->execute();
$row=$user->fetch(PDO::FETCH_ASSOC);



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
    <div class="d-flex justify-content-center align-items-center vh-100">
    	
    	<div class="shadow w-500 p-3 text-center bg-white">
            <?php 
                
                
            ?>
            <h3 class="display-4 ">Hello, <?=$_SESSION['fname']?></h3>
           
            <a href="logout.php" class="btn btn-warning">Logout</a>
		</div>
    </div>
</body>
</html>

<?php }

else {
	header("Location: login.php");
	exit;} ?>