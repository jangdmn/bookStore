<?php
header("Content-type: text/html");
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=grogogroup', 'root', '');

if (isset($_GET['login'])) {
    $email = $_POST['email'];
    $passwort = $_POST['passwort'];

    $statement = $pdo->prepare("SELECT * FROM kunde WHERE email = :email");
    $result = $statement->execute(array('email' => $email));
    $user = $statement->fetch();

    //Überprüfung des Passworts
    if ($user !== false && password_verify($passwort, $user['passwort'])) {
        $_SESSION['userid'] = $user['benutzerID'];
        $_SESSION['name'] = $user['vorname'];
        die(header("refresh:0;url=../home/customerHome.php"));
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
          <h3>E-Mail:</h3>
          <input
            type="email"
            size="40"
            maxlength="250"
            name="email"
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
