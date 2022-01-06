<?php
session_start();
if ($_SESSION['type'] != 'admin' || !isset($_SESSION['if_login']) || !isset($_POST['edytuj_status_sub'])) {
    header('Location: index.php');
    exit();
}
include('template.php');
$db=new mysqli('localhost','root','','warzywniak');
if($db->connect_errno!=0){
    echo 'Błąd połączenia z bazą dancyh!';
}else{
    $sql="UPDATE orders SET status='".$_POST['nowy_status']."' WHERE id=".$_GET['id'];
    $result= $db->query($sql);
    if($result){
        echo "<div align='center'><h3 class='positiv'>Status zedytowany prawidłowo.</h3>";
        echo "Nowy status to: ".$_POST['nowy_status'];
    }else{
        echo '<h3 class="error">Edycja stsusu nie powiodła się!</h3>';
    }
}
echo "<br><a href=zarzadzanie_admin.php><button class='btn btn-success'>Wróć do widoku zarządzania!</button></a></div>";
$db->close();
?>