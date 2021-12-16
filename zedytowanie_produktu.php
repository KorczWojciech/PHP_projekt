<?php

session_start();
if ($_SESSION['type'] != 'admin' || !isset($_SESSION['if_login'])) {
    header('Location: index.php');
    exit();
}

$db=new mysqli('localhost','root','','warzywniak');
$produkt=htmlentities($_POST['produkt'],ENT_QUOTES,"UTF-8");
$ilosc=htmlentities($_POST['ilosc'],ENT_QUOTES,"UTF-8");
$kwota=htmlentities($_POST['kwota'],ENT_QUOTES,"UTF-8");
$id=$_POST['id'];
if($db->connect_errno!=0){
    echo 'Błąd połączenia z bazą dancyh!';
        }else{
        $sql="UPDATE products SET name='".$produkt."',quantity=".$ilosc.",price=".$kwota." WHERE id='$id'";
        $result= $db->query($sql);
        if($result){
            echo "<h3>Rekord zedytowany prawidłowo!</h3>";
        }else{
            echo '<h3>Edycja rekordu nie powiodła się!</h3>';
        }
        }
    echo "<a href=zarzadzanie_admin.php>Wróć do widoku zarządzania!</a>";
$db->close();

?>
