<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="buchAnlegen.css" />
  <link href="../font-awesome/css/all.css" rel="stylesheet" />
  <link rel="stylesheet" href="../Navbar/navbar.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Unica+One&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet" />
</head>
<title>Admin</title>

<body>
  <?php
  session_start();
  if (!isset($_SESSION['userid'])) {
    die('<div class="rahmen"><h3>Bitte zuerst <a href="../login/login.html">einloggen</a></h3></div>');
  } ?>
  <div class="topnav">
    <a href="../home/adminHome.php"><i class="fa fa-fw fa-home"></i>&nbsp Home</a>
    <a href="../store/adminBookStore.php"><i class="fa fa-fw fa-book""></i>&nbsp Book Store</a>
    <a class=" active" href="buchAnlegen.php"><i class="fa fa-fw fa-arrow-circle-up"></i>&nbsp Buch Anlegen</a>
    <a href="../logout/logout.php"><i class="fa fa-sign-out" style="font-size:1.4rem"></i></a>
    <div class="titel">book store&nbsp;&nbsp;<i class="fas fa-book"></i></div>
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
  $pdo = new PDO('mysql:host=localhost;dbname=grogogroup', 'root', '');

  if (isset($_POST["upload"])) {
    $target_dir = "../Uploads/";
    $target_file = $target_dir . $_FILES["fileToUpload"]["name"];
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $titelDirectory = $_POST['titel'];
    $isbn10 = $_POST['isbn10'];
    $isbn13 = $_POST['isbn13'];
    $autor = $_POST['autor'];
    $titel = $_POST['titel'];

    // Überprüfe auf PDF-Datei
    if (
      $imageFileType != "pdf"
    ) {
      echo "<div class=\"fileWarn\">
              <i class=\"fa fa-fw fa-exclamation-triangle\"></i>
              <div>Sie können ausschließlich PDF-Dateien hochladen.</div>
              <i class=\"fa fa-fw fa-exclamation-triangle\"></i>
            </div>";
      $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "<div class=\"fileWarn\">
              <i class=\"fa fa-fw fa-exclamation-triangle\"></i>
              <div>Ihre Datei wurde nicht hochgeladen.</div>
              <i class=\"fa fa-fw fa-exclamation-triangle\"></i>
            </div>";

      // wenn alles in Ordnung ist, versuche die Datei hochzuladen
    } else {
      $sql = "INSERT INTO buch (isbn10, isbn13, titel, autor)
              VALUES (:isbn10, :isbn13, :titel, :autor)";

      // Schutz gegen SQL-Injections
      $statement = $pdo->prepare($sql);
      $result = $statement->execute(array('isbn10' => $isbn10, 'isbn13' => $isbn13, 'titel' => $titel, 
      'autor' => $autor));

      // Prüft ob Datei schon vorhanden ist
      if (file_exists("uploads/$titelDirectory")) {
        echo "<div class=\"fileWarn\">
              <i class=\"fa fa-fw fa-exclamation-triangle\"></i>
              <div>Datei existiert bereits.</div>
              <i class=\"fa fa-fw fa-exclamation-triangle\"></i>
            </div>";
      } else { // Ordner mit dem Namen des eingegebenen Buchtitels wird erstellt
      mkdir("uploads/$titelDirectory");}

      // Seiten werden konvertiert und in den gerade erstellten Ordner gespeichert
      exec("gswin32c -dNOPAUSE -sDEVICE=jpeg -r144 -sOutputFile=uploads/$titelDirectory/%d.jpg $target_file");
      echo "<div class=\"fileSuccess\">
              <i class=\"fa fa-fw fa-check-circle\"></i>
              <div>Datei erfolgreich hochgeladen und konvertiert.</div>
              <i class=\"fa fa-fw fa-check-circle\"></i>
            </div>";
    }
  }
  // DB-Verbindung schließen
  /*   $stmt = null;
  $pdo = null; */
  ?>
</body>

</html>