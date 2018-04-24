<?php
session_start();

$name = $_SESSION['Username'];
$bookname = $_SESSION['thebook'];
$bookids= $_SESSION['ids'];
$theid = $bookids[$bookname];

$title = $_POST['bookname'];
$subject = $_POST['subject1'];
$authorfirst = $_POST['authorf'];
$authorlast = $_POST['authorl'];
$isbn = $_POST['isbn13'];
$edition = $_POST['type'];
if($_POST['trade'] == 'Yes')
{
	$status = 1;
}
else
{
	$status = 0;
}
$pricing = $_POST['price'];
$describe = $_POST['description'];

$conn = new mysqli("localhost","root","root","Textbook_Exchange");

if($conn->connect_error)
{
	die("Fail to Connect Database: ". $conn->connect_error);
}

$sql = "UPDATE Book SET Name = '$title', Subject = '$subject', AuthorFirst = '$authorfirst', AuthorLast = '$authorlast', ISBN = '$isbn', Edition = '$edition', Trade = '$status', Description = '$describe', Price = '$pricing' WHERE SellerID = '$name' AND BookID = $theid";


if($conn->query($sql) === TRUE)
{
	header('Location: book_catalog.php');
}
else
{
	echo "Error: ". $sql . "<br>" . $conn->error;
}

?>
