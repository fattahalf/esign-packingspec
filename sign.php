<?php
session_start();
$sources = "packing-spec/under-approval/".$_GET['sources'];
$signatures = "signature/".$_SESSION['username'].".png";
$mr = $_SESSION['mr'];
$mb = $_SESSION['mb'];
$source = $sources; //namefile.jpg
$watermark = imagecreatefrompng($signatures); //ttd.png
$margin_right = $mr; //10
$margin_bottom = $mb; //10
$sx = imagesx($watermark);
$sy = imagesy($watermark);
$img = imagecreatefromjpeg($source);
imagecopy($img, $watermark, imagesx($img) - $sx - $margin_right, imagesy($img) - $sy - $margin_bottom, 0, 0, $sx, $sy);
$i = imagejpeg($img, $source, 100);
imagedestroy($img);

header("location:approve.php");
?>