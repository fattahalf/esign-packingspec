<?php
$connection = mysqli_connect("localhost", "root", "", "esign-packingspec");

if (mysqli_connect_errno()) {
    echo "Database Connection Failed: " . mysqli_connect_error();
}
