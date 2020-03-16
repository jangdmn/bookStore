<?php
header("Content-type: text/html");
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=grogogroup', 'root', '');

if (isset($_GET['login'])) {
    $adminID = $_POST['adminID'];
    $passwort = $_POST['passwort'];

    $statement = $pdo->prepare("SELECT * FROM administrator WHERE adminID = :adminID");
    $result = $statement->execute(array('adminID' => $adminID));
    $user = $statement->fetch();

    //Überprüfung des Passworts
    if ($user !== false && password_verify($passwort, $user['passwort'])) {
        $_SESSION['userid'] = $user['adminID'];
        die(header("refresh:0;url=../home/adminHome.php"));
    } else {
        $errorMessage = "E-Mail oder Passwort war ungültig<br>";
    }
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="login.css" />
    <link
      href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap"
      rel="stylesheet"
    />
    <title>Login</title>
  </head>

  <body>
    <?php
    if (isset($errorMessage)) {
        echo $errorMessage;
    }
    ?>

    <div class="flex-container">
      <div class="loginWin">
        <form action="?login=1" method="post">
          <h3>Administrator-ID:</h3>
          <input
            type="text"
            size="40"
            maxlength="250"
            name="adminID"
          /><br /><br />

          <h3>Dein Passwort:</h3>
          <input
            type="password"
            size="40"
            maxlength="250"
            name="passwort"
          /><br />

          <div class="loginBtn">
            <button type="submit" name="login" class="login">Login</button>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
