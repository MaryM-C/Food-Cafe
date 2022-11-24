<?php include('partials/menu.php'); ?>

     <!-- Main Content Section Starts -->
       <div class="main-content">
            <div class=wrapper> 
            <h1> MANAGE STAFF </h1> <br>

            <?php 
               if(isset($_SESSION['add'])) {
                    echo $_SESSION['add']; // displaying session message
                    unset($_SESSION['add']); // removing session message
               }

               if(isset($_SESSION['delete'])) {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
               }

               if(isset($_SESSION['update'])) {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
               }

               if(isset($_SESSION['user-not-found'])) {
                    echo $_SESSION['user-not-found'];
                    unset($_SESSION['user-not-found']);
               }

               if(isset($_SESSION['unmatched_password'])) {
                    echo $_SESSION['unmatched_password'];
                    unset($_SESSION['unmatched_password']);
               }

               if(isset($_SESSION['change_password'])) {
                    echo $_SESSION['change_password'];
                    unset($_SESSION['change_password']);
               }
               ?>
               <br> <br><br>

            <!-- Button to Add Admin-->
            <a href="add-admin.php" class="btn-primary">Add staff</a>
            <br><br><br>
               <table class="tbl-full">
                    <tr>
                         <th>S.N</th>
                         <th>Full Name</th>
                         <th>Username</th>
                         <th>Actions</th>
                    </tr>

                    <?php 
                         // Query to display contents of database
                         $sql = "SELECT * FROM tbl_admin";

                         // execute query
                         $res = mysqli_query($conn, $sql);

                         // check whether the query is executed or not
                         if ($res==TRUE) {
                              // count rows to checke whether we have data in database or not
                              $rows= mysqli_num_rows($res); // get all the rows in database
                              
                              $sn=1; //create a variable and assign the value
                              // check whether the number of rows
                              if ($rows>0) {
                                   while($rows=mysqli_fetch_assoc($res)) {
                                        // using while loop to get all the data database from the database
                                        $id = $rows['id'];
                                        $full_name = $rows['full_name'];
                                        $username = $rows['username'];

                                        // display values the values in table
                                        ?>
                                        <tr>
                                             <td><?php echo $sn++; ?></td>
                                             <td><?php echo $full_name;?></td>
                                             <td><?php echo $username; ?></td>
                                             <td> 
                                                  <a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id;?>" class="btn-primary">Change Password</a> 
                                                  <a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id;?>" class="btn-secondary">Update Admin</a>
                                                  <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id;?>"class="btn-danger">Delete Admin</a>
                              
                                             </td>
                                        </tr>
                                        <?php
                                   }
                              } else {

                              }
                         }
                    ?>
               </table> 
                    </div>
                    </div>

     <!-- Main Content Section Ends -->

<?php include('partials/footer.php'); ?>