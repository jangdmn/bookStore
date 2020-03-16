<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="home.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather&display=swap" rel="stylesheet">
</head>
<title>Home</title>

<body>
    <!-- Prüft ob ein User eingeloggt ist -->
    <?php
    session_start();
    if (!isset($_SESSION['userid'])) {
        die('<div class="rahmen"><h3>Bitte zuerst <a href="../login/login.html">einloggen</a></h3></div>');
    } ?>
    <div class="topnav">
        <a class="active" href="costumerHome.php"><i class="fa fa-fw fa-home"></i>&nbsp Home</a>
        <a href="../Kunde/customerBookshelf.php"><i class="fa fa-fw fa-coffee"></i>&nbsp Bücherregal</a>
        <a href="../store/customerBookstore.php"><i class="fa fa-fw fa-book""></i>&nbsp Book Store</a>
        <a href=" ../logout/logout.php"> <i class="fa fa-sign-out" style="font-size:1.4rem"></i></a>
    </div>
    <div class="rahmen">
        <div class="userID">
            <?php
            // Abfrage des Benutzernames
            $name = $_SESSION['name'];

            echo "<div class=\"user\"><h1>Hallo&nbsp</h1>" . "<h1>" . $name . "</h1><h1>!</h1></div>";
            ?>
        </div>
    </div>

</html>