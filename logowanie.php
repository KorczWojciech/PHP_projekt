<?php
session_start();

if(isset($_SESSION['if_login'])&&$_SESSION['if_login']){
    if($_SESSION['type']=='user'){
        header('Location: zamowienia_user.php');
    }elseif ($_SESSION['type']=='admin'){
        header('Location: zarzadzanie_admin.php');
}
}
include ('template.php');
?>

<body>
<div align="center">
    <?php if(isset($_SESSION['register_correct_info'])){
        echo "<lebel class='positiv'>".$_SESSION['register_correct_info']."</lebel><br>";
        unset($_SESSION['register_correct_info']);
    }
?>
    <label style="font-weight: bold;font-size: 18px;margin-top: 5px">Nie masz jeszcze konta - </label><a href="rejestracja.php"><button class="btn btn-primary">Zarejestruj się!!!</button></a><br/><br/>
    <form action="zaloguj.php" method="post">
        Login: <br/> <input type="text" name="login"/><br/>
        Hasło: <br/> <input type="password" name="password"/><br/><br/>
        <input type="submit" value="Zaloguj się!">
    </form>
<?php
if(isset($_SESSION['error'])&&($_SESSION['error']!="")){
    echo "<label class='error'>".$_SESSION['error']."</label>";
}
?>
</div>
</body>
</html>