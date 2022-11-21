<?php include('partials/menu.php'); ?>

       <!-- Menu Section Ends -->
            <!-- Main Content Section Starts -->
            <div class="main-content">
            <div class=wrapper> 
            <h1> MANAGE FOOD</h1> <br><br>

            <?php 
            if(isset($_SESSION['add2'])) {
                echo $_SESSION['add2'];
                unset($_SESSION['add2']);
            }
            if(isset($_SESSION['delete'])) {
               echo $_SESSION['delete'];
               unset($_SESSION['delete']);
           }
           if(isset($_SESSION['upload'])) {
               echo $_SESSION['upload'];
               unset($_SESSION['upload']);
           }
           if(isset($_SESSION['update'])) {
               echo $_SESSION['update'];
               unset($_SESSION['update']);
           }
           
        ?>
          <br>
            <!-- Button to Add Admin-->
            <a href="<?php echo SITEURL;?>admin/add-food.php" class="btn-primary">Add food</a>
            <br><br><br>
               <table class="tbl-full">
                    <tr>
                         <th>S.N</th>
                         <th>Title</th>
                         <th>Description</th>
                         <th>Price</th>
                         <th>Image</th>
                         <th>Featured</th>
                         <th>Active</th>
                         <th>Actions</th>
                    </tr>
                    <?php 
                    $sql = "SELECT * FROM tbl_food";
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
                         <td width="400px"><?php echo $description;?></td>
                         <td>₱ <?php echo $price;?></td>
                         <td><?php 
                              //check image availability 
                              if($image_name=="") {
                                   //display error message
                                   echo "<div class='error'>Image not added</div>";
                              } else {
                                   ?>
                                   
                                   <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px">
                                   <?php 
                              }
                         ?></td>
                         <td><?php echo $featured;?></td>
                         <td><?php echo $active;?></td>

                         <td>
                              <a href="<?php echo SITEURL; ?>/admin/update-food.php?id=<?php echo $id;?>" class="btn-primary">Update Food</a>
                              <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Food</a>
                              
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