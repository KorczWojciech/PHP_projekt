<?php
session_start();
if(!$_SESSION['if_login']){
    header('Location: index.php');
    exit;
}
include('template.php');
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
    $sql3="SELECT quantity FROM products WHERE name='$produkt'";
    $result3 = $db->query($sql3);
    $zabezpieczenie=$result3->fetch_assoc();
    if($zabezpieczenie['quantity']>$ilosc ){
        $result= $db->query($sql);
        $result2 = $db->query($sql2);
        if($result &&  $result2){
            echo "<div align='center' class='positiv'><h3>Zamówienie złożone prawidłowo</h3>";
        }else{
            echo '<div align="center" class="error"><h3>Złożenie zamównia nie powiodło się!</h3>';
        }
    }else{
        echo '<div align="center" class="error"><h3>Złożenie zamównia nie powiodło się!</h3>';
    }

}
echo "<a href=zamowienia_user.php><button class='btn btn-success'>Wróć do swojego profilu!</button></a></div>";
$db->close();
?>

