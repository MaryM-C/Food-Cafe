<?php include ('partials/menu.php');?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>
        <br><br>

        <?php 
            //Check whether the id is set or not
            if(isset($_GET['id'])) {
                //get order details
                $id = $_GET['id'];

                //get all the other details based on id 
                $sql = "SELECT * FROM tbl_order WHERE id=$id";
                $res = mysqli_query($conn, $sql);
                //count the rows
                $count = mysqli_num_rows($res);

                    if($count> 0) {
                        //Order available
                        $row = mysqli_fetch_assoc($res);
                        $food = $row['food'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $status = $row['status'];
                    } else {
                        //Order not available
                       
                    }

            } else {
                //redirect to manage order
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        ?>

        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Food Name</td>
                    <td><b><?php echo $food;?></b></td>
                </tr>
                <tr>
                    <td>Price</td>
                    <td><b><?php echo $price; ?></b></td>
                </tr>
                <tr>
                    <td>Qty</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty;?>">
                    </td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status">
                            <option <?php if($status =="Ordered") {echo "selected";}?> value="Ordered">Ordered</option>
                            <option <?php if($status =="Preparing") {echo "selected";}?> value="Preparing">Preparing</option>
                            <option <?php if($status =="On Delivery") {echo "selected";}?> value="On Delivery">On Delivery</option>
                            <option <?php if($status =="Delivered") {echo "selected";}?> value="Delivered">Delivered</option>
                            <option <?php if($status =="Cancelled") {echo "selected";}?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan='2'>
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="price" value="<?php echo $price;?>">
                        <input type="submit" name="submit" value="Update Ordered" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <?php 
            //check if button is clicked
            if(isset($_POST['submit'])) {
                //get all the values 
                $id = $_POST['id'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $price * $qty;
                $status = $_POST['status'];

                $sql2 = "UPDATE tbl_order SET
                qty = $qty,
                total = $total,
                status = '$status'
                WHERE id = $id";

                $res2 = mysqli_query($conn, $sql2);

                if($res2 == TRUE) {
                    $_SESSION['update_order'] = "<div class='success'> Order Updated!</div>";

                    // Redirect to Manage Admin Page
                    header('location:'.SITEURL.'admin/manage-order.php');
                } else {
                    $_SESSION['update_order'] = "<div class='success'> Order Update Failed!</div>";

                    // Redirect to Manage Admin Page
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            } 
        ?>
    </div>
</div>
<?php include ('partials/footer.php');?>