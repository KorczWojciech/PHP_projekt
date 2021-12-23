<?php
session_start();
if($_SESSION['type']!='admin' || !isset($_SESSION['if_login']) || !isset($_POST['edytuj_produkt'])||!isset($_GET['id'])){
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


<?php
$db=new mysqli('localhost','root','','warzywniak');
if($db->connect_errno!=0){
    echo 'Błąd połączenia z bazą dancyh!';
}else {
    $sql = 'SELECT * FROM products WHERE id=' . $_GET['id'];
    if($result= $db->query($sql)){
        if($wiersz=$result->fetch_assoc()){
            echo "<form action= 'zedytowanie_produktu.php' method='post'><br>
            Id: <input type='number' name='id' value='".$_GET['id']."' readonly><br>
            Produkt: <input type='text' name='produkt' value='".$wiersz['name']."'><br>
            Ilość: <input type='text' name='ilosc' value='".$wiersz['quantity']."'><br>
            Cena: <input type='text' name='kwota' value='".$wiersz['price']."'><br>
            <input type='submit' value='Edytuj rekord!'>
</form>";
        }
    }
}
echo "<br><a href=zarzadzanie_admin.php><button>Wróć do widoku zarządzania!</button></a>";
$db->close();
?>
</body>
</html>