<?php
$connection = mysqli_connect("192.168.1.33", "illyas", "1234", "esign-packingspec");

if (mysqli_connect_errno()) {
    echo "Database Connection Failed: " . mysqli_connect_error();
}
