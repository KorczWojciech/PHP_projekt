<?php
session_start();
if ($_SESSION['type'] != 'admin' || !isset($_SESSION['if_login']) || !isset($_POST['edytuj_status_sub'])) {
    header('Location: index.php');
    exit();
}
$db=new mysqli('localhost','root','','warzywniak');
if($db->connect_errno!=0){
    echo 'Błąd połączenia z bazą dancyh!';
}else{
    $sql="UPDATE orders SET status='".$_POST['nowy_status']."' WHERE id=".$_GET['id'];
    $result= $db->query($sql);
    if($result){
        echo "<h3>Status zedytowany prawidłowo.</h3>";
        echo "Nowy status to: ".$_POST['nowy_status'];
    }else{
        echo '<h3 style="color: red">Edycja stsusu nie powiodła się!</h3>';
    }
}
echo "<br><a href=zarzadzanie_admin.php><button>Wróć do widoku zarządzania!</button></a>";
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
<?php