<?php
session_start();
if($_SESSION['type']!='admin' || !isset($_SESSION['if_login'])){
    header('Location: index.php');
    exit();
}
include('template.php');
?>
<body>
<div>
<?php
echo "<table class='table table-striped' style='text-align: center;width: 50%' align='center'>
    <tr>
    <th>id</th>
    <th>Produkt</th>
    <th>Ilość w magazynie w kg</th>
    <th>Cena w zł</th>
    <th style='background-color: antiquewhite'>Złóż zamówienie</th>
    </tr>";
$db=new mysqli('localhost','root','','warzywniak');
if($db->connect_errno!=0){
    echo 'Błąd połączenia z bazą dancyh!';
}else {
    $sql = 'SELECT * FROM products';
    if ($result = $db->query($sql)) {
        while ($wiersz = $result->fetch_assoc()) {
            echo "<tr><td>" . $wiersz['id'] . "</td>" .
                "<td>" . $wiersz['name'] . "</td>" .
                "<td>" . $wiersz['quantity'] . "</td>" .
                "<td>" . $wiersz['price'] . "</td>" .
                "<td style='background-color: antiquewhite'>" . "<form action='edytuj_produkt.php?id=" . $wiersz['id'] . "' method='post'><input type='submit' class='btn btn-primary' value='Edytuj!' name='edytuj_produkt'></form>" . "</td></tr>";
        }
    }

    echo "</table>";
    echo "<br><div align='center'><a href='dodawanie_produktu.php'><button class='btn btn-success'>Dodaj nowy produkt!</button></a></div><br>";

    echo "<br><table class='table table-striped' style='text-align: center;width: 50%' align='center'>
    <tr>
    <th>id</th>
    <th>Login</th>
    <th>e-mail</th>
    <th>Typ konta</th>
    <th style='background-color: antiquewhite'>Edytuj konto</th>
    </tr>";
    $sql2='SELECT * FROM users';
    if($result2=$db->query($sql2)){
        while ($wiersz2=$result2->fetch_assoc()){
            echo "<tr><td>".$wiersz2['id']."</td>".
             "<td>".$wiersz2['login']."</td>".
             "<td>".$wiersz2['email']."</td>".
             "<td>".$wiersz2['type']."</td>";
              if($wiersz2['type']=='user'){ echo "<td style='background-color: antiquewhite'><form action='typ_usera.php?id=".$wiersz2['id']."' method='post'><input type='submit' value='Awansuj!' class='btn btn-primary' name='awansuj'></form></td>";
              }elseif ($wiersz2['type']=='admin'){ echo "<td style='background-color: antiquewhite'><form action='typ_usera.php?id=".$wiersz2['id']."' method='post'><input type='submit' value='Degraduj!' class='btn btn-primary' name='degraduj' style='color: red'></form></td>";

              }
        }echo "</table><br>";
    }
    echo "<table class='table table-striped' style='text-align: center;width: 80%' align='center'>
    <tr>
    <th>id</th>
    <th>Produkt</th>
    <th>Ilość w magazynie w kg</th>
    <th>Cena w zł</th>
    <th>Data złożenia</th>
    <th>id użytkownika</th>
    <th>Status</th>
    <th style='background-color: antiquewhite'>Edytuj status</th>
    </tr>";
$sql3='SELECT * FROM orders';
if($result3=$db->query($sql3)){
    while ($wiersz3 = $result3->fetch_assoc()) {
        echo "<tr><td>" . $wiersz3['id'] . "</td>" .
            "<td>" . $wiersz3['product'] . "</td>" .
            "<td>" . $wiersz3['quantity'] . "</td>" .
            "<td>" . $wiersz3['total_price'] . "</td>" .
            "<td>" . $wiersz3['create_date'] . "</td>" .
            "<td>" . $wiersz3['purchaser_id'] . "</td>" .
            "<td>" . $wiersz3['status'] . "</td>" .
            "<td style='background-color: antiquewhite'>" . "<form action='edytuj_zamowienie.php?id=" . $wiersz3['id'] . "' method='post'>
<div><input type='radio' name='nowy_status' value='Anulowane' id='status_form1'><label for='status_form1'>Anulowane</label></div>
<div><input type='radio' name='nowy_status' value='Kompletowanie' id='status_form2'><label for='status_form2'>Kompletowanie</label></div>
<div><input type='radio' name='nowy_status' value='Gotowe do odbioru' id='status_form3'><label for='status_form3'>Gotowe do odbioru</label></div>
<div><input type='radio' name='nowy_status' value='Zakończone' id='status_form4'><label for='status_form4'>Zakończone</label></div>
<input type='submit' value='Edytuj status' class='btn btn-primary' name='edytuj_status_sub'></form>" . "</td></tr>";
        }echo "</table>";
    }
}

$db->close();
?>
</div>
</body>
</html>