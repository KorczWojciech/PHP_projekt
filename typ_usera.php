<?php
session_start();
if ($_SESSION['type'] != 'admin' || !isset($_SESSION['if_login']) ||!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}
include('template.php');
if(!isset($_POST['awansuj']) || !isset($_POST['degraduj'])){
    $db=new mysqli('localhost','root','','warzywniak');
    if($db->connect_errno!=0){
        echo 'Błąd połączenia z bazą dancyh!';
    }else {
        $sql_awa = "UPDATE users SET type='admin' WHERE id=".$_GET['id'];
        $sql_deg = "UPDATE users SET type='user' WHERE id=".$_GET['id'];
        if(isset($_POST['awansuj'])){
            if($result=$db->query($sql_awa)){echo "<div align='center'><label class='positiv' style='font-size: 18px'>Awansowano prawidłowo!</label>";}
        }elseif (isset($_POST['degraduj'])){
            if($result=$db->query($sql_deg)){echo "<div align='center'><label class='positiv'>Zdegradowano prawidłowo!</label>";}
        }

    }
    echo"<br><a href='zarzadzanie_admin.php'><button class='btn btn-primary'>Wróć do widoku zarządzania!</button></a></div>";
}else{
    header('Location: index.php');
    exit();
}

$db->close();
?>