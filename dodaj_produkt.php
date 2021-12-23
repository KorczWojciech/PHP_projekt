<?php
session_start();
if ($_SESSION['type'] != 'admin' || !isset($_SESSION['if_login']) ||!isset($_POST['dodaj_produkt'])) {
    header('Location: index.php');
    exit();
}
$db=new mysqli('localhost','root','','warzywniak');
$produkt=htmlentities($_POST['produkt'],ENT_QUOTES,"UTF-8");
$ilosc=htmlentities($_POST['ilosc'],ENT_QUOTES,"UTF-8");
$cena=htmlentities($_POST['cena'],ENT_QUOTES,"UTF-8");
if($db->connect_errno!=0){
    echo 'Błąd połączenia z bazą dancyh!';
}else {
    $sql = "INSERT INTO products (name,quantity,price) VALUES ('$produkt',$ilosc,$cena)";
    if($result=$db->query($sql)){
        echo "Produkt dodano prawidłowo!";
    }else{
        echo "Dodanie produktu nie powiodło się!";
    }
}
echo"<br><a href='zarzadzanie_admin.php'><button>Wróć do widoku zarządzania!</button></a>"
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Warzywniak</title>
</head>

