<?php
session_start();
if(!$_SESSION['if_login']){
    header('Location: index.php');
    exit();
}else if($_SESSION['type']=='admin'){
    header('Location: zarzadzanie_admin.php');
    exit();
}
include ('template.php');
?>
<html>
<body>
<div style="margin: 20px">
<?php
echo "<table class='table table-striped' style='text-align: center'>
    <tr>
    <th>id</th>
    <th>Produkt</th>
    <th>Ilość w magazynie w kg</th>
    <th>Cena w zł</th>
    <th style='background-color: antiquewhite'>Złóż zamówienie</th>
    </tr>";
$db=new mysqli('localhost','root','','warzywniak');
if($db->connect_errno!=0){
    echo 'Błąd połączenia z bazą dancyh!';
}else{
    $sql='SELECT * FROM products WHERE quantity>0';
    if($result=$db->query($sql)){
        while ($wiersz = $result->fetch_assoc()){
            $max=$wiersz['quantity'];
            echo "<tr><td>".$wiersz['id']."</td>".
            "<td>".$wiersz['name']."</td>".
            "<td>".$wiersz['quantity']."</td>".
            "<td>".$wiersz['price']."</td>".
            "<td style='background-color: antiquewhite'>"."<form action='zamow.php?id=".$wiersz['id']."' method='post'><input type='number' name='order_quantity' min='1' max=$max style='background-color: antiquewhite'> <input type='submit' value='Zamów!'></form>"."</td></tr>";

        }
    }
    $sql2="SELECT * FROM orders WHERE purchaser_id=".$_SESSION['id']." AND status!='Zakończone'";
    $result2=$db->query($sql2);
    echo "</table>
<br>Twoje NOWE zamówienia:<table class='table table-striped' style='text-align: center'>
    <tr>
    <th>Numer zamówienia</th>
    <th>Produkt</th>
    <th>Zamówiona ilość</th>
    <th>Kwota zamówienia</th>
    <th>Data</th>
    <th>Status</th>
    </tr>";
    if($result2){
        while ($wiersz2=$result2->fetch_assoc()){
            echo "<tr><td>".$wiersz2['id']."</td>".
            "<td>".$wiersz2['product']."</td>".
            "<td>".$wiersz2['quantity']."</td>".
            "<td>".$wiersz2['total_price']."</td>".
            "<td>".$wiersz2['create_date']."</td>".
            "<td>".$wiersz2['status']."</td></tr>";
        }
    }
    $sql3="SELECT * FROM orders WHERE purchaser_id=".$_SESSION['id']." AND status='Zakończone'";
$result3=$db->query($sql3);
    echo "</table>
<br>Twoje ZREALIZOWANE zamówienia:<table class='table table-striped' style='text-align: center'>
    <tr>
    <th>Numer zamówienia</th>
    <th>Produkt</th>
    <th>Zamówiona ilość</th>
    <th>Kwota zamówienia</th>
    <th>Data</th>
    <th>Status</th>
    </tr>";
    if($result3){
        while ($wiersz3=$result3->fetch_assoc()){
            echo "<tr><td>".$wiersz3['id']."</td>".
            "<td>".$wiersz3['product']."</td>".
            "<td>".$wiersz3['quantity']."</td>".
            "<td>".$wiersz3['total_price']."</td>".
            "<td>".$wiersz3['create_date']."</td>".
            "<td>".$wiersz3['status']."</td></tr>";
        }
    }
}

$db->close();
?>
</div>
</body>
</html>
