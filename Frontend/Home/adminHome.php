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
    <?php
    session_start();
    if (!isset($_SESSION['userid'])) {
        die('<div class="rahmen"><h3>Bitte zuerst <a href="../login/login.html">einloggen</a></h3></div>');
    } ?>
    <div class="topnav">
        <a class="active" href="adminHome.php"><i class="fa fa-fw fa-home"></i>&nbsp Home</a>
        <a href="../store/adminBookStore.php"><i class="fa fa-fw fa-book""></i>&nbsp Book Store</a>
        <a href=" ../admin/buchAnlegen.php"><i class="fa fa-fw fa-arrow-circle-up"></i>&nbsp Buch Anlegen</a>
        <a href="../logout/logout.php"><i class="fa fa-sign-out" style="font-size:1.4rem"></i></a>
    </div>
    <div class="rahmen">
        <div class="userID">
            <?php
            //Abfrage der Admin-ID vom Login
            $userid = $_SESSION['userid'];

            echo "<div class=\"user\"><h1>Hallo Admin&nbsp</h1>" . "<h1>" . $userid . "</h1><h1>!</h1></div>";
            ?>
        </div>
    </div>

</html>