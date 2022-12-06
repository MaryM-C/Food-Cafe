<!--CRUD OPERATIONS NEEDED TO MANAGE FOOD ITEMS-->
<?php include('partials/menu.php'); ?>

      
            <!-- Main Content Section Starts -->
            <div class="main-content">
            <div class=wrapper> 
            <h1> MANAGE FOOD</h1> <br><br>

            <?php 
            include('partials/manage-food.php');
            manageFoodMessages();
           
        ?>
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

          <br>
            <!-- Button to Add Admin-->
            <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">Add food</a>
            <br><br><br>
               <table class="tbl-full">
                    <tr>
                         <th>S.N</th>
                         <th>Title</th>
                         <th>Image</th>
                         <th>Description</th>
                         <th>Price</th>
                         <th>Featured</th>
                         <th>Active</th>
                         <th>Actions</th>
                    </tr>
                    <?php 
                    $sql = "SELECT * FROM tbl_food ORDER BY title ASC";
                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);

                    $sn = 1;

                    if($count>0) {
                         //retrieve data from database and display
                         while($rows=mysqli_fetch_assoc($res)) {
                              $id = $rows['id'];
                              $title = $rows['title'];
                              $description = $rows['description'];
                              $price = $rows['price'];
                              $image_name = $rows['image_name'];
                              $featured = $rows['featured'];
                              $active = $rows['active'];

                         ?> 
                         <tr>
                         <td><?php echo $sn++;?></td>
                         <td><?php echo $title;?></td>
                         <td><?php 
                              //check image availability 
                              if($image_name!="") {
                                   ?>
                                   <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                                   <?php 
                              } else {
                                   echo "<div class='error'>Image not added</div>";

                              }
                         ?></td>
                         <td width="400px"><?php echo $description;?></td>
                         <td>₱ <?php echo $price;?></td>
                         
                         <td><?php echo $featured;?></td>
                         <td><?php echo $active;?></td>

                         <td>
                              <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id;?>" class="btn-primary icon"><i class="fa fa-pencil"></i></a>
                              <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger icon"><i class="fa fa-trash"></i></a>
                              
                         </td>
                    </tr>
                         <?php
                         }

                    } else {
                         echo "<tr> <td colspan='8' class='error'> Food Not Added Yet.</td></tr>";
                    }
                    ?>
                    
                    
               </table>
          </div>
 </div>
     <!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>