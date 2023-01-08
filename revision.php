<?php
include 'dbconnect.php';
session_start();
$revision = $_GET['revision'];
$from = $_SESSION['name'];
$id= $_GET['idfile'];
mysqli_query($connection,"UPDATE files SET revise_note = '$revision', revise_from = '$from' WHERE id=$id;");
header("location:approve.php");
?>