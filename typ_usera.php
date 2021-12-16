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