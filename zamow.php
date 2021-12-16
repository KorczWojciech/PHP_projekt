<?php
session_start();
if(!$_SESSION['if_login']){
    header('Location: index.php');
    exit();
}
$db=new mysqli('localhost','root','','warzywniak');
if($db->connect_errno!=0){
    echo 'Błąd połączenia z bazą dancyh!';
}else {
    $sql = 'SELECT * FROM products WHERE id=' . $_GET['id'];
    if ($result = $db->query($sql)){
        if($wiersz=$result->fetch_assoc()){

            echo "<h3>Czy potwierdzasz zamówienie?</h3><br/>";
            echo "<form action='stworz_zamowienie.php' method='post'><br>
            Produkt: <input type='text' name='produkt' value='".$wiersz['name']."' readonly><br>
            Ilość: <input type='text' name='ilosc' value='".$_POST['order_quantity']."' readonly><br>
            Kwota zamówienia: <input type='text' name='kwota' value='".$_POST['order_quantity']*$wiersz['price']."' readonly><br>
            <input type='submit' value='Stwórz zamówienie!'>
</form>";
        }
    }
}
$db->close();
?>