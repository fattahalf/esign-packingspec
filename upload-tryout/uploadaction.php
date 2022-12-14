<!DOCTYPE html>
<html>

<head>
    <title>Membuat Upload File Dengan PHP Dan MySQL | www.malasngoding.com</title>
</head>

<body>
    <h1>Membuat Upload File Dengan PHP Dan MySQL <br /> www.malasngoding.com</h1>
    <?php
    include 'dbconnect.php';
    if ($_POST['upload']) {
        //extention allowed
        $allowed_extension = array('jpeg', 'jpg');

        //store file name to variable
        $file_name = $_FILES['file']['name'];

        //break a string into an array
        $x = explode('.', $file_name);

        /*pick extension type
        strtolower : convert string to lowercase
        end: mmemberikan nilai terakhir dalam sebuah array (untuk mengambil extension)*/
        $extension = strtolower(end($x));
        $file_size    = $_FILES['file']['size'];
        $file_tmp = $_FILES['file']['tmp_name'];

        /*melakukan seleksi ekstensi file
        in_array: mencari nilai dari sebuar array*/
        if (in_array($extension, $allowed_extension) === true) {
            //melakukan seleksi ukuran file
            if ($file_size < 1044070) {
                move_uploaded_file($file_tmp, 'packing-spec\1' . $file_name);
                $query = mysqli_query($connection, "INSERT INTO files VALUES(NULL, '$file_name')");
                if ($query) {
                    echo 'FILE BERHASIL DI UPLOAD';
                } else {
                    echo 'GAGAL MENGUPLOAD GAMBAR';
                }
            } else {
                echo 'UKURAN FILE TERLALU BESAR';
            }
        } else {
            echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
        }
    }
    ?>

    <br />
    <br />
    <a href="index.php">Upload Lagi</a>
    <br />
    <br />

    <table>
        <?php
        $data = mysqli_query($connection, "SELECT * FROM files");
        while ($d = mysqli_fetch_array($data)) {
        ?>
            <tr>
                <td>
                    <img src="<?php echo "file/" . $d['filename']; ?>">
                </td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>