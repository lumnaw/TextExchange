<?php

session_start();
unset($_SESSION["uname"]);
header("Location: logout_success.html");


?>
