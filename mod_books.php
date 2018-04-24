<?php
session_start();

$conn = new mysqli("localhost","root","root","Textbook_Exchange");

$name = $_SESSION['Username'];
$bookname	 = $_POST['bookname'];

if($conn->connect_error)
{
    die("Fail to Connect Database: ". $conn->connect_error);
}
?>
<html lang="en">
<head>
	<title>User Profile</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
<div class="jumbotron text-center">
  <h2>Books: Add To and Edit Your Book Listings</h2>
</div>

<div class="container">
  <div class="row">
    <div class="col-sm-4">

        <h3>Add A Book</h3>
        <form method="POST" action="add_book.php">
            <label for="Name">Name: </label>
            <input type="text" name="bookname" placeholder="Intro To Calculus II" required/>
            <br>
            <label for="Subject" required/>Subject: </label>
                <select name="subject" id="subject" >
                    <option>Biology</option>
                    <option>Chemistry</option>
                    <option>Coding</option>
                    <option>English</option>
                    <option>Foreign Language</option>
                    <option>History</option>
                    <option>Law</option>
                    <option>Math</option>
                    <option>Physics</option>
                    <option>Other</option>
                </select>
            <br>
            <label for="authorFirst"> Author First Name: </label>
            <input type="text" name="authorfirst" placeholder="Toast" required/>
            <br>
            <label for="authorLast"> Author Last Name: </label>
            <input type="text" name="authorlast" placeholder="Waterman" required/>
            <br>
            <label for="isbn"> ISBN: </label>
            <input type="text" name="isbn" placeholder="ISBN13 only" required/>
            <br>
            <label for="edition"> Author First Name: </label>
            <input type="text" name="edition" placeholder="Toast" required/>
            <br>
            <label for="trade" required/> Trade: </label>
                <select name="trade" id="trade" >
                    <option>Yes</option>
                    <option>No</option>
                </select>
            <br>
            <label for="price"> Price: $</label>
            <input type="number" name="price" min="0" value="0" step="0.01" placeholder="0.00" required/>
            <br>
            <label for="exampleTextarea">Book Description: </label>
            <textarea class="form-control" id="exampleTextarea" rows="10" name="description" placeholder="Please state condition of book along extra information that buyers might like to know (ex: code in back used, etc.)" ></textarea>     
        </form>

    </div>
    <div class="col-sm-4">
      
    </div>
   
    <div class="col-sm-4">
      <h3>Your Current Books</h3>
      <label class="custom-file">
    <?php
        
        $query = "SELECT Name, AuthorFirst, AuthorLast, Subject, Edition, ISBN, Price, Description, Trade FROM Book WHERE SellerID = '$name'";
    
        if(($result=$conn->query($query)) == TRUE)
        {
            if(mysqli_num_rows($result) > 0)
            {
                while($row = mysqli_fetch_array($result, MYSQLI_NUM))
                {
                    if($row[8] == 1)
                    {
                        printf ("Name: %s <br> Author: %s %s <br> Subject: %s <br> Edition: %s <br> ISBN: %s <br> Price: %0.2f <br>  Description: %s<br> Trade: Yes<br><br>", $row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7]);
                    }
                    else
                    {
                        printf ("Name: %s <br> Author: %s %s <br> Subject: %s <br> Edition: %s <br> ISBN: %s <br> Price: %0.2f <br> Description: %s<br> Trade: No<br><br>", $row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7]);
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
      </label>

</div>
</body>
</html>