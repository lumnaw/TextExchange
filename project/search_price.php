<?php

$conn = new mysqli("localhost","root","root","Textbook_Exchange");

if($conn->connect_error)
{
	die("Fail to Connect Database: ". $conn->connect_error);
}

//echo "Host information: " . mysqli_get_host_info($conn) . PHP_EOL;//Feel free to delete this line, after testing.

$query = "SELECT Name, Subject, Price FROM Book WHERE Available = 1 AND (";
$where_clause = "";
$first = TRUE;
$variable=$_POST["subject"];

if(empty($variable))
{
	echo("It's empty.");
}
else
{
	foreach ($_POST["subject"] as $variable) {
		if($first)
		{
			$first = false;
			$where_clause .= "Subject = $variable";
			
		}
		else
		{
			$where_clause .= " OR Subject = $variable";
		}
	}
	echo $where_clause,"<br>";
}

$query .= $where_clause . ")";

echo $query."<br>";

if(($result=$conn->query($sql)) == TRUE)
{
    if(mysqli_num_rows($result) > 0)
    {
        
        header('Location: index.html');
    }
    else
    {
    	echo "Error: ". $conn->error;
    }
}
else
{
    echo "Error: ". $query . "<br>". $conn->error;
}


?>
