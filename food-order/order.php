<?php include('partials-front/menu.php');?>
<?php 
    // Check whether food id is set or not
    if(isset($_GET['food_id'])) {
        // get the food id and details of the selected food
        $food_id = $_GET['food_id'];

        //get the details of the selected food
        $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
        $res = mysqli_query($conn, $sql);
        $count = mysqli_num_rows($res);

        // check whether the data is available or not
        if($count ==1) {
            $row = mysqli_fetch_assoc($res);

            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];
        } else {
            header('location:'.SITEURL);
        }

    } else {
        header('location:'.SITEURL);
    }
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-yellow">Fill this form to confirm your order.</h2>

            <form action="" method="POST" class="order">
                <fieldset>
                    <legend><h3>Selected Food</h3></legend>

                    <div class="food-menu-img">
                        <?php 

                            //check whether the image is available or not
                            if($image_name =="") {
                                //image not available 
                                echo "<div class = 'error'>Image not available.</div>";
                            } else {
                                //image available 
                                ?>
                                    <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                <?php 

                            }
                        ?>
                        
                    </div>
    
                    <div class="food-menu-desc">
                        <h2><?php echo $title;?></h2>
                        <input type = "hidden" name = "food" value = "<?php echo $title;?>">
                        <p class="food-price2">₱ <?php echo $price;?></p>
                        <input type = "hidden" name="price" value="<?php echo $price;?>"> <br>

                        <div class="food-detail2"><h4>Quantity</h4></div> <br>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend><h3>Delivery Details</h3></legend>
                    <div class="food-detail2"><h4>Full Name</h4></div>
                    <input type="text" name="full-name" placeholder="Name" class="input-responsive" required>

                    <div class="food-detail2"><h4>Phone Number</h4></div>
                    <input type="tel" name="contact" placeholder="Ex. 09843xxxxxx" class="input-responsive" required>

                    <div class="food-detail2"><h4>Address</h4></div>
                    <textarea name="address" rows="10" placeholder="E.g. Room Number/Office, Building" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>
            <?php 
                //check whether the submit button is clicked or not
                if(isset($_POST['submit'])) {
                    //get all the data
                    $food = $_POST['food'];
                    $price = $_POST['price'];
                    $qty = $_POST['qty'];

                    $total = $price * $qty; // total amount
                    $order_date = date("Y-m-d"); //Order date
                    $status = "Ordered";
                    $customer_name = $_POST['full-name'];
                    $customer_contact = $_POST['contact'];
                    $customer_address = $_POST['address'];

                    

                    //save the order in database
                    //create SQL to save the data
                    $sql2 = "INSERT INTO tbl_order SET 
                            food = '$food',
                            price = $price,
                            qty = $qty,
                            total = $total,
                            order_date = '$order_date',
                            status = '$status',
                            customer_name = '$customer_name',
                            customer_number = '$customer_contact',
                            customer_address = '$customer_address'
                            ";
                    
                    //execute the query
                    $res2 = mysqli_query($conn, $sql2);
                    

                    //check whether the query executed successfully
                    if($res2 == true ) {
                        //query executed and order saved
                        $_SESSION['order'] =  "<div class='success text-center'><h2>Order placed successfully!<h2></div>";
                        header('location:'.SITEURL);

                    } else {
                        //failed to save order
                        $_SESSION['order'] =  "<div class='error text-center'>Order placed fail!</div>";
                        header('location:'.SITEURL);
                        
                    }

                } else {
                    

                }
            ?>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



<?php include('partials-front/footer.php');?>
