<?php
session_start();
require 'item.php';
$conn = new mysqli("localhost","root","root","Textbook_Exchange");

$name = $_SESSION['Username'];

echo $name;

if($conn->connect_error)
{
    die("Fail to Connect Database: ". $conn->connect_error);
}
if(isset($_GET['book']))
{
	$booksid = $_GET['book'];
	$query2 = "DELETE FROM Book WHERE BookID = '";
	$query2 .= $booksid;
	$query2 .= "'";
	$result1 = mysqli_query($conn, $query2);
	$product = mysqli_fetch_object($result1);

}

if($conn->query($query2) === TRUE)
{
    header('Location: cart.php?index=0');
}
else
{
    echo "Error: ". $query2. "<br>" . $conn->error;
}

?>
