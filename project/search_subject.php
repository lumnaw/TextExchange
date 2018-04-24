<?php

$conn = new mysqli("localhost","root","root","Textbook_Exchange");

if($conn->connect_error)
{
	die("Fail to Connect Database: ". $conn->connect_error);
}

//echo "Host information: " . mysqli_get_host_info($conn) . PHP_EOL;//Feel free to delete this line, after testing.

$query = "SELECT Name, AuthorFirst, AuthorLast, Subject, Edition, ISBN, Price, SellerID, Description, Trade FROM Book WHERE Available = 1";
$where_clause = "";
$first = TRUE;
$empty = FALSE;
$variable=$_POST["subject"];

if(empty($variable))
{
	$empty = TRUE;
	echo "Query is empty. Returning search by groups.". "<br><br>";
}
else
{
	foreach ($_POST["subject"] as $variable) {
		if($first)
		{
			$first = false;
			$where_clause .= " AND (Subject = '$variable' ";
			
		}
		else
		{
			$where_clause .= " OR Subject = '$variable' ";
		}
	}
}

if(!$empty)
{
	$query .= $where_clause . ")";

}
else
{
	$query .= " GROUP BY Subject";
}


//print starts here
if(($result=$conn->query($query)) == TRUE)
{
    if(mysqli_num_rows($result) > 0)
    {
    	while($row = mysqli_fetch_array($result, MYSQLI_NUM))
    	{//prints out the book information
    		if($row[9] == 1) //row 9 is the check for trade availability, do not change
    		{//trade:yes
    			printf ("Name: %s <br> Author: %s %s <br> Subject: %s <br> Edition: %s <br> ISBN: %s <br> Price: %0.2f <br> Seller: %s <br> Description: %s<br> Trade: Yes<br><br>", $row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8]);
    		}
    		else
    		{
    			printf ("Name: %s <br> Author: %s %s <br> Subject: %s <br> Edition: %s <br> ISBN: %s <br> Price: %0.2f <br> Seller: %s <br> Description: %s<br> Trade: No<br><br>", $row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8]);
    		}
        	
    	}
        $result->close();
    }
    else if(mysqli_num_rows($result) == 0)
    {
    	echo "There are no results for: <br>";
    	echo $query. "<br>" . $conn->error;
    }
}
else
{
    echo "Error: ". $query . "<br>" . $conn->error;
}


?>
