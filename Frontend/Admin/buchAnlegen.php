<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="buchAnlegen.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet" />
</head>
<title>Admin</title>

<body>
<div class="topnav">
    <a href="../home/adminHome.php"><i class="fa fa-fw fa-home"></i>&nbsp Home</a>
    <a href="../store/adminBookStore.php"><i class="fa fa-fw fa-book""></i>&nbsp Book Store</a>
    <a class="active" href="buchAnlegen.php"><i class="fa fa-fw fa-arrow-circle-up"></i>&nbsp Buch Anlegen</a>
    <a href="../logout/logout.php"><i class="fa fa-sign-out" style="font-size:1.4rem"></i></a>
  </div>
  <form method="post" enctype="multipart/form-data">
    <div class="flex-container">

      <div>
        <h4>ISBN-10</h4>
        <input type="text" name="isbn10" id="isbn10" />
      </div>
      <div>
        <h4>ISBN-13</h4>
        <input type="text" name="isbn13" id="isbn13" />
      </div>
      <div>
        <h4>Titel</h4>
        <input type="text" name="titel" id="titel" />
      </div>
      <div>
        <h4>Autor</h4>
        <input type="text" name="autor" id="autor" />
      </div>
    </div>
    </br>

    Wählen Sie eine PDF-Datei aus, die in JPEG umgewandelt werden soll. <br /><br />
    <input type="file" name="fileToUpload" id="fileToUpload">
    </br>
    </br>
    <div><button type="submit" name="upload" value="Upload PDF" class="anlegen">Buch anlegen</button></div>
  </form>

  <?php
  header("Content-type: text/html");
  session_start();
  $pdo = new PDO('mysql:host=localhost;dbname=grogogroup', 'root', '');

  if (isset($_POST["upload"])) {
    $target_dir = "../Uploads/";
    $target_file = $target_dir . $_FILES["fileToUpload"]["name"];
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $output = "C:/xampp/htdocs/Abschlussprojekt_v1.1/Frontend/Admin/affen.jpg";
    $titelDirectory = $_POST['titel'];
    $isbn10 = $_POST['isbn10'];
    $isbn13 = $_POST['isbn13'];
    $autorName = $_POST['autor'];
    $bookTitel = $_POST['titel'];
    // Allow certain file formats
    if (
      $imageFileType != "pdf"
    ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
      // if everything is ok, try to upload file
    } else {
      $sql = "INSERT INTO 'Buch' (isbn10, isbn13, titel, autor, verzeichnispfad)
      VALUES (?, ?, ?, ?, ?)";

      // Schutz gegen SQL-Injections
      $stmt = $pdo->prepare($sql);
      $data = array($isbn10, $isbn13, $bookTitel, $autorName, "upload/$titelDirectory");
      $stmt->execute($data);

      // Ordner mit dem Namen des eingegebenen Buchtitels wird erstellt
      mkdir("uploads/$titelDirectory");
      // Seiten werden konvertiert und in den gerade erstellten Ordner gespeichert
      exec("gswin32c -dNOPAUSE -sDEVICE=jpeg -r144 -sOutputFile=uploads/$titelDirectory/%d.jpg $target_file");
      echo "Datei erfolgreich hochgeladen und konvertiert.";
    }
  }
  // DB-Verbindung schließen
  /*   $stmt = null;
  $pdo = null; */
  ?>
</body>

</html>