<?php
session_start();

$conn = new mysqli("localhost","root","root","Textbook_Exchange");

$name = $_SESSION['Username'];
$bookname = $_POST['books'];
$_SESSION['thebook'] = $bookname;
$bookids= $_SESSION['ids'];


$theid = $bookids[$bookname];
$query = "SELECT AuthorFirst, AuthorLast, Subject, Edition, ISBN, Price, Description, Trade FROM Book WHERE SellerID = '$name' AND Name = '$bookname' AND BookID = $theid";


if($conn->connect_error)
{
    die("Fail to Connect Database: ". $conn->connect_error);
}


if(($result=$conn->query($query)) == TRUE)
{
    if(mysqli_num_rows($result) > 0)
    {
        while($row = mysqli_fetch_array($result, MYSQLI_BOTH))
        {
            $authorfirst = $row[0];
            $authorlast = $row[1];
            $subject = $row[2];
            $edition = $row[3];
            $isbn = $row[4];
            $price = $row[5];
            $describe = $row[6];
            $trade = $row[7];
        }
       $result->close();
    }
    else 
    {
           //no suggestions
    }   
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>TE: Edit A Book</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<div class="jumbotron text-center">
  <h2>~Edit Your Book Listing~</h2>
</div>

<div class="container">
  <div class="row">
    <div class="col-sm-4">
    </div>

    <div class="col-sm-4">
        <?php echo $theid; ?>
      <form method="POST" action=update_book.php>
        <label for="Name" class="custom-file">Name: </label>
        <input type="text" name="bookname" value="<?php echo $bookname; ?>" required/>
        <br>
        <label for="Subject" required/>Subject: </label>
            <select name="subject1" id="subject" >
                <option <?php
                    if($subject == 'Biology')
                    {
                        echo 'selected';
                    }
                ?>>Biology</option>
                <option <?php
                    if($subject == 'Chemistry')
                    {
                        echo 'selected';
                    }
                ?>>Chemistry</option>
                <option <?php
                    if($subject == 'Coding')
                    {
                        echo 'selected';
                    }
                ?>>Coding</option>
                <option <?php
                    if($subject == 'English')
                    {
                        echo 'selected';
                    }
                ?>>English</option>
                <option <?php
                    if($subject == 'Foreign Language')
                    {
                        echo 'selected';
                    }
                ?>>Foreign Language</option>
                <option <?php
                    if($subject == 'History')
                    {
                        echo 'selected';
                    }
                ?>>History</option>
                <option <?php
                    if($subject == 'Law')
                    {
                        echo 'selected';
                    }
                ?>>Law</option>
                <option <?php
                    if($subject == 'Math')
                    {
                        echo 'selected';
                    }
                ?>>Math</option>
                <option <?php
                    if($subject == 'Physics')
                    {
                        echo 'selected';
                    }
                ?>>Physics</option>
                <option <?php
                    if($subject == 'Other')
                    {
                        echo 'selected';
                    }
                ?>>Other</option>
            </select>  
        <br> 
        <label for="author" class="custom-file">Author First: </label>
        <input type="text" name="authorf" value="<?php echo $authorfirst; ?>" required/>
        <br>
        <label for="author" class="custom-file">Author Last: </label>
        <input type="text" name="authorl" value="<?php echo $authorlast; ?>" required/>
        <br>
        <label for="isbn" class="custom-file">ISBN: </label>
        <input type="text" name="isbn13" value="<?php echo $isbn; ?>" required/>
        <br>
        <label for="edition" class="custom-file">Edition: </label>
        <input type="text" name="type" value="<?php echo $edition; ?>" required/>
        <br>
        <label for="trade" class="custom-file">Trade: </label>
        <input type="radio" name="trade" id="Yes" value="Yes" <?php if($trade == 1){ echo "checked= 'checked'"; }?> required/>
        <label for="Yes">Yes</label>
        <input type="radio" name="trade" id="No" value="No" <?php if($trade != 1){ echo "checked= 'checked'"; }?> required/>
        <label for="No">No</label>
        <br>
        <label for="price"> Price: $</label>
        <input type="number" name="price" min="0.00" value="<?php echo $price ?>" step="0.01" required/>
        <br>
        <label for="above" class="custom-file">Description: </label>
        <input class="form-control" name="description" cols="50" value="<?php echo $describe; ?>" required/>
        <br>
        <input type="submit" name="submit" value="Enter Changes"/> 
        
      </form>
      <br>
    </div>


    <div class="col-sm-4">
	</div>
</body>
<html>