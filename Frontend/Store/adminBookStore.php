<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="bookStore.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet" />
</head>
<title>Bookstore</title>

<body>
  <div class="topnav">
    <a href="../home/adminHome.php"><i class="fa fa-fw fa-home"></i>&nbsp Home</a>
    <a class="active" href="bookStore.php"><i class="fa fa-fw fa-book""></i>&nbsp Book Store</a>
    <a href=" ../admin/buchAnlegen.php"> <i class="fa fa-fw fa-arrow-circle-up"></i>&nbsp Buch Anlegen</a>
    <a href="../logout/logout.php"><i class="fa fa-sign-out" style="font-size:1.4rem"></i></a>
  </div>

  <div class="books">
    <?php
    header("Content-type: text/html");
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