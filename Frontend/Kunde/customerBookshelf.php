<!-- source https://codepen.io/tholman/pen/pytnq-->

<!DOCTYPE html>
<html>

<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <link rel="stylesheet" href="customerBookshelf.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet" />
</head>
<title>Bookshelf</title>

<body>
  <!-- Prüft ob ein User eingeloggt ist -->
  <?php
  session_start();
  if (!isset($_SESSION['userid'])) {
    die('<div class="rahmen"><h3>Bitte zuerst <a href="../login/login.html">einloggen</a></h3></div>');
  } ?>
  <div class="topnav">
    <a href="../home/customerHome.php"><i class="fa fa-fw fa-home"></i>&nbsp Home</a>
    <a class="active" href="customerBookshelf.php"><i class="fa fa-fw fa-coffee"></i>&nbsp Bücherregal</a>
    <a href="../store/customerBookstore.php"><i class="fa fa-fw fa-book""></i>&nbsp Book Store</a>
    <a href=" ../logout/logout.php"> <i class="fa fa-sign-out" style="font-size:1.4rem; color:white"></i></a>
  </div>
</body>

</html>