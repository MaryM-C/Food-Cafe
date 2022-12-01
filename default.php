<?php 
include_once "config/db_connect.php";
include('config/constants.php');
if (isset($_SESSION['id']) && isset($_SESSION['fname'])){
?>
<?php }

else {
	header("Location: login.php");
	exit;} ?>


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
