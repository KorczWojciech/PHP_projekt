<?php
session_start();
if ($_SESSION['type'] != 'admin' || !isset($_SESSION['if_login']) ||!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}
if(!isset($_POST['awansuj']) || !isset($_POST['degraduj'])){
    $db=new mysqli('localhost','root','','warzywniak');
    if($db->connect_errno!=0){
        echo 'Błąd połączenia z bazą dancyh!';
    }else {
        $sql_awa = "UPDATE users SET type='admin' WHERE id=".$_GET['id'];
        $sql_deg = "UPDATE users SET type='user' WHERE id=".$_GET['id'];
        if(isset($_POST['awansuj'])){
            if($result=$db->query($sql_awa)){echo "Awansowano prawidłowo!";}
        }elseif (isset($_POST['degraduj'])){
            if($result=$db->query($sql_deg)){echo "Zdegradowano prawidłowo!";}
        }

    }
    echo"<br><a href='zarzadzanie_admin.php'><button>Wróć do widoku zarządzania!</button></a>";
}else{
    header('Location: index.php');
    exit();
}

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