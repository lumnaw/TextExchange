<?php
session_start();

$conn = new mysqli("localhost","root","root","Textbook_Exchange");

$name = $_SESSION['Username'];
$bname = $_POST['bookname'];
$subject = $_POST['subject1'];
$first = $_POST['authorfirst'];
$last = $_POST['authorlast'];
$isbn = $_POST['isbn13'];
$edit = $_POST['edition'];
if($_POST['trade'] == 'Yes')
{
	$trading = 1;
}
else
{
	$trading = 0;
}
$pricing = $_POST['price'];
$describe = $_POST['description'];
$available = 1;

if($conn->connect_error)
{
    die("Fail to Connect Database: ". $conn->connect_error);
}

$sql = "INSERT into Book (Name, Subject, AuthorFirst, AuthorLast, ISBN, Edition, SellerID, Trade, Available, Description, Price) values ('$bname', '$subject', '$first', '$last', '$isbn', '$edit', '$name', $trading, $available, '$describe', $pricing)";

if($conn->query($sql) === TRUE)
{
    header('Location: book_catalog.php');
}
else
{
    echo "Error: ". $sql. "<br>" . $conn->error;
}
?>
