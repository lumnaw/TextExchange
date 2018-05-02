<?php
session_start();
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
?>

<html>
<head>
    <title>Search by Subject</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="template.css">

</head>

<body>  
<div class="header">
    <h3 style="float:right;">Go Back to Home Page</h3>
    <button class="iconbutton" onclick="location.href = <?php 
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
      ?> "><i class="fa fa-arrow-left"></i></a></button>
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
    
    <div class="slidecontainer">
      <input type="range" min="1" max="110" value="50" class="slider" id="myPriceRange">
      <h5>Price $ <span id="demo1"></span></h5>
    </div>

   <input type="button" class="button" value="Search"><br><br>
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

<!-- Book List-->
<div style="margin-left: 250px; margin-top: 15px;"><?php
    //print starts here
    if(($result=$conn->query($query)) == TRUE)
    {
        if(mysqli_num_rows($result) > 0)
        {
        	while($row = mysqli_fetch_array($result, MYSQLI_NUM))
        	{
                 ?><img src="nobook.jpg" class="image" alt="Book" style="width:125px; position: absolute; float: left; margin-left: 10px;"><input style="float:right; margin-right: 50px;" type="submit" class="button" value="Add to Cart"><h7><?php
                //prints out the book information
        		if($row[9] == 1) //row 9 is the check for trade availability, do not change
        		{//trade:yes
        			printf ("<b>Book Name: %s </b><br> Author: %s %s <br> Subject: %s <br> Edition: %s <br> ISBN: %s <br> Price: $ %0.2f <br> Seller: %s <br> Description: %s<br> Trade: Yes<br>", $row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8]);
                    ?></h7><hr><?php
        		}
        		else
        		{
        			printf ("<b>Book Name: %s </b><br> Author: %s %s <br> Subject: %s <br> Edition: %s <br> ISBN: %s <br> Price: $ %0.2f <br> Seller: %s <br> Description: %s<br> Trade: No<br>", $row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8]);
                    ?></h7><hr><?php
        		}
            	
        	}
            $result->close();
        }
        else if(mysqli_num_rows($result) == 0)
        {
            echo "<br>";
        	echo "Sorry, there is no matching results. Please try again. <br>";
        
        }
    }
    else
    {
        echo "Error: ". $query . "<br>" . $conn->error;
    }
    ?></h7></div>

</body>
</html>


