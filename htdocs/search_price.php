<?php
session_start();
$user=$_SESSION['Username'];
$conn = new mysqli("localhost","root","root","Textbook_Exchange");

if($conn->connect_error)
{
	die("Fail to Connect Database: ". $conn->connect_error);
}

//echo "Host information: " . mysqli_get_host_info($conn) . PHP_EOL;//Feel free to delete this line, after testing.

$query = "SELECT * FROM Book WHERE Available = 1";

$variable=$_POST["Pricing"];

if(is_numeric($variable) && ($variable < 110))
{
    $query .= " AND Price <= '$variable'";
    $query .= " ORDER BY Price";
}
else
{
    $query .= " ORDER BY Price";
}
?>


<html>
<head>
    <title>TE: Search by Price Range</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="template.css">

</head>

<body>  
<div class="header"> 
    <!--Go back button-->
    <input type= "button" style="float:right; margin-right: 40px; margin-top: 20px;font-size: 18px;"class="button" value="Back to Home Page" onclick="location.href = <?php 
      if(!isset($_SESSION['Username'])) {
        echo "'index.php'";
      }
      else
      {
        echo "'welcome.php'";
      }?>">
      <a href =  <?php  
      if(!isset($_SESSION['Username'])) {
        echo "'index.php'";
      }
      else
      {
        echo "'welcome.php'";
      }
      ?> "></a></input>
    <h1>Search Results by Subjects</h1>
     
     <!-- Search Bar-->
      <form class="example" method="POST" action="search_bar.php" style="margin:auto;max-width:1000px">
         <input type="text" placeholder="Search ISBN13 or title..." name="search2" required>
         <button type="submit"><i class="fa fa-search"></i></button>
      </form><br><br>
</div>
<!--================Sidebar navigation ======================-->
<div class="sidenav">
      
  <h4>Subject</h4>

  <form method="POST" action="search_subject.php">

      <span><input type="checkbox" name="subject[]" value="Biology"/>
        <label for="subject">Biology</label><br></span>    
      <span><input type="checkbox" name="subject[]" value="Chemistry"/>
        <label for="subject">Chemistry</label><br></span> 
      <span><input type="checkbox" name="subject[]" value="Coding"/>
        <label for="subject">Coding</label><br></span>
      <span><input type="checkbox" name="subject[]" value="English"/>
        <label for="subject">English</label><br></span>  
      <span><input type="checkbox" name="subject[]" value="Foreign Language"/>
        <label for="subject">Foreign Language</label><br></span>
      <span><input type="checkbox" name="subject[]" value="History"/>
        <label for="subject">History</label><br></span>
      <span><input type="checkbox" name="subject[]" value="Law"/>
        <label for="subject">Law</label><br></span>
      <span><input type="checkbox" name="subject[]" value="Math"/>
        <label for="subject">Math</label><br></span>
      <span><input type="checkbox" name="subject[]" value="Physics"/>
        <label for="subject">Physics</label><br></span>
      <span><input type="checkbox" name="subject[]" value="Other"/>
        <label for="subject">Other</label><br><br></span>

      <input type="submit" class="button" value="Search">
  </form><br><hr>

  <h4>Price Range</h4>
  <h5>$0 ~ $110+</h5>
    <form method="POST" action="search_price.php">
    <div class="slidecontainer">
      <input type="range" min="1" max="110" value="50" class="slider" id="myPriceRange" name="Pricing">
      <h5>Price $ <span id="demo1"></span></h5>
      <input type="submit" class="button" value="Search"><br><br>
    </form>
    </div>
   <hr>

      <script>
      var slider = document.getElementById("myPriceRange");
      var output = document.getElementById("demo1");
      output.innerHTML = slider.value;
      slider.oninput = function() {
        output.innerHTML = this.value;
      }
      </script>

</div>

<div style="margin-left: 250px; margin-top: 15px;"><?php

//print starts here
if(($result=$conn->query($query)) == TRUE)
{
    if(mysqli_num_rows($result) > 0)
    {
    	while($product = mysqli_fetch_object($result))
            {
                //prints out the book information
                if(($product->Trade == 1) && ($user != $product->SellerID)) //row 9 is the check for trade availability, do not change
                {//trade:yes?>
              <img src="nobook.jpg" class="image" alt="Book" style="width:125px; position: absolute; float: left; margin-left: 10px;">
                <a href = " cart.php?id=<?php echo $product->BookID;?>"><input style="float:right; margin-right: 20px;"type="submit" class="button" value="Add to shopping Cart"></a><h7><?php
                    printf ("<b>Book Name: %s </b><br> Author: %s %s <br> Subject: %s <br> Edition: %s <br> ISBN: %s <br> Price: $ %0.2f <br> Seller: %s <br> Description: %s<br> Trade: Yes<br>", $product->Name, $product->AuthorFirst, $product->AuthorLast, $product->Subject, $product->Edition, $product->ISBN, $product->Price, $product->SellerID, $product->Description);
                    ?></h7><hr><?php
                }
                else if($user != $product->SellerID)
                {?>
              <img src="nobook.jpg" class="image" alt="Book" style="width:125px; position: absolute; float: left; margin-left: 10px;">
                <a href = " cart.php?id=<?php echo $product->BookID;?>"><input style="float:right; margin-right: 20px;"type="submit" class="button" value="Add to shopping Cart"></a><h7><?php
                    printf ("<b>Book Name: %s </b><br> Author: %s %s <br> Subject: %s <br> Edition: %s <br> ISBN: %s <br> Price: $ %0.2f <br> Seller: %s <br> Description: %s<br> Trade: No<br>", $product->Name, $product->AuthorFirst, $product->AuthorLast, $product->Subject, $product->Edition, $product->ISBN, $product->Price, $product->SellerID, $product->Description);
                    ?></h7><hr><?php
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
}?></h7></div>
</body>
</html>



