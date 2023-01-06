<?php
    $image1 = 'sandbox\BMKF56580000.jpg';
    $image2 = 'sandbox\XJ55075.jpg';

    list($width, $height) = getimagesize($image1);

    $image1 = imagecreatefromstring(file_get_contents($image1));
    $image2 = imagecreatefromstring(file_get_contents($image2));

    imagecopymerge($image1, $image2, 104, 160, 0, 0, $width, $height, 100);
    header('Content-Type: image/jpg');

    imagejpg($image1, merged.jpg);
?>