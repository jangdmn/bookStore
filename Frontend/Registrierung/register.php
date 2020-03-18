<div class="topnav">
    <a href="../login/login.html"><i class="fa fa-fw fa-arrow-circle-left"></i>&nbsp; zurück</a>
    <div class="titel">book store&nbsp;&nbsp;<i class="fas fa-book"></i></div>
</div>
<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=grogogroup', 'root', '');
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="register.css" />
    <link rel="stylesheet" href="../Navbar/navbar.css" />
    <link href="../font-awesome/css/all.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Unica+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet" />
    <title>Registrierung</title>
</head>

<body>

    <?php
    $showFormular = true; // Variable ob das Registrierungsformular anezeigt werden soll

    if (isset($_GET['register'])) {
        $error = false;
        $vorname = $_POST['vorname'];
        $nachname = $_POST['nachname'];
        $email = $_POST['email'];
        $passwort = $_POST['passwort'];
        $passwort2 = $_POST['passwort2'];

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 'Bitte eine gültige E-Mail-Adresse eingeben<br>';
            $error = true;
        }
        if (strlen($passwort) == 0) {
            echo 'Bitte ein Passwort angeben<br>';
            $error = true;
        }
        if ($passwort != $passwort2) {
            echo
                '<div class="warning">
                <div><i class="fa fa-fw fa-exclamation-triangle"></i></div>
                <div><h3>Die Passwörter müssen übereinstimmen</h3></div>
                <div><i class="fa fa-fw fa-exclamation-triangle"></i></div>
             </div>';
            $error = true;
        }

        // Überprüfe, dass die E-Mail-Adresse noch nicht registriert wurde
        if (!$error) {
            $statement = $pdo->prepare("SELECT * FROM kunde WHERE email = :email");
            $result = $statement->execute(array('email' => $email));
            $user = $statement->fetch();

            if ($user !== false) {
                echo
                    '<div class="warning">
                    <div><i class="fa fa-fw fa-exclamation-triangle"></i></div>
                    <div><h3>Diese E-Mail-Adresse ist bereits vergeben</h3></div>
                    <div><i class="fa fa-fw fa-exclamation-triangle"></i></div>
                 </div>';
                $error = true;
            }
        }

        // Keine Fehler, wir können den Nutzer registrieren
        if (!$error) {
            $passwort_hash = password_hash($passwort, PASSWORD_DEFAULT);

            $statement = $pdo->prepare("INSERT INTO kunde (vorname, nachname, email, passwort) 
                                        VALUES (:vorname, :nachname, :email, :passwort)");
            $result = $statement->execute(array('vorname' => $vorname, 'nachname' => $nachname, 'email' => $email, 'passwort' => $passwort_hash));

            if ($result) {
                header("refresh:0;url=success.php");
                $showFormular = false;
            } else {
                echo
                    '<div class="warning">
                    <div><i class="fa fa-fw fa-exclamation-triangle"></i></div>
                    <div><h3>Beim Abspeichern ist leider ein Fehler aufgetreten</h3></div>
                    <div><i class="fa fa-fw fa-exclamation-triangle"></i></div>
                 </div>';
            }
        }
    }

    if ($showFormular) {
    ?>
        <div class="flex-container">
            <div class="registerWin">
                <form action="?register=1" method="post">
                    <div class="registerFont">Vorname:</div>
                    <input type="text" size="40" maxlength="250" name="vorname"><br>

                    <div class="registerFont">Nachname:</div>
                    <input type="text" size="40" maxlength="250" name="nachname"><br><br>

                    <div class="registerFont">E-Mail:</div>
                    <input type="email" size="40" maxlength="250" name="email"><br><br>

                    <div class="registerFont">Dein Passwort:</div>
                    <input type="password" size="40" maxlength="250" name="passwort"><br>

                    <div class="registerFont">Passwort wiederholen:</div>
                    <input type="password" size="40" maxlength="250" name="passwort2"><br><br>

                    <div class="registerBtn">
                        <button type="submit" name="register" class="register">Registrieren</button>
                    </div>
                </form>
            </div>
        </div>

    <?php
    } //Ende von if($showFormular)
    ?>

</body>

</html>