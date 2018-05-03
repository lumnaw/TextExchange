<?php

session_start();
unset($_SESSION["Username"]);
header("Location: logout_success.php");


?>
