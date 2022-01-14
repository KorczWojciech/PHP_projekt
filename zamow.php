<?php
session_start();
if(!$_SESSION['if_login']){
    header('Location: index.php');
    exit();
}
if(!isset($_POST['order_quantity'])){
    header('Location: zamowienia_user.php');
    exit();
}
include('template.php');
include ('database.php');
$db=new mysqli($host,$database_user,$database_password,$database_name);
if($db->connect_errno!=0){
    echo 'Błąd połączenia z bazą dancyh!';
}else {
    $sql = 'SELECT * FROM products WHERE id=' . $_GET['id'];
    if ($result = $db->query($sql)){
        if($wiersz=$result->fetch_assoc()){

            echo "<div align='center'><h3>Czy potwierdzasz zamówienie?</h3><br/>";
            echo "<form action='stworz_zamowienie.php' method='post'><br>
            Produkt: <br><input type='text' name='produkt' value='".$wiersz['name']."' readonly><br>
            Ilość: <br><input type='text' name='ilosc' value='".$_POST['order_quantity']."' readonly><br>
            Kwota zamówienia: <br><input type='text' name='kwota' value='".$_POST['order_quantity']*$wiersz['price']."' readonly><br>
            <input type='submit' style='margin-top: 5px' class='btn btn-primary' value='Stwórz zamówienie!'>
</form></div>";
        }
    }
}
$db->close();
?>