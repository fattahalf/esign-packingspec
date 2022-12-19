<?php
    include 'dbconnect.php';
    session_start();
    if(isset($_POST['submit_image'])) {
        $username = $_SESSION['username'];
        $allowed_extensiion = array('jpeg', 'jpg');
        $file_name = $_FILES['upload_file']['name'];
        $file_size = $_FILES['upload_file']['size'];
        $file_temp = $_FILES['upload_file']['tmp_name'];
        for($i = 0; $i < count($_FILES["upload_file"]["name"]); $i++) {
            $temp_x = explode('.', $file_name[$i]);
            $extension = strtolower(end($temp_x));
            if(in_array($extension, $allowed_extensiion) == true) {
                move_uploaded_file($file_temp[$i], 'packing-spec/1/'. $username .'/'. $file_name[$i]);
                $query = mysqli_query($connection, "INSERT INTO files VALUES(NULL, '$file_name[$i]','$username')");
            } 
        }
    }
    exit();
?>  