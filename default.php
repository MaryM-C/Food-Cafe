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

                                if (isset($_SESSION['id']) && isset($_SESSION['fname'])){
    if(isset($_POST['fullname']) && isset($_POST['username']) && isset($_POST['emails'])){
        
        $fname=$_POST['fullname'];
        $uname=$_POST['username'];
        $email=$_POST['emails'];

        $sql = "UPDATE tbl_users
                SET fname = IF('$fname' = '', fname, '$fname'),
                    unames = IF('$uname' = '', unames, '$uname'),
                    emails= IF('$email' = '', email, '$email')
                WHERE id='$id'";
        $result=$conn->query($sql);

    }

}