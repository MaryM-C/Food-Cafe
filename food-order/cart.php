<?php 
session_start();
include_once "config/db_connect.php";
$id=$_SESSION['id'];
$sql = "SELECT * FROM `tbl_order` WHERE cust_id = ? AND status='In Cart'";
$result=$conn->prepare($sql);
$result->execute([$id]); 

if (isset($_SESSION['id']) && isset($_SESSION['fname'])){?>

<!DOCTYPE html lang="en">
<html>
<head>
 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Cart</title>
    <!-- Styling-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>

<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        <a class="nav-link active ms-0 text-warning" href="index.php">Back to Home</a>
    </nav>
    <!-- Cart Table-->
        <div class="table-responsive-sm">
                    <table class="table">
                    <thead class="thead-warning">
                    <tr class="table-warning">
                    <th scope="col" >Food</th>
                    <th scope="col">Price</th>
                    <th scope="col">Qty</th>
                    <th scope="col">Total</th>
                    <th scope="col">Operation</th>

                    </tr>
                    </thead>
                <tbody>
                <p class="text-left h1 text-warning">MY CART</p>
                    <?php
                    while ($row = $result->fetch()) {
                        $food = $row['food']; 
                        $price = $row['price']; 
                        $qty = $row['qty'];
                        $total=$row['total'];
                        $order_id = $row['order_id'];
                    ?>
                     <tr>
                                <th class='text-white'><?php echo $food ?></th>
                                <td class='text-white'><?php echo $price ?></td>
                                <td class='text-white'><?php echo $qty ?></td>
                                <td class='text-white'><?php echo $total ?></td>
                                <td>
                                  <a class='btn btn-primary' href="config\delete.php?order_id=<?php echo $row['order_id']?>" role='button'>remove</a>
                                </td>
                    <?php }?>
                        
                </tbody>
                </table> 
                <?php $sql = "SELECT sum(total) FROM tbl_order WHERE cust_id = $id AND status='In Cart'";
                    $result=$conn->query($sql);
                while ($row = $result->fetch()) {
                    $tot=$row['sum(total)'];
                }
                    ?>
                <div class="h2 text-warning">Total: <?php echo $tot ?></div>



                <form method="POST" action="cart.php">
                  <fieldset >
                      <legend>Order Details</legend>
                      <div class="order-label text-warning">Transaction</div>
                      <div class="input-group mb-3">
                        <select class="custom-select" name="transTyp">
                          <option value="Dine In">Dine In</option>
                          <option value="PickUp">Pick Up</option>
                        </select>
                      </div>


                      <div class="order-label text-warning">Any specific preferences? Let the cafe know.</div>
                      <div class="input-group">
                        <span class="input-group-text">Special instructions</span>
                        <textarea id="splIns" name="splIns" class="form-control" aria-label="With textarea" placeholder="eg. Table Number" required></textarea>
                      </div>

                  </fieldset>

                    <?php
                      if (isset($_POST['submit']) || isset($_POST['transTyp']) || isset($_POST['splIns'])){
                        $transaction = $_POST['transTyp'];
                        $Ins = $_POST['splIns'];
                        $sql = "UPDATE tbl_order SET status = 'Ordered', transaction='$transaction', splInst='$Ins' WHERE cust_id = $id AND status='In Cart' ";
                        $result=$conn->query($sql);?>
                            <script>    
                                
                                swal({
                                title: 'Success!',
                                icon: "success",
                                text: 'Your order has been sent!  \nProceed to the counter to pay with a total amount of: ₱ <?php echo $total?> \nOrder Number: <?php echo $order_id?>',
                                type: 'success',
                                confirmButtonText: 'OK'
                                }).then(() => {
                                    window.location.href = "index.php";
                                });
                        </script>
                        <?php
                        //header("Location: index.php"); 
                        }
                        ?>
                <input type="submit" name="submit" value="PLACE ORDER" id="submit" class="btn btn-primary p-3 "> 
                </form>


                
                
                
        </div>
<!--Modal-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
</body>
</html>

<?php }

else {
	header("Location: login.php");
	exit;} 
?>