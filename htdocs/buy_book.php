<?php
session_start();
require 'item.php';
require 'account.php';
$conn = new mysqli("localhost","root","root","Textbook_Exchange");

$name = $_SESSION['Username'];

if($conn->connect_error)
{
    die("Fail to Connect Database: ". $conn->connect_error);
}
if(isset($_GET['book']))
{
	$booksid = $_GET['book'];
	
	$query0 = "SELECT * from Book where BookID = '";
	$query0 .= $booksid;
	$query0 .= "'";
	$result = mysqli_query($conn, $query0);
	$product = mysqli_fetch_object($result);
	$item = new Item();
	$item->Name = $product->Name;

	$query2 = "DELETE FROM Book WHERE BookID = '";
	$query2 .= $booksid;
	$query2 .= "'";

}


if(isset($_GET['id']))
{
	$seller = $_GET['id'];
	$query1 = "INSERT into Transactions (Name, SellerID, BuyerID) values ('$item->Name', '$seller', '$name')";
}


if($conn->query($query1) == TRUE)
{
	if($conn->query($query2) === TRUE)
	{
		header('Location: cart.php?index=0');
	}
	else
	{
		echo "Error: ". $query2. "<br>" . $conn->error;
	}
}
else
{
		echo "Error: ". $query1. "<br>" . $conn->error;
}


?>
