<?php
session_name('food4u');
session_start();
session_destroy();
header("location: index.php");
?>