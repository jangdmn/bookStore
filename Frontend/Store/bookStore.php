<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="bookStore.css" />
  <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet" />
</head>
<title>Bookstore</title>

<body>
  <div class="topnav">
    <a href="#home">Home</a>
    <a href="../Kunde/customerBookshelf.html">Bücherregal</a>
    <a class="active" href="bookStore.php">Book Store</a>
  </div>

  <div class="books">


    <?php
    header("Content-type: text/html");
    session_start();
    $pdo = new PDO('mysql:host=localhost;dbname=grogogroup', 'root', '');

    $sql = "SELECT titel FROM buch";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    while ($row = $stmt->fetch()) {
      // Ausgabe von Book-Covers (Seite 1) --> \" zeigt normales Anführungszeichen an 
      $titel = $row['titel'];
      echo "<a href=\"bookDetail.php?titel=" . $titel . " \"><img \" src=\"../Admin/uploads/" . $titel . "/1.jpg\"></a>";
    }
    ?>
    <a href="bookDetail.php"><img src="https://nyti.ms/2vVxRDK"></a>
  </div>
</body>

</html>