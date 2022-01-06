<?php
session_start();
if ($_SESSION['type'] != 'admin' || !isset($_SESSION['if_login']) ||!isset($_POST['dodaj_produkt'])) {
    header('Location: index.php');
    exit();
}
include ('template.php');
$db=new mysqli('localhost','root','','warzywniak');
$produkt=htmlentities($_POST['produkt'],ENT_QUOTES,"UTF-8");
$ilosc=htmlentities($_POST['ilosc'],ENT_QUOTES,"UTF-8");
$cena=htmlentities($_POST['cena'],ENT_QUOTES,"UTF-8");
if($db->connect_errno!=0){
    echo 'Błąd połączenia z bazą dancyh!';
}else {
    $sql = "INSERT INTO products (name,quantity,price) VALUES ('$produkt',$ilosc,$cena)";
    if($result=$db->query($sql)){
        echo "<br><div align='center'><label class='positiv'>Produkt dodano prawidłowo!</label><br><br>";
    }else{
        echo "<br><label class='error'>Dodanie produktu nie powiodło się!</label><br><br>";
    }
}
echo"<a href='zarzadzanie_admin.php'><button class='btn btn-success'>Wróć do widoku zarządzania!</button></a></div>"
?>

