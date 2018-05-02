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
	<title>TE: User Profile</title>
</head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="template.css">
</head>

<div class="header">
    <h1>User Profile</h1>
    <p>Your information is down below.</p>
</div>
    <h4><?php
    if(($result=$conn->query($sql)) == TRUE)
    {
        if(mysqli_num_rows($result) > 0)
        {
            while($row = mysqli_fetch_array($result, MYSQLI_NUM))
            {
                echo"<tr>";
                echo "<td>Username:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$row[0]</td><br>";
                echo "<td>Name:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$row[1]&nbsp;$row[2]</td><br>";
                echo "<td>Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$row[3]</td><br>";
                echo "<td>Phone number:&nbsp;&nbsp;&nbsp;&nbsp;$row[4]</td><br>";
                echo "<td>Address:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$row[5],&nbsp;$row[6], $row[7] $row[8]</td><br>";
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
    </h4>
    <form action="book_catalog.php">
    <button type= "submit" class="button">My Books</button>
    </form>    
    <input type= "button" class="button" value="Back to Home Page" onclick="document.location.href='welcome.php';"/>   

</body>
</html>