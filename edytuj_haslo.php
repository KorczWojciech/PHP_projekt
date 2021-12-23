<?php
session_start();
if(!$_SESSION['if_login']||!isset($_POST['password_submit'])){
    header('Location: index.php');
    exit();
}
$password=htmlentities($_POST['password'],ENT_QUOTES,"UTF-8");
if(isset($_POST['nowe_haslo1'])&&isset($_POST['nowe_haslo2'])) {
    $all_right = true;
    $id = $_SESSION['id'];
    $password1=$_POST['nowe_haslo1'];
    $password2=$_POST['nowe_haslo2'];
    if(strlen($password1)<6||strlen($password1)>20){
        $all_right=false;
        $_SESSION['password_error']="Hasło musi posiadać od 6 do 20 znaków";
        header('Location: dane_konta.php');
    }
    if($password1!=$password2){
        $all_right=false;
        $_SESSION['password_error']="Hasła nie są identyczne!";
        header('Location: dane_konta.php');

    }
    $hash_password=md5($password1);
    try {
        $db = new mysqli('localhost', 'root', '', 'warzywniak');
        if ($db->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
        } else {
            if(!$result2 = $db->query("SELECT * FROM users where id='$id'")){
                $all_right=false;
            }else{
                $haslo=$result2->fetch_assoc();
                $_SESSION['jakiehaslo']=$haslo['password'];
                if($haslo['password']!=md5($password)){
                    $all_right=false;
                    $_SESSION['password_error']='Aktualne hasło jest błędne!';
                    header('Location: dane_konta.php');
                }
            }
            if($all_right){
                $result = $db->query("UPDATE users SET password='".$hash_password."' WHERE id='$id'");
                if (!$result) throw new Exception($db->error);
                $_SESSION['info_o_edycji']='Hasło zmienione prawidłowo!';
                header('Location: dane_konta.php');
            }

        }$db->close();
    }catch (Exception $e){
        echo '<span style="color:red">Błąd: '.$e.'</span>';
    }

}
?>