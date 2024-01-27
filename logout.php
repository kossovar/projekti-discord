<?php
// fillon sessionin
session_start();

// e shkaterron sessionin dhe variablat e session
session_destroy();

// redirect perseri ne homepage
header("location: index.php");
exit();
