<?php
session_start();
if(!$_SESSION['if_login']||!isset($_POST['email_submit'])){
    header('Location: index.php');
    exit();
}
$password=htmlentities($_POST['password'],ENT_QUOTES,"UTF-8");
$id = $_SESSION['id'];
if(isset($_POST['nowy_email'])){
    $all_right = true;
    $email=$_POST['nowy_email'];
    $email_verify = filter_var($email,FILTER_SANITIZE_EMAIL);
    if(!filter_var($email_verify,FILTER_VALIDATE_EMAIL) || $email!=$email_verify){
        $all_right=false;
        $_SESSION['email_error']="Podaj prawidłowy adres email!";
        header('Location: dane_konta.php');
    }
    try {
        $db=new mysqli('localhost','root','','warzywniak');
        if ($db->connect_errno!=0){
            throw new Exception(mysqli_connect_errno());
        }else{
            $result = $db->query("SELECT id FROM users WHERE email='$email'");
            if(!$result) throw new Exception($db->error);

            $how_much_email = $result->num_rows;
            if($how_much_email>0){
                $all_right=false;
                $_SESSION['email_error']='Istnieje inne konto na tym e-mailu!';
                header('Location: dane_konta.php');
            }
            $result2 = $db->query("SELECT * FROM users WHERE id='$id'");
            if($result2){
                $haslo=$result2->fetch_assoc();
            }
            if(md5($password)!=$haslo['password']){
                $all_right=false;
                $_SESSION['email_error']="Błędne hasło!";
                header('Location: dane_konta.php');
            }
            if($all_right){
                if($db->query("UPDATE users SET email='".$email."' WHERE id='$id'")){
                    $_SESSION['info_o_edycji']='E-mail został zmieniony prawidłowo!';
                    header('Location: dane_konta.php');
                }else{
                    throw new Exception($db->error);
                }
            }
        }

    }catch (Exception $e){
        echo '<span style="color:red">Błąd: '.$e.'</span>';
    }
}
?>