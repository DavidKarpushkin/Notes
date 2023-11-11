<?php

require_once('DataBases/RegDataBase.php');

    $Username = $_POST['Username'];
    $Email = $_POST['Email'];
    $Pass = $_POST['Pass'];

    if(isset($_POST['SignIn'])) {
        $Error = array();
        if(empty($Username)){
            $Error[] = 'Введите имя';
        }if(empty($Pass)){
            $Error[] = 'Введите пароль';
        }if(empty($Email)){
            $Error[] = 'Введите Email';
        }
        if (strlen($Username) < 2 || strlen($Username) > 25) {
            $Error[] = 'Введите корректное имя';
        }if(strlen($Pass) < 8){
            $Error[] = 'Введите корректный пароль';
        }if(!$Error){
            $sql = "SELECT * FROM `User` WHERE `Username` = '$Username'";
            if($result = $conn2 ->query($sql)){
                foreach($result as $value){
                    $UserID = $value['Id'];
                    $Password = $value['Password'];
                    $User = $value['Username'];
                    $EmailFromDb = $value['Email'];

                    $VerifiedPass = Password_verify($Pass,$Password);
                }
            }if($Email == $EmailFromDb && $VerifiedPass === TRUE && $Username == $User){
                $_SESSION['logged_user'] = $Username;
                $_SESSION['Email'] = $Email;
                $_SESSION['id'] = $UserID;
               header("Location: index.php");

            }else{
                echo '<div class="errorfield">Пользователь не найден</div>';
            }
        }else{
            echo '<div class="errorfield">'.array_shift($Error).'</div>';
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="CSS/Autor.css">
    <link type="image/x-icon" href="Icons/Favicon.png" rel="shortcut icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&family=Montserrat+Alternates:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Open+Sans:wght@400;500;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="Block">
        <div class="Block1">
            <img src="Icons/Avatar.png"  class="img">
        </div>
<?php if(isset($_COOCKIE[$Username])){
    echo "CoockieName: $Username";
    echo "Value: $Email";
}?>
        <div class="Block2">
<form action="<?= $_SERVER['SCRIPT_FILE']?>" method="post">
    <input type="text" name="Username" class="user b" placeholder="Логин">
    <input type="email" name="Email" class="mail b" placeholder="Email">
    <input type="password" name="Pass" class="pass b" placeholder="Пароль">
    <button type="submit" name="SignIn" class="button">Войти</button>
</form>
        </div>
    </div>
</div>
</body>
</html>