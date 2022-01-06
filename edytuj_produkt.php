<?php
session_start();
if($_SESSION['type']!='admin' || !isset($_SESSION['if_login']) || !isset($_POST['edytuj_produkt'])||!isset($_GET['id'])){
    header('Location: index.php');
    exit();
}
include('template.php');
?>
<body>
<div align="center">
<?php
$db=new mysqli('localhost','root','','warzywniak');
if($db->connect_errno!=0){
    echo 'Błąd połączenia z bazą dancyh!';
}else {
    $sql = 'SELECT * FROM products WHERE id=' . $_GET['id'];
    if($result= $db->query($sql)){
        if($wiersz=$result->fetch_assoc()){
            echo "<form action= 'zedytowanie_produktu.php' method='post'><br>
            Id: <br><input type='number' name='id' value='".$_GET['id']."' readonly><br>
            Produkt: <br><input type='text' name='produkt' value='".$wiersz['name']."'><br>
            Ilość: <br><input type='text' name='ilosc' value='".$wiersz['quantity']."'><br>
            Cena: <br><input type='text' name='kwota' value='".$wiersz['price']."'><br>
            <input type='submit' class='btn btn-primary' style='margin-top: 5px' value='Edytuj rekord!'>
</form>";
        }
    }
}
echo "<br><a href=zarzadzanie_admin.php><button class='btn btn-success'>Wróć do widoku zarządzania!</button></a>";
$db->close();
?>
</div>
</body>
</html>