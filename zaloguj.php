<?php
session_start();

if(!isset($_POST['login'])||(!isset($_POST['password']))){
    header('Location: logowanie.php');
    exit();
}
include ('database.php');
$db=new mysqli($host,$database_user,$database_password,$database_name);

if($db->connect_errno!=0){
    echo 'Błąd połączenia z bazą danych!';
}else{
    $login=htmlentities($_POST['login'],ENT_QUOTES,"UTF-8");
    $password=htmlentities($_POST['password'],ENT_QUOTES,"UTF-8");

    $sql = sprintf("SELECT * FROM users WHERE login='%s'", mysqli_real_escape_string($db,$login));
    if($result = $db->query($sql)){
        $users = $result->num_rows;
        if($users>0){
            $wiersz = $result->fetch_assoc();
            if(md5($password)==$wiersz['password']){
                $_SESSION['if_login']=true;

                $_SESSION['id']=$wiersz['id'];
                $_SESSION['login']=$wiersz['login'];
                $_SESSION['email']=$wiersz['email'];
                $_SESSION['type']=$wiersz['type'];

                $result->close();
                if($_SESSION['type']=='user'){
                    header("Location: zamowienia_user.php");
                } elseif ($_SESSION['type']=='admin'){
                    header("Location: zarzadzanie_admin.php");
                }
            }else{
                $_SESSION['error']='<span style="color: red">Nieprawidłwoy login lub hasło!</span>';
                header('Location: logowanie.php');
            }
        }else{
            $_SESSION['error']='<span style="color: red">Nieprawidłwoy login lub hasło!</span>';
            header('Location: logowanie.php');
        }
    }
}


$db->close();
?>