<?php
session_start();
if ($_SESSION['type'] != 'admin' || !isset($_SESSION['if_login'])) {
    header('Location: index.php');
    exit();
}
include('template.php');
?>

<?php
include ('database.php');
$db=new mysqli($host,$database_user,$database_password,$database_name);
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
            echo "<div align='center'><label class='positiv'>Rekord zedytowany prawidłowo!</label>";
        }else{
            echo "'<div align='center'><label class='error'>Edycja rekordu nie powiodła się!</label>";
        }
        }
    echo "<br><a href=zarzadzanie_admin.php><button class='btn btn-success'> Wróć do widoku zarządzania!</button></a></div>";
$db->close();
?>