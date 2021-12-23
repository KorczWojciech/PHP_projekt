<?php
session_start();
if(!$_SESSION['if_login']){
    header('Location: index.php');
    exit;
}
$db=new mysqli('localhost','root','','warzywniak');
$produkt=$_POST['produkt'];
$ilosc=$_POST['ilosc'];
$kwota=$_POST['kwota'];
$id=$_SESSION['id'];
if($db->connect_errno!=0){
    echo 'Błąd połączenia z bazą dancyh!';
}else{
    $sql="INSERT INTO orders (product,quantity,total_price,purchaser_id) VALUES ('$produkt',$ilosc,$kwota,$id)";
    $sql2="UPDATE products SET quantity=quantity-".$ilosc." WHERE name='$produkt'";
    $result= $db->query($sql);
    $result2 = $db->query($sql2);
    if($result &&  $result2){
        echo "<h3>Zamówienie złożone prawidłowo</h3>";
    }else{
        echo '<h3>złożenie zamównia nie powiodło się!</h3>';
  }
}
echo "<a href=zamowienia_user.php>Wróć do swojego profilu!</a>";
$db->close();
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
