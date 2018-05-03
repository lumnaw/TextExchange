<?php
session_start();
?>
<html>
<head>
<title>Textbook Exchange Homepage</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="template.css">
</head>
<body>


<div class="header">
 
  <button class="iconbutton" style="margin-right: 20px;" onclick="document.getElementById('id01').style.display='block'"><i class="fa fa-user"></i></button>

      <!--========Login Form=========-->
      <div id="id01" class="modal">
        
        <form id='login' method="POST" class="modal-content animate" action="login.php" charset='UTF-8'>
          <div class="imgcontainer">
               <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
               <img src="user.jpg" alt="Avatar" class="avatar">
          </div>
          <br><br>

          <div class="logincontainer">
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required>

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required>
              
            <input type="submit" name="Submit" style="font-size:20px;" value="Submit"/>
            <input type="checkbox" checked="checked" name="remember"><label>Remember me</label>
          </div>
          <br>

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
                      window.onclick = function(event)
                      { if (event.target == modal) 
                          { modal.style.display = "none";}
                      }
                  </script>


  <h1>Textbook Exchange</h1>
  <p>Students from Standford, UC Berkely, UCLA, SJSU... are using this website.</p>

      <!-- Search Bar-->
      <form class="example" method="POST" action="search_bar.php" style="margin:auto;max-width:1000px">
         <input type="text" placeholder="Start by searching ISBN13 or book title..." name="search2" required>
         <button type="submit"><i class="fa fa-search"></i></button>
      </form><br><br>
</div>
<!--==========Sidecar navigation ===============-->
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

  </form>  <br><br>

<h4>Price Range</h4>
<h5>$0 ~ $110+</h5>
    <form method="POST" action="search_price.php">
  <div class="slidecontainer">
    <input type="range" min="1" max="110" value="50" class="slider" id="myPriceRange" name="Pricing">
    <h5>Price $ <span id="demo1"></span></h5>
    <input type="submit" class="button" value="Search"><br><br><br><br>
  </div>

 
</form>
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
  
<!--================List Grid=====================-->
<div class="main" ><!--Page content, make sure book list stay at the left of sidebar-->
  <!--Button change list or grid-->
<div class="slideshow-container" style="margin-top: 10px;">

<div class="mySlides fade">
  <div class="numbertext">1 / 4</div>
  <img src="slide.png" style="width:100%">
  <div class="text"></div>
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 4</div>
  <img src="slide1.png" style="width:100%">
  <div class="text"></div>
</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 4</div>
  <img src="slide3.png" style="width:100%">
  <div class="text"></div>
</div>

<div class="mySlides fade">
  <div class="numbertext">4 / 4</div>
  <img src="slide4.png" style="width:100%">
  <div class="text"></div>
</div>

</div>
<br>

<div style="text-align:center">
  <span class="dot"></span> 
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
<!--FOOTER-->
<div class ="footer" style=" text-align: right">
    <h6>About us</h6>
    <h6>Contact Us</h6> 
    <h6>FAQ</h6>
  </div>  
  

</body>
</html>