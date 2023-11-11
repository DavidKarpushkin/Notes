<?php
    include_once('DataBases/RegDataBase.php');


$UserName = $_POST['name'];
$Email = $_POST['Email'];
$Pass = $_POST['Password'];
$RePass = $_POST['Repassword'];

if(isset($_POST['SignUp']))
{
    $errors = array();
    if(empty($UserName) || strlen($UserName) > 25 || strlen($UserName) < 2){
        $errors[] = 'Введите имя пользователя';
    }if(empty($Email)){
        $errors[] = 'Введите ваш мейл';
    }  if (empty($Pass)){
        $errors[] = 'Введите пароль';
    }if (strlen($Pass) < 8){
        $errors[] = 'Пароль должен состоять не меньше 8 симовлов';
    }if($Pass != $RePass ){
        $errors[] = 'Пароли должны совпадать';
    }
    if(!$errors){
        $HashedPassword = password_hash($Pass, PASSWORD_DEFAULT);
        $sql = "INSERT INTO `User`(Username, Email, Password) VALUES ('$UserName', '$Email','$HashedPassword')";
        if ($conn2->query($sql)) {
            header("Location:Autorization.php");
        }}else{
        echo '<div class="errorfield">'.array_shift($errors).'</div>';
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
    <title>Регистрация</title>
    <link type="text/css" rel="stylesheet" href="CSS/Registr.css">
    <link type="image/x-icon" href="Icons/Favicon.png" rel="shortcut icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&family=Montserrat+Alternates:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Open+Sans:wght@400;500;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="container">

<div class="BlockForNotRegistered">
    <div class="Left_plate">
        <div class="circle"><img src="Icons/Avatar.png" width="270px" height="270px"></div>
    </div>
        <div class="Right_plate_forNotRegistered">
            <form action="<?= $_SERVER['SCRIPT_FILE']?>" method="post">
                <input type="text" class="name_plate field" name="name" placeholder="Логин">
                <input type="email" class="email_plate field" name="Email" placeholder="Email">
                <input type="password" class="pass_plate field" name="Password" placeholder="Пароль">
                <input type="password" class="repass_plate field" name="Repassword" placeholder="Повторите пароль">
                <button type="submit" class="SignUp " name="SignUp">Зарегистрироваться</button>
            </form>
        </div>
</div>
</body>
</html>