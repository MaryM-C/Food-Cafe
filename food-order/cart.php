<?php 
session_start();
include_once "config/db_connect.php";
$id=$_SESSION['id'];
$sql = "SELECT * FROM `tbl_order` WHERE cust_id = ? AND status='In Cart'";
$result=$conn->prepare($sql);
$result->execute([$id]); 

?>

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
</head>
<body>
<div class="modal fade" id="placeOrder" tabindex="-1" role="dialog" aria-labelledby="placeOrderLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="placeOrderLabel">Place Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <form method="post" action="cart.php">
        <?php if (isset($_POST['submit'])) {
                    $sql = "UPDATE tbl_order SET status = 'Ordered' WHERE cust_id = $id";
                    $result=$conn->query($sql);
                    
                    if(isset($_GET['tblNumber'])){
                        $tblnumb = $_POST['tblNumber'];
                        $sql = "UPDATE tbl_order SET tblNo = $tblnumb WHERE cust_id = $id";
                        $result=$conn->query($sql);
                    }
                    header("Location: cart.php");}?>

                <Label class="h5">Table Number:</Label>
                <input type="number" name="tblNumber" id="tblNumbers">
    
                <input type="submit" name="submit" value="Proceed" class="btn btn-primary p-3 "> 
                <button type="button" class="btn btn-secondary p-3" data-dismiss="modal">CLOSE</button>
                
        </form>
      </div>
      
    </div>
  </div>
</div>

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
                        $order_id = $row['order_id'];
                    ?>
                     <tr>
                                <th class='text-white'><?php echo $food ?></th>
                                <td class='text-white'><?php echo $price ?></td>
                                <td class='text-white'><?php echo $qty ?></td>
                                <td>
                                    <a class='btn btn-primary' href="config\delete.php?order_id=<?php echo $row['order_id']?>" role='button'>remove</a>
                                </td>
                    <?php }?>
                        
                </tbody>
                </table> 
                <a class="btn btn-primary bt1 mb-2" data-toggle="modal" data-target="#placeOrder" role="button" >Place Order</a>
                
                
        </div>
<!--Modal-->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
