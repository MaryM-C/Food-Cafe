<?php 
session_start();
include_once "config/db_connect.php";
$id=$_SESSION['id'];
$sql = "SELECT * FROM `tbl_order` WHERE cust_id = ?";
$result=$conn->prepare($sql);
$result->execute([$id]);


if (isset($_SESSION['id']) && isset($_SESSION['fname'])) {?>
<!DOCTYPE html lang="en">
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Cart</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
           
<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        <a class="nav-link active ms-0 text-warning" href="index.php">Back to Home</a>
    </nav>
        <div class="table-responsive-sm">
                    <table class="table">
                    <thead class="thead-dark">
                    <tr class="table-warning">
                    <th scope="col" >Food</th>
                    <th scope="col">Qty.</th>
                    <th scope="col">Price</th>
                    <th scope="col">Status</th>
                    <th scope="col">Operations</th>
                    </tr>
                    </thead>
                <tbody>
                <p class="text-left h1 text-warning">MY CART</p>
                    <?php 
                        while ($row=$result->fetch()){
                            $food = $row['food'];
                            $qty=$row['qty'];
                            $price=$row['price'];
                            $status=$row['status'];

                            echo"
                            <tr>
                                <th class='text-white'>$food</th>
                                <td class='text-white'>$qty</td>
                                <td class='text-white'>$price</td>
                                <td class='text-white'>$status</td>
                                <td> <a class='btn btn-danger' href='#' role='button'>cancel order</a> </td>
                            </tr>";
        
                        }
                    
                    ?>
                        
                </tbody>
                </table> 
        </div>

        <?php }

else {
	header("Location: login.php");
	exit;} ?>
       
    

         
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</body>
</html>