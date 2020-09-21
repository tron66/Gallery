<?php
$_SESSION['username'] = "Admin";
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="resetstyle.css">
    <link rel="stylesheet" href="style.css">
    <title>GALLERY</title>
  </head>
  <body>
    <header>
      <a class="header-brand" href="#">pGALLERY</a>
      <nav>
        <ul>
          <li><a href="#">Portiflio</a></li>
          <li><a href="#">About me</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
        <a class="header-cases" href="#">Gallery</a>
      </nav>
    </header>
    <main>
      <section class="gallery-links">
        <div class="wrapper">
          <h2>Gallery</h2>
          <div class="gallery-container">
            <?php
            include_once 'gallery_php/db.php';

            $sql = "SELECT *FROM gallery_example ORDER BY order_gallery DESC";
            //create a prepared statement
            $stmt = mysqli_stmt_init($conn);
            //prepare the prepared statement
            if (!mysqli_stmt_prepare($stmt, $sql)) {
              echo "SQL statement failed";
            }else {
              //Execute the prepared statement(Run parameters inside the database)
              mysqli_stmt_execute($stmt);
              $result = mysqli_stmt_get_result($stmt);
              //loop out all the rows from inside the database
              while ($row = mysqli_fetch_assoc($result)) {
                echo '<a href="#">
                      <div style="background-image: url(img/gallery/'.$row["img_galleryname"].')"></div>
                      <h3>'.$row["title_gallery"].'</h3>
                      <p>'.$row["desc_gallery"].'</p>
                      </a>';
              }
            }
             ?>
          </div>
      <!--
      <section class="cases-links">
        <div class="wrapper">
          <h2>Cases</h2>
          <a href="#">
          <div class="cases-link">
            <p>Case1</p>
          </div>
          </a>
          <a href="#">
          <div class="cases-link">
            <p>Case1</p>
          </div>
          </a>
          <a href="#">
          <div class="cases-link">
            <p>Case1</p>
          </div>
          </a>
          <a href="#">
          <div class="cases-link">
            <p>Case1</p>
          </div>
          </a>
          <a href="#">
          <div class="cases-link">
            <p>Case1</p>
          </div>
          </a>
          <a href="#">
          <div class="cases-link">
            <p>Case1</p>
          </div>
          </a>
        </div>
      -->

      <?php
      if (isset($_SESSION['username'])) {
      echo '<div class="gallery-upload">
            <h2>UPLOAD</h2>
            <form class="" action="gallery_php/gallery-upload.php" method="post" enctype="multipart/form-data">
              <input type="text" name="filename" placeholder="Filename...">
              <input type="text" name="filetitle" placeholder="Image title...">
              <input type="text" name="filedesc" placeholder="Image description...">
              <input type="file" name="file">
              <button type="submit" name="submit">UPLOAD</button>
            </form>
          </div>';
          echo'
          <form action="deleteImage.php" method="post">
            <button type="submit" name="submit">Delete</button>
          </form>';
        }
      ?>
      </div>
      </section>
    </main>

    <div class="wrapper">
      <footer>
        <ul class="footer-links-main">
          <li><a href="#">Home</a></li>
          <li><a href="#">Cases</a></li>
          <li><a href="#">Portifoli</a></li>
          <li><a href="#">About me</a></li>
          <li><a href="#">Contact</a></li>
        </ul>
        <ul class="footer-links-cases">
          <li> <p>Latest cases</p> </li>
          <li> <a href="#">WEB DEVELOPMENT</a> </li>
          <li> <a href="#">FACEBOOK</a> </li>
          <li> <a href="#">YOUTUBE</a> </li>
          <li> <a href="#">VIMEO</a> </li>
        </ul>
        <div class="footer-sm">
          <a href="#">
            <img src="img/download (2).png" alt="whatsapp icon">
          </a>
          <a href="#">
            <img src="img/download.png" alt="yes icon">
          </a>
          <a href="#">
            <img src="img/download (1).png" alt="Gamer icon">
          </a>
        </div>
      </footer>
    </div>
  </body>
</html>
