<?php include('partials/menu.php'); ?>

        <!-- Main Content Section Starts -->
            <div class="main-content">
            <div class=wrapper> 
            <h1> MANAGE ORDER </h1> <br> <br>

            <?php 
             if(isset($_SESSION['update_order'])) {
               
               echo $_SESSION['update_order'];
               unset($_SESSION['update_order']);
            }
            ?>
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

            <br>
                <form action="" method="GET">
                    From Date:
                    <input type="date" name="from_date" value="<?php if(isset($_GET['from_date'])) { echo $_GET['from_date'];}?>">
                    To Date:
                    <input type="date" name="to_date"  value="<?php if(isset($_GET['to_date'])) { echo $_GET['to_date'];}?>">
                    <div>
                    <input type="submit" name="submit" value="Filter" class="btn-secondary width-80">
                    </div>
                </form>
               <table class="tbl-full">
                    <tr>
                         <th>S.N</th>
                         <th>Food</th>
                         <th>Price</th>
                         <th>Qty</th>
                         <th>Total</th>
                         <th>Order Date</th>
                         <th>Status</th>
                         <th>Customer Name</th>
                         <th>Customer Contact</th>
                         <th>Customer Address</th>
                         <th>Actions</th>
                    </tr>
                     
                         <?php
                              //get all the orders from database
                              $sql = "SELECT * FROM tbl_order ORDER BY id DESC";
                              if (isset($_GET['from_date']) && isset($_GET['to_date'])) {
                                   $from_date = $_GET['from_date'];
                                   $to_date = $_GET['to_date'];
                                   
                                   if(!empty($from_date) && !empty($to_date)) {
                                        $sql = "SELECT * FROM tbl_order WHERE order_date BETWEEN '$from_date' AND '$to_date' ORDER BY id DESC";
                                   }
                                   
                              }
                              //count rows
                              $res = mysqli_query($conn, $sql);
                              $count = mysqli_num_rows($res);

                              //serial number
                              $sn=1;

                              if($count > 0) {
                                   //get all the order details 
                                   while($row=mysqli_fetch_assoc($res)) {
                                        $id = $row['id'];
                                        $food = $row['food'];
                                        $price = $row['price'];
                                        $qty = $row['qty'];
                                        $total = $row['total'];
                                        $order_date = $row['order_date'];
                                        $status = $row['status'];
                                        $customer_name = $row['customer_name'];
                                        $customer_contact = $row['customer_number'];
                                        $customer_address = $row['customer_address'];

                                        ?> 
                                        <tr>
                                        <td><?php echo $sn++;?></td>
                                        <td><?php echo $food;?></td>
                                        <td><?php echo $price;?></td>
                                        <td><?php echo $qty;?></td>
                                        <td><?php echo $total;?></td>
                                        <td><?php echo $order_date;?></td>
                                        <td>
                                             <?php 
                                                  //ordered, preparing, on delivery, delivered, cancelled
                                                  if($status == "Ordered") {
                                                       echo "<label>$status</label>";
                                                  } else if ($status =="Preparing") {
                                                       echo "<label style = 'color: DeepPink;'><b>$status</b></label>";
                                                  } else if ($status =="On Delivery") {
                                                       echo "<label style = 'color: orange;'><b>$status</b></label>";
                                                  } else if ($status =="Delivered") {
                                                       echo "<label style = 'color: MediumSeaGreen;'><b>$status</b></label>";
                                                  } else if ($status =="Cancelled") {
                                                       echo "<label style = 'color:DarkRed;'><b>$status</b></label>";
                                                  } 
                                             ?>
                                        </td>
                                        <td><?php echo $customer_name;?></td>
                                        <td><?php echo $customer_contact;?></td>
                                        <td><?php echo $customer_address;?></td>

                                        <td>
                                        <a href="<?php echo SITEURL;?>admin/update-order.php?id=<?php echo $id;?>" class="btn-primary icon"><i class = "fa fa-pencil"></i></a>
                                        </td>
                                        <?php
                                   }
                              } else {
                                   //No orders
                                   echo "<tr><td colspan='11' class = 'error'>There are no orders.</td></tr>";
                              }
                         ?>
                    </tr> 
                   
               </table>
          </div>
 </div>
     <!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>