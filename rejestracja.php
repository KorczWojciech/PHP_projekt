<?php
session_start();
if(isset($_SESSION['if_login'])&&$_SESSION['if_login']){
    header('Location: index.php');
    exit();
}
include('template.php');

if(isset($_POST['login'])){
    $all_right = true;
    $login=$_POST['login'];
    if(strlen($login)<4 || strlen($login)>20){
        $all_right=false;
        $_SESSION['login_error']="Login musi posiadać od 4 do 20 znaków";
    }
    if(ctype_alnum($login)==false){
        $all_right=false;
        $_SESSION['login_error']="Login musi składać się wyłącznie z liter i cyfr (bez polskich znaków)";
    }

    $password1=$_POST['password'];
    $password2=$_POST['password_check'];
    if(strlen($password1)<8||strlen($password1)>20){
        $all_right=false;
        $_SESSION['password_error']="Hasło musi posiadać od 8 do 20 znaków";
    }
    if($password1!=$password2){
        $all_right=false;
        $_SESSION['password_error']="Hasła nie są identyczne!";
    }
    $hash_password=md5($password1);

    $email=$_POST['email'];
    $email_verify = filter_var($email,FILTER_SANITIZE_EMAIL);
    if(!filter_var($email_verify,FILTER_VALIDATE_EMAIL) || $email!=$email_verify){
        $all_right=false;
        $_SESSION['email_error']="Podaj prawidłowy adres email!";
    }
    if(!isset($_POST['regulations'])){
        $all_right=false;
        $_SESSION['regulations_error']="Wymagane jest zaakceptowanie regulaminu!";
    }


    $_SESSION['tmp_login']=$login;
    $_SESSION['tmp_password1']=$password1;
    $_SESSION['tmp_password2']=$password2;
    $_SESSION['tmp_email']=$email;

    try{
        include ('database.php');
        $db=new mysqli($host,$database_user,$database_password,$database_name);
        if ($db->connect_errno!=0){
            throw new Exception(mysqli_connect_errno());
        }else{
            $result = $db->query("SELECT id FROM users WHERE email='$email'");
            if(!$result) throw new Exception($db->error);

            $how_much_email = $result->num_rows;
            if($how_much_email>0){
                $all_right=false;
                $_SESSION['email_error']='Istnieje inne konto na tym e-mailu!';
            }

            $result = $db->query("SELECT id FROM users WHERE login='$login'");
            if(!$result) throw new Exception($db->error);

            $how_much_login = $result->num_rows;
            if($how_much_login>0){
                $all_right=false;
                $_SESSION['login_error']='Ten login jest zajęty!';
            }

            if($all_right){
                if($db->query("INSERT INTO users VALUES (NULL, '$login', '$hash_password', '$email', 'user')")){
                    $_SESSION['register_correct']=true;
                    $_SESSION['register_correct_info']='Konto założone prawidłowo! Zaloguj się!';
                    header('Location: logowanie.php');
                }else{
                    throw new Exception($db->error);
                }
            }
            $db->close();
        }
    }catch (Exception $e){
        echo '<span style="color:red">Błąd: '.$e.'</span>';
    }


}

?>
<body>
<div align="center">
<h2>Załóż konto!</h2>
<form method="post">
    Login: <br> <input type="text" name="login" value="<?php
    if(isset($_SESSION['tmp_login'])){
        echo $_SESSION['tmp_login'];
        unset($_SESSION['tmp_login']);
    }
    ?>"/><br>
    <?php
    if(isset($_SESSION['login_error'])){
        echo '<div class="error">'.$_SESSION['login_error'].'</div>';
        unset($_SESSION['login_error']);
    }
    ?>
    Hasło: <br> <input type="password" name="password" value="<?php
    if(isset($_SESSION['tmp_password1'])){
        echo $_SESSION['tmp_password1'];
        unset($_SESSION['tmp_password1']);
    }
    ?>"/><br>
    <?php
    if(isset($_SESSION['password_error'])){
        echo '<div class="error">'.$_SESSION['password_error'].'</div>';
        unset($_SESSION['password_error']);
    }
    ?>
    Powtórz hasło: <br> <input type="password" name="password_check" value="<?php
    if(isset($_SESSION['tmp_password2'])){
        echo $_SESSION['tmp_password2'];
        unset($_SESSION['tmp_password2']);
    }
    ?>"/><br>
    E-mail: <br> <input type="email" name="email" value="<?php
    if(isset($_SESSION['tmp_email'])){
        echo $_SESSION['tmp_email'];
        unset($_SESSION['tmp_email']);
    }
    ?>"/><br>
    <?php
    if(isset($_SESSION['email_error'])){
        echo '<div class="error">'.$_SESSION['email_error'].'</div>';
        unset($_SESSION['email_error']);
    }
    ?><br>
    <input type="checkbox" name="regulations"> Akceptuję <a href="regulamin.php">regulamin</a><br>
    <?php
    if(isset($_SESSION['regulations_error'])){
        echo '<div class="error">'.$_SESSION['regulations_error'].'</div>';
        unset($_SESSION['regulations_error']);
    }
    ?>
    <input type="submit" class="btn btn-primary" value="Zarejestruj się!">
</form>
<br>
<a href="index.php"><button class="btn btn-success">Wróć do strony głównej!</button></a>
</div>
</body>
</html>