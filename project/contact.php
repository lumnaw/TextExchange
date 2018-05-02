<?php
session_start();
$conn = new mysqli("localhost","root","root","Textbook_Exchange");
require 'item.php';
require 'account.php';
if($conn->connect_error)
{
	die("Fail to Connect Database: ". $conn->connect_error);
}
if(isset($_GET['id']))
{
	$user = $_GET['id'];
	$query = "select * from Account where Username = '";
	$query .= $user;
	$query .= "'";
	$result = mysqli_query($conn, $query);
	$product = mysqli_fetch_object($result);
	$item = new AccountInfo();
	$item->Username = $product->Username;
	$item->PhoneNum = $product->PhoneNum;
	$item->Email = $product->Email;
	
	
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>TE Contact Seller</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="homeDesign.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<div class="header">
		  <p style="font-size: 40px;">Textbook Exchange</p>

</div>
</head>
<body>
	<h2>To trade or pay in cash, please contact the seller using the information below: </h2>
	<?php echo $item->Username; ?><br><?php echo $item->Email;?><br><?php echo $item->PhoneNum;?>
	<br>
	<br>
	<?php $index = 0; ?>
	<a href="cart.php">Back to Cart</a> <a href="cart.php?index=<?php echo $index; ?>" onclick="return confirm('Are you sure? Once you have bought the book, please make sure the seller takes off the listing.')">Contacted Seller</a>
</body>
</html>