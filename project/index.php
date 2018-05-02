<?php
session_start();
?>
<html>
<head>
<title>TE.com</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="homeDesign.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<!-- Sidebar Multiple Checkbox-->
<script type="text/javascript">
function getCheckedCheckboxesFor(checkboxName) {
    var checkboxes = document.querySelectorAll('input[name="' + checkboxName + '"]:checked'), values = [];
    Array.prototype.forEach.call(checkboxes, function(el) {
        values.push(el.value);
    });
    return values;
}
</script>
</head>


<body>

<!--==========Sidecar navigation ===============-->
<div class="sidenav">
  <h2>TE.com</h2>
  
   <!-- Search Bar-->
  <form class="example" method="POST" action="search_bar.php" style="margin:auto;max-width:300px">
     <input type="text" placeholder="Search ISBN13 or title..." name="search2" required>
     <button type="submit"><i class="fa fa-search"></i></button>

  </form><br>
  
  <div class="data">    
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

  </form>  

<h4>Price Range<br>
$0 ~ $110+</h4>
  
<div class="slidecontainer">
  <form method="POST" action="search_price.php">

  <input type="range" min="1" max="110" value="50" class="slider" id="myPriceRange" name="Pricing">
  <h5>Price $ <span id="demo1"></span></h5>
</div>

 <input type="submit" class="button" value="Search"><br><br><br><br>
</form>


<script>
var slider = document.getElementById("myPriceRange");
var output = document.getElementById("demo1");
output.innerHTML = slider.value;

slider.oninput = function() {
  output.innerHTML = this.value;
}
</script>
   
    </div>
  </div>
  

<!-- Page content -->
<div class="main">
<body>

<!--===============Header & Icon=================-->
  
    <p style="font-size: 40px;">Textbook Exchange
    <button class="iconbutton"><i class="fa fa-shopping-cart"></i></button>
    <button  class="iconbutton" onclick="document.getElementById('id01').style.display='block'"><i class="fa fa-user"></i></button>
  </p>
<!--========Login Form=========-->
<div id="id01" class="modal">
  
  <form id='login' method="POST" class="modal-content animate" action="login.php"
        charset='UTF-8'>
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="user.jpg" alt="Avatar" class="avatar">
    </div>

    <div class="logincontainer">
      <label for="uname"><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>
        
      <input type="submit" name="Submit" style="font-size:20px;" value="Submit"/>
      <input type="checkbox" checked="checked" name="remember"><label>Remember me</label>
    </div>

    <div class="logincontainer" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="register">Not A Member? <a href="Registration Forms.html"><b>Register</b></a></span>
    </div>
  </form>
</div>
<!-- Login JS-->
<script>
// Get the modal
var modal = document.getElementById('id01');
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

<!--==============Image header===================== -->
<div class="container">
  <img src="book.jpg" alt="book" style="width:100%;">
  <div class="content">
    <h3>We Know What You Need</h1>
    <h3>Over 1000+ Users are using TE.com</h3>
    <button class="shopbtn">SHOP NOW</button>
  </div>
</div>

<br><br>
<hr>

<!--==============Book Gallery====================-->
<div class="row">
  <div class="column">
    <div class="bookcontent">
     <div class="buycontainer">
      <img src="biology.jpg" class="image" alt="Biology" style="width:100%">
      <div class="middle">
      <button class="buybtn"><a href="law.html">Buy Now</a></button>
     </div>
    </div>
      <h5>Biology</h5>
      <p>$50.99 or Exchange</p>
    </div>
  </div>
  <div class="column">
    <div class="bookcontent">
      <div class="buycontainer">
    <img src="History.jpg" class="image" alt="History" style="width:100%">
      <div class="middle">
      <button class="buybtn"><a href="law.html">Buy Now</a></button>
     </div>
    </div>
      <h5>World History</h5>
      <p>$20.99 or Exchange</p>
    </div>
  </div>
  
  <div class="column">
    <div class="bookcontent">
     <div class="buycontainer">
    <img src="chemistry.jpg" class="image" alt="Chemistry" style="width:100%">
      <div class="middle">
      <button class="buybtn"><a href="law.html">Buy Now</a></button>
     </div>
    </div>
      <h5>Chemistry</h5>
      <p>$40.99 or Exchange</p>
    </div>
  </div>
  
  <div class="column">
    <div class="bookcontent">
     <div class="buycontainer">
     <img src="literature.jpg" class="image" alt="Literature" style="width:100%">
    <div class="middle">
      <button class="buybtn"><a href="law.html">Buy Now</a></button>
     </div>
    </div>
      <h5>Literature</h5>
      <p>$10.00 or Exchange</p>
    </div>
  </div>



</div>
<!--FOOTER-->
<div class ="footer" style=" text-align: right">
    <p>About us</p>
    <p>Contact Us</p> 
    <p>Shipping & Return</p>
  </div><!-- Page Content END-->


</body>
</html>
