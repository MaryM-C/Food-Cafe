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

            <h2 class="text-center text-yellow">Your Cart</h2>

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