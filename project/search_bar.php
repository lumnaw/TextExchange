<?php

$conn = new mysqli("localhost","root","root","Textbook_Exchange");

if($conn->connect_error)
{
	die("Fail to Connect Database: ". $conn->connect_error);
}

//echo "Host information: " . mysqli_get_host_info($conn) . PHP_EOL;//Feel free to delete this line, after testing.

$query = "SELECT Name, AuthorFirst, AuthorLast, Subject, Edition, ISBN, Price, SellerID, Description, Trade FROM Book WHERE Available = 1";
$search=$_POST["search2"];

if(is_numeric($search))
{
	$query .= " AND ISBN = '$search'";
}
else
{
	$query .= " AND Name LIKE '%$search%'";
}


//print out
if(($result=$conn->query($query)) == TRUE)
{
    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_array($result, MYSQLI_NUM))
        {
            if($row[9] == 1)//this checks if the book is up for trade or not
            {//prints the information of the books(trade:yes)
                printf ("Name: %s <br> Author: %s %s <br> Subject: %s <br> Edition: %s <br> ISBN: %s <br> Price: %0.2f <br> Seller: %s <br> Description: %s<br> Trade: Yes<br><br>", $row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8]);
            }
            else
            {//trade:no
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

