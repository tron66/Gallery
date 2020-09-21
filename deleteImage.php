<?php
include_once 'gallery_php/db.php';
$_SESSION['username'] = "Admin";

$newFilename = $_POST['filename'];
if (empty($newFilename)) {
  $newFilename = "gallery";
}else {
  $newFilename = strtolower(str_replace(" ", "-", $newFilename));
}

$filename = "img/gallery/".$newFilename.".".uniqid("", true)."."."*";
$fileinfo = glob($filename);
$fileext = explode(".", $fileinfo[0]);
$fileactualext = $fileext[1];

$file = "img/gallery/".$newFilename.".".uniqid("", true).".".$fileactualext; // entire file name

if (!unlink($file)) {
  echo "You have an error";
}else {
  header("Location: index.php?deletesuccess");
}

 ?>
