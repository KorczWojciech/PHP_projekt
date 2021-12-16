<?php
session_start();
if ($_SESSION['type'] != 'admin' || !isset($_SESSION['if_login'])) {
    header('Location: index.php');
    exit();
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
<form action= 'dodaj_produkt.php' method='post'><br>
    Produkt: <input type='text' name='produkt'><br>
    Ilość: <input type='text' name='ilosc'><br>
    Cena: <input type='text' name='cena'><br>
    <input type='submit' value='Dodaj produkt!' name="dodaj_produkt">
</form>

</body>
</html>