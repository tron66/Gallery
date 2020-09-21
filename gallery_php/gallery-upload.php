<?php


if (isset($_POST['submit'])) {

  include_once 'db.php';

  $newFilename = $_POST['filename'];
  if (empty($newFilename)) {
    $newFilename = "gallery";
  }else {
    $newFilename = strtolower(str_replace(" ", "-", $newFilename));
  }
  $imageTitle = $_POST['filetitle'];
  $imageDesc = $_POST['filedesc'];

  $file = $_FILES['file'];

  $fileName = $file['name'];
  $fileTmpName = $file['tmp_name'];
  $fileSize = $file['size'];
  $fileError = $file['error'];
  $fileType = $file['type'];

  $fileExt = explode('.', $fileName);
  $fileActualExt = strtolower(end($fileExt));

  //files allowed to upload
  $allowed = array('jpg','jpeg','png','pdf');
  //chech if the file has the proper extensions
  if (in_array($fileActualExt, $allowed)) {
    if ($fileError === 0) {
      if ($fileSize < 1000000) {
        $imageFullname = $newFilename.".".uniqid("", true).".".$fileActualExt; //gives file  a unique name in microseconds to differ
        $fileDestination = "../img/gallery/".$imageFullname; //upload file to rootfolder

        if (empty($imageTitle) || empty($imageDesc)) {
          header("Location: ../index.php?upload=empty");
          exit();
        }else {
          //create a template
          $sql = "SELECT * FROM gallery_example;";
          //create a prepared statement
          $stmt = mysqli_stmt_init($conn);
          //prepare the prepared statement
          if (!mysqli_stmt_prepare($stmt, $sql)) {
            echo "SQL statement failed";
          }else {
            //Execute the prepared statement(Run parameters inside the database)
            mysqli_stmt_execute($stmt);
            //check result if we had a certain number of rows
            $result = mysqli_stmt_get_result($stmt);
            //get the number of rows from the reuslt
            $rowCount = mysqli_num_rows($result);
            $ImageOrder = $rowCount + 1; //order of image set

            //inserting data in the database using placeholders
            $sql = "INSERT INTO gallery_example(title_gallery, desc_gallery, img_galleryname,  order_gallery) VALUES(?,?,?,?);";
            //check prepared statement
            if (!mysqli_stmt_prepare($stmt, $sql)) {
              echo "SQL statement failed";
            }else {
              //insert values into the placeholders(Bind parameters to the placeholders)
              mysqli_stmt_bind_param($stmt, "ssss", $imageTitle, $imageDesc, $imageFullname, $ImageOrder); // s means string
              //Execute the statement
              mysqli_stmt_execute($stmt);
              //upload the actual image into the server
              move_uploaded_file($fileTmpName, $fileDestination);

              header("Location: ../index.php?upload=success");
            }
          }
        }
      }else {
        echo "File size too large";
        exit();
      }
    }else {
      echo "Error ulpoad";
      exit();
    }
  }else {
    echo "Wrong file type";
    exit();
 }
}
 ?>
