<?php
session_start();
if ($_SESSION['type'] != 'admin' || !isset($_SESSION['if_login'])) {
    header('Location: index.php');
    exit();
}
include ('template.php');
?>
<body>
<div align="center">
<form action= 'dodaj_produkt.php' method='post'><br>
    Produkt: <br>
    <input type='text' name='produkt' required><br>
    Ilość: <br>
    <input type='text' name='ilosc' required><br>
    Cena: <br>
    <input type='text' name='cena' required><br>
    <input type='submit' value='Dodaj produkt!' style="margin-top: 5px" class="btn btn-primary" name="dodaj_produkt">
</form>
</div>
</body>
</html>