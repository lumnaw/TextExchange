<?php 

$uname = trim($_POST["uname"]);
echo $uname."<br>";
$password = trim($_POST["psw"]);
echo $password."<br>";

$conn = new mysqli("localhost","root","root","Textbook_Exchange");

if($conn->connect_error)
{
    die("Fail to Connect Database: ". $conn->connect_error);
}

$sql = "Select Username, Password from Account where Username = '$uname' and Password = '$password' ";
 
if(($result=$conn->query($sql)) == TRUE)
{
    if(mysqli_num_rows($result) > 0)
    {
        session_start();
        $_SESSION["Username"] = $uname;
        $_SESSION["Password"] = $password;
        header('Location: index.html');
    }
}
else
{
    echo "Error: ". $sql . "<br>". $conn->error;
}


?>