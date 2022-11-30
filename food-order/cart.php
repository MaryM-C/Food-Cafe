<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
            <nav class="navbar navbar-expand-lg navbar-light ">
                <a class="navbar-brand text-warning">My Cart</a>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link text-warning" href="./index.php">Home<span class="sr-only">(current)</span></a>
                    </li>
                    </ul>
                    
                </div>
            </nav>
        <table class="table">
        <thead class="thead-dark">
            <tr>
            <th scope="col">#</th>
            <th scope="col">Product</th>
            <th scope="col">Price</th>
            <th scope="col">Handle</th>
            </tr>
        </thead>
        </table>
</body>
</html>
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