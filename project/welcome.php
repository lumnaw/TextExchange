<?php
session_start();
$user = $_SESSION["Username"];

?>
<html>
<head>
<title>TE: Welcome Back!</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="template.css">
</head>
<body>

<div class="header">
  <form action="logout.php">
    <button class="iconbutton"><i class="fa fa-sign-out"></i></button>
  </form>
  <form action="cart.php"><!--Insert link to shopping cart -->
    <button class="iconbutton"><i class="fa fa-shopping-cart"></i></button>
  </form>
  <form action="userprofile.php">
    <button  class="iconbutton" onclick="document.getElementById('id01').style.display='block'"><i class="fa fa-user"></i></button>
  </form>


  <h1>Textbook Exchange</h1>
  <p>Students from Standford, UC Berkeley, UCLA, SJSU... are using this website.</p>

      <!-- Search Bar-->
      <form class="example" method="POST" action="search_bar.php" style="margin:auto;max-width:1000px">
         <input type="text" placeholder="Start by searching ISBN13 or book title..." name="search2" required>
         <button type="submit"><i class="fa fa-search"></i></button>
      </form><br><br>
</div>


<!--==========Sidebar navigation ===============-->
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

  </form><br><br>

<h4>Price Range</h4>
<h5>$0 ~ $110+</h5>
  
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
  

<!--================List Grid=====================-->
<div class="main" ><!--Page content, make sure book list stay at the left of sidebar-->
  <!--Button change list or grid-->

<div class="slideshow-container" style="margin-top: 10px;">

<div class="mySlides fade">
  <div class="numbertext">1 / 4</div>
  <img src="welcome.jpg" style="width:100%">
  <div class="text"></div>
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 4</div>
  <img src="slide1.png" style="width:100%">
  <div class="text"></div>
</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 4</div>
  <img src="slide2.png" style="width:100%">
  <div class="text"></div>
</div>

<div class="mySlides fade">
  <div class="numbertext">4 / 4</div>
  <img src="slide3.png" style="width:100%">
  <div class="text"></div>
</div>

</div>
<br>

<div style="text-align:center">
  <span class="dot"></span> 
  <span class="dot"></span> 
  <span class="dot"></span> 
  <br><br>
</div>
  <script>
var slideIndex = 0;
showSlides();

function showSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    for (i = 0; i < slides.length; i++) {
       slides[i].style.display = "none";  
    }
    slideIndex++;
    if (slideIndex > slides.length) {slideIndex = 1}    
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";  
    dots[slideIndex-1].className += " active";
    setTimeout(showSlides, 5000); // Change image every 5 seconds
}
</script>
</div>
<!--==================FOOTER========================-->
<div class ="footer" style=" text-align: right">
    <h6>About us</h6>
    <h6>Contact Us</h6> 
    <h6>FAQ</h6>
  </div>  

</body>
</html>

