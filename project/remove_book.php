<?php
session_start();

$conn = new mysqli("localhost","root","root","Textbook_Exchange");

$name = $_SESSION['Username'];
$bookname = $_POST['books'];

echo $name;
echo $bookname;

if($conn->connect_error)
{
    die("Fail to Connect Database: ". $conn->connect_error);
}

$sql = "DELETE FROM Book WHERE SellerID = '$name' AND Name = '$bookname'";

if($conn->query($sql) === TRUE)
{
    header('Location: book_catalog.php');
}
else
{
    echo "Error: ". $sql. "<br>" . $conn->error;
}
?>
