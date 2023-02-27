<?php 
session_start();

session_destroy();

header("Location: controlador/index.php");

 ?>