<?php
session_start();
if(!$_SESSION['if_login']||!isset($_POST['login_submit'])){
    header('Location: index.php');
    exit();
}
$password=htmlentities($_POST['password'],ENT_QUOTES,"UTF-8");
if(isset($_POST['nowy_login'])) {
    $all_right = true;
    $login = htmlentities($_POST['nowy_login'],ENT_QUOTES,"UTF-8");
    $id = $_SESSION['id'];
    if (strlen($login) < 4 || strlen($login) > 20) {
        $all_right = false;
        $_SESSION['login_error'] = "Login musi posiadać od 4 do 20 znaków";
        header('Location: dane_konta.php');
    }
    if (ctype_alnum($login) == false) {
        $all_right = false;
        $_SESSION['login_error'] = "Login musi składać się wyłącznie z liter i cyfr (bez polskich znaków)";
        header('Location: dane_konta.php');
    }
    try{
        include ('database.php');
        $db=new mysqli($host,$database_user,$database_password,$database_name);
        if ($db->connect_errno!=0){
            throw new Exception(mysqli_connect_errno());
        }else{
            $result = $db->query("SELECT id FROM users WHERE login='$login'");
            if(!$result) throw new Exception($db->error);

            $how_much_login = $result->num_rows;
            if($how_much_login>0){
                $all_right=false;
                $_SESSION['login_error']='Ten login jest zajęty!';
                header('Location: dane_konta.php');
            }
            $result2 = $db->query("SELECT * FROM users WHERE id='$id'");
            if($result2){
                $haslo=$result2->fetch_assoc();
            }
            if(md5($password)!=$haslo['password']){
                $all_right=false;
                $_SESSION['login_error']="Błędne hasło!";
                header('Location: dane_konta.php');
            }

            if($all_right){
                if($db->query("UPDATE users SET login='".$_POST['nowy_login']."' WHERE id=".$_SESSION['id'])){
                    header("Location: dane_konta.php");
                    $_SESSION['info_o_edycji']="Login został zmieniony prawidłowo!";
                }else{
                    throw new Exception($db->error);
                }
            }
        }$db->close();
    }catch (Exception $e){
        //header('Location: dane_konta.php');
        echo '<span style="color:red">Błąd: '.$e.'</span>';
    };

}
?>