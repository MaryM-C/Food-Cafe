<?php 
session_start();
include_once "config/db_connect.php";
$id=$_SESSION['id'];
$sql = "SELECT * FROM `tbl_order` WHERE cust_id = ? AND status='In Cart'";
$result=$conn->prepare($sql);
$result->execute([$id]);


if (isset($_SESSION['id']) && isset($_SESSION['fname'])){ ?>

<!DOCTYPE html lang="en">
<html>
<head>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
                    <thead class="thead-warning">
                    <tr class="table-warning">
                    <th scope="col" >Food</th>
                    <th scope="col">Price</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Operation</th>

                    </tr>
                    </thead>
                <tbody>
                <p class="text-left h1 text-warning">MY CART</p>
                    <?php 
                        while ($row=$result->fetch()){
                            $food = $row['food'];
                            $price=$row['price'];
                            $qty=$row['qty'];


                            echo"
                            <tr>
                                <th class='text-white'>$food</th>
                                <td class='text-white'>$price</td>
                                <td class='text-white'>$qty</td>
                                <td><a class='btn btn-primary' href='#' role='button'>remove</a></td>
                            </tr>";
        
                        }
                    
                    ?>
                        
                </tbody>
                </table> 
                <a class="btn btn-primary"  href="#" role="button">Place Order</a>
                <a class="btn btn-danger" href="#" role="button">Cancel Order</a>
        </div>

<?php }
else {
	header("Location: login.php");
	exit;} ?>