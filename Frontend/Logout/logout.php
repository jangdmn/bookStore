<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="logout.css" />
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web&display=swap" rel="stylesheet" />
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
            <?php
            session_start();
            session_destroy();

            echo "<div class=\"redirect\"><h1>Logout erfolgreich</h1>
            <div class=\"redirect\"><h2>Sie werden zum Login weitergeleitet</h2</div>";

            header("refresh:3.5;url=../login/login.html");
            ?>
            <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
        </div>
    </div>
</body>

</html>