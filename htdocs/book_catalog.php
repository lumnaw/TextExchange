<?php 
session_start();

$conn = new mysqli("localhost","root","root","Textbook_Exchange");

$name = $_SESSION['Username'];

if($conn->connect_error)
{
    die("Fail to Connect Database: ". $conn->connect_error);
}

?>

<html lang="en">
<head>
	<title>TE: My Books</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="template.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
	<div class="header">

  <h2>Books: Add To and Edit Your Book Listings</h2>
  <h3><input class= "button" value="Back to User Profile" onclick="document.location.href='userprofile.php';"/></h3>
</div>

<div class="container">
  <div class="row">
    <div class="col-sm-4">

        <h3 style="color:black;">Add A Book</h3>
        <form method="POST" action="add_book.php">
            <label for="Name">Name: </label>
            <input type="text" name="bookname" placeholder="Intro To Calculus II" required/>
            <br>
            <label for="Subject" required/>Subject: </label>
                <select name="subject1" id="subject" >
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
            <input type="text" name="isbn13" placeholder="ISBN13 only" required/>
            <br>
            <label for="edition"> Edition: </label>
            <input type="text" name="edition" placeholder="12th Edition" required/>
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
            <textarea class="form-control" id="exampleTextarea" rows="10" name="description" placeholder="Please state condition of book along extra information that buyers might like to know (ex: Homework code in back is not used, etc.)" ></textarea>
            <input type="submit" name="submit" value="Add Book"/>     
        </form>

    </div>
    <div class="col-sm-4">
      <h3 style="color:black;"">Remove a Book</h3>
      <form method="POST" action="remove_book.php">
        <label for="trade" class="custom-file"></label>
            <select name="books" id="books">
                    <?php
                        $sql1 = "SELECT Name, BookID FROM Book WHERE SellerID = '$name'";
                        if(($result1=$conn->query($sql1)) == TRUE)
                        {
                            if(mysqli_num_rows($result1) > 0)
                            {
                                while($row = mysqli_fetch_array($result1, MYSQLI_NUM))
                                {
                                    ?><option> <?php echo $row[0]; ?> </option> 
                                    <?php 
                                }
                                $result1->close();
                            }   
                        }
                    ?>
            </select>
        <input type="submit" name="submit" value="Go"/> 
      </form>
      <br>
      <h3 style="color:black;"">Edit a Book</h3>
      <form method="POST" action="edit_book.php">
        <label for="trade" class="custom-file"></label>
            <select name="books" id="books">
                    <?php
                        $sql2 = "SELECT Name, BookID FROM Book WHERE SellerID = '$name'";
                        $a = array();
                        $b = array();
                        if(($result2=$conn->query($sql2)) == TRUE)
                        {
                            if(mysqli_num_rows($result2) > 0)
                            {
                                while($row = mysqli_fetch_array($result2, MYSQLI_NUM))
                                {
                                    ?><option name="bookname"> 
                                        <?php echo $row[0];
                                            array_push($a, $row[0]);
                                            array_push($b, $row[1]);
                                        ?> </option> 
                                        <?php 
                                }
                                $result2->close();
                            }   
                        }
                    ?>
            </select>
        <?php
            $bookids = array_combine($a, $b);
            $_SESSION['ids'] = $bookids;
        ?>
        <input type="submit" name="submit" value="Go"/> 
      </form>
    </div>
      
   
    <div class="col-sm-4">
      <h3 style="color:black;"">Your Current Books</h3>
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