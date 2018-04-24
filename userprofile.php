<?php 
session_start();

$conn = new mysqli("localhost","root","root","Textbook_Exchange");

$name = $_SESSION['Username'];

if($conn->connect_error)
{
    die("Fail to Connect Database: ". $conn->connect_error);
}

$sql = "Select Username, FirstName, LastName, Email, PhoneNum, AddressName, City, State, Zip from Account where Username = '$name'";
 



?>

<html>
<head>
	<title>User Profile</title>
</head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="homeDesign.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<body>
<div class="container">
  <img src="book.jpg" alt="book" style="width:100%;">
  <div class="content">
    <h3><?php
    if(($result=$conn->query($sql)) == TRUE)
    {
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result, MYSQLI_NUM))
            {
                echo"<tr>";
                echo "<td>Username:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$row[0]</td><br>";
                echo "<td>Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$row[1]&nbsp;$row[2]</td><br>";
                echo "<td>Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$row[3]</td><br>";
                echo "<td>Phone number: $row[4]</td><br>";
                echo "<td>Address:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $row[5] <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$row[6], $row[7] $row[8]</td><br>";
            }
            $result->close();
        }
        else if(mysqli_num_rows($result) == 0)
        {
            echo "There are no results for: <br>";
            echo $sql. "<br>" . $conn->error;
        }
    }
    ?>
    </h3>
    <form action="book_catalog.php">
    <button type= "submit" class="shopbtn">My Books</button>
    </form>
    
  </div>
</div>
</body>
</html>