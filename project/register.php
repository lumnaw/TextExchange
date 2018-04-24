<?php
session_start();

$id = $_POST["T1"];
$firstname = $_POST["T2"];
$lastname = $_POST["T3"];
$email = $_POST["T4"];
$phone = $_POST["T5"];
$pw = $_POST["T6"];
$address = $_POST["T7"];
$city = $_POST["T8"];
$state = $_POST["T9"];
$zip = $_POST["T10"];

$conn = new mysqli("localhost","root","root","Textbook_Exchange");

if($conn->connect_error)
{
	die("Fail to Connect Database: ". $conn->connect_error);
}

//echo "Host information: " . mysqli_get_host_info($conn) . PHP_EOL;//Feel free to delete this line, after testing.

$sqlStr = "insert into Account (Username,FirstName,LastName,Email,PhoneNum,Password,AddressName,City,State,Zip) ";

$sqlStr .= "values('$id','$firstname','$lastname','$email',$phone,'$pw','$address','$city','$state','$zip')";

//echo $sqlStr."<br>";

if($conn->query($sqlStr) === TRUE)
{
	$_SESSION["Username"] = $id;
	header('Location: welcome.html');
}
else
{
	echo "Error: ". $sqlStr . "<br>" . $conn->error;
}

?>

