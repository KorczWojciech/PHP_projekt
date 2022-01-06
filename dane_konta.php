<?php
session_start();
if(!$_SESSION['if_login']){
    header('Location: index.php');
    exit;
}

include ('template.php');
if(isset($_SESSION['info_o_edycji'])){
    echo "<h2 style='color: green' align='center'>".$_SESSION['info_o_edycji']."</h2>";
    unset($_SESSION['info_o_edycji']);
}
?>

<body>
<div align="center">
<form action="edytuj_login.php" method="post" class="center-block">
    Nowy login:<br><input type="text" name="nowy_login"><br>
    Podaj hasło: <br><input type="password" name="password"><br>
    <input type="submit" name="login_submit" style="margin-top: 5px" class="btn btn-primary" value="Zmień login!">
    <?php
    if(isset($_SESSION['login_error'])){
        echo '<div class="error">'.$_SESSION['login_error'].'</div>';
        unset($_SESSION['login_error']);
    }
    ?>
</form>
<form action="edytuj_haslo.php" method="post">
    <br><br>Nowe haslo:<br><input type="password" name="nowe_haslo1">
    <br>Powtórz nowe haslo:<br><input type="password" name="nowe_haslo2">
    <br>Aktualne haslo:<br><input type="password" name="password">
    <br><input type="submit" name="password_submit" style="margin-top: 5px" class="btn btn-primary" value="Zmień haslo!">
    <br/>
    <?php
    if(isset($_SESSION['password_error'])){
        echo '<div class="error">'.$_SESSION['password_error'].'</div>';
        unset($_SESSION['password_error']);
    }
    ?>
</form>
<form action="edytuj_email.php" method="post">
    <br><br>Nowy email:<br><input type="email" name="nowy_email"><br>
    Podaj hasło: <br><input type="password" name="password"><br>
    <input type="submit" name="email_submit" style="margin-top: 5px" class="btn btn-primary" value="Zmień email!">
    <br/>
    <?php
    if(isset($_SESSION['email_error'])){
        echo '<div class="error">'.$_SESSION['email_error'].'</div>';
        unset($_SESSION['email_error']);
    }
    ?>
</form>
<br>
<a href="zamowienia_user.php"><button class="btn btn-success">Wróć do widoku zamówień!</button></a>
</div>
</body>
</html>