<?php 
include_once "config/db_connect.php";
include('config/constants.php');
if (isset($_SESSION['id']) && isset($_SESSION['fname'])){
?>
<?php }

else {
	header("Location: login.php");
	exit;} ?>

th class='text-white'><?php echo $row['food']?></th>
                                <td class='text-white'><?php echo $row['price']?></td>
                                <td class='text-white'><?php echo $row['qty']?></td>

