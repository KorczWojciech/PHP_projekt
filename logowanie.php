<?php
session_start();

if(isset($_SESSION['if_login'])&&$_SESSION['if_login']){
    if($_SESSION['type']=='user'){
        header('Location: zamowienia_user.php');
    }elseif ($_SESSION['type']=='admin'){
        header('Location: zarzadzanie_admin.php');
}
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
Nie masz jeszcze konta - <a href="rejestracja.php"><b>Zarejestruj się!!!</b></a><br/><br/>
    <form action="zaloguj.php" method="post">
        Login: <br/> <input type="text" name="login"/><br/>
        Hasło: <br/> <input type="password" name="password"/><br/><br/>
        <input type="submit" value="Zaloguj się!">
    </form>
<?php
if(isset($_SESSION['error'])&&($_SESSION['error']!="")){
    echo $_SESSION['error'];
}
?>
</body>
</html>