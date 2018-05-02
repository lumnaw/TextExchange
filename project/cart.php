<?php
session_start();
$conn = new mysqli("localhost","root","root","Textbook_Exchange");
require 'item.php';
if($conn->connect_error)
{
	die("Fail to Connect Database: ". $conn->connect_error);
}

if(isset($_GET['id']))
{
	$result = mysqli_query($conn, 'select * from Book where BookID='.$_GET['id']);
	$product = mysqli_fetch_object($result);
	$item = new Item();
	$item->BookID = $product->BookID;
	$item->Name = $product->Name;
	$item->Price = $product->Price;
	$item->Subject = $product->Subject;
	$item->Edition = $product->Edition;
	$item->SellerID = $product->SellerID;
	$item->quantity = 1;
	//check product is existing in cart
	$index = -1;
	$cart = unserialize(serialize($_SESSION['cart']));
	for($i=0;$i<count($cart);$i++)
		if($cart[$i]->BookID==$_GET['id'])
		{
			$index = $i;
			break;
		}
	if($index==-1)
		$_SESSION['cart'][] = $item;
	else{
		echo "You already have this item in your cart! <br><br>";
		$_SESSION['cart'] = $cart;
	}
}
//delete product in cart
if(isset($_GET['index'])){
	$cart = unserialize(serialize($_SESSION['cart']));
	unset($cart[$_GET['index']]);
	$cart = array_values($cart);
	$_SESSION['cart'] = $cart;
}
?>
<html>
<head>
	<title>TE Cart</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="homeDesign.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class="header">
	  <p style="font-size: 40px;">Textbook Exchange
</p>

</div>
</div>
<table cellpadding="2" cellspacing="2" border="1">
	<tr>
		
		<th>Name</th>
		<th>Price</th>
		<th>Subject</th>
		<th>Edition</th>
		<th>SellerID</th>
		<th>Option</th>
	</tr>
	<?php
		$cart = unserialize(serialize($_SESSION['cart']));
		$index = 0;
		$s = 0;
		for($i=0; $i<count($cart); $i++)
		{
			$s += $cart[$i]->Price;
	?>		
		<tr>
			
			<td><?php echo $cart[$i]->Name;?></td>
			<td><?php echo $cart[$i]->Price;?></td>
			<td><?php echo $cart[$i]->Subject;?></td>
			<td><?php echo $cart[$i]->Edition;?></td>
			<td><?php echo $cart[$i]->SellerID;?></td>
			<td><a href="cart.php?index=<?php echo $index; ?>" onclick="return confirm('Are you sure?')">Delete</a></td>
		</tr>
		<?php 
			$index++;
			} ?>
		<tr>
			<td colspan ="5" align="right">Total</td>
			<td align="left"><?php echo $s;?></td>
		</tr>
</table>
<br>
<a href="welcome.php">Continue Shopping</a>
<br>
<br>
<script src="https://www.paypalobjects.com/api/checkout.js"></script>

<div id="paypal-button-container"></div>
<button ng-click="makePaypalPayment()" class="btn btn-info" style="margin-top: 40px; margin-bottom: 40px;"></button>

</div>

<script>
	var foo="%= $scope.total";//passing off var
	// Render the PayPal button
	paypal.Button.render({
			// Set your environment
			env: 'sandbox', // sandbox | production
			// PayPal Client IDs - replace with your own
			// Create a PayPal app: https://developer.paypal.com/developer/applications/create
			client: {
					sandbox:    'AZDxjDScFpQtjWTOUtWKbyN_bDt4OgqaF4eYXlewfBP4-8aqX3PiV8e1GWU6liB2CUXlkA59kJXE7M6R',
					production: '<insert production client id>'
			},
			// Set to 'Pay Now'
		 commit: true,
			// Wait for the PayPal button to be clicked
			payment: function() {
					// Make a client-side call to the REST api to create the payment
					return paypal.rest.payment.create(this.props.env, this.props.client, {
							transactions: [
									{
											amount: { total: "<?php echo $s; ?>", currency: 'USD' }
									}
							]
					});
					 },
			// Wait for the payment to be authorized by the customer
			onAuthorize: function(data, actions) {
					// Execute the payment
					return actions.payment.execute().then(function() {
							document.querySelector('#paypal-button-container').innerText = 'Payment Complete!';
					});
			}
	}, '#paypal-button-container');
</script>



	<div class ="footer" style=" text-align: right">
		<p>About us</p>
		<p>Contact Us</p>
		<p>Shipping & Return</p>
	</div>
</body>
</head>
</html>

	