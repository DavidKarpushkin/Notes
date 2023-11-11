<?php

require_once("DataBases/db.php");
require_once("DataBases/RegDataBase.php");
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Главная страница</title>
    <link rel="stylesheet" type="text/css" href="CSS/index.css">
    <link type="image/x-icon" href="Icons/Favicon.png" rel="shortcut icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&family=Montserrat+Alternates:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Open+Sans:wght@400;500;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
<!--СМЭЭЭЭЭЭЭЭЭЭРТЬ-->
    <div class="header">
        <div class="fst">
            <?php if(isset($_SESSION['logged_user'])):?>
                <span class="UserName"><?php echo $_SESSION['logged_user'];?></span>
            <a href="Logout.php" class="LogOut">Выйти</a>
            <?php else:?>
                <a class="fst_page_buttons" href="Registration.php">Зарегистрироваться</a>
                <a class="fst_page_buttons2" href="Autorization.php">Войти</a>
            <?php endif;?>
        </div>

<!--Обновление заметки-->
<?php
if(isset($_SESSION['logged_user'])){
    if(isset($_POST['buttonNotes'])){
        $id = $_POST['buttonNotes'];
        $UserID = $_SESSION['id'];
        $Title = str_replace("'","\'",$_POST['TitleFromText']);
        $Notes = str_replace("'","\'",$_POST['NoteFromText']);
        $sql = "UPDATE `UserNotes` SET Title = '$Title',Note = '$Notes' WHERE id='$id'";

        if($conn->query($sql)){
        }else{
            echo "Ошибка:". $conn -> connect_error();
        }

    }
?>
<div class="block_for_plates">
<a class="fst_page_buttons2" href="AddNew.php">Добавить</a>
<!--Вывод заметки и отправка ее Id в Notes.php-->
<?php
// получение из бд всех данных для пользователя с уникальным индексом
if(isset($_SESSION['logged_user'])){
$userid = $_SESSION['id'];
    $sql = "SELECT * FROM UserNotes WHERE NoteId = '$userid'";
    if($result = $conn->query($sql)){
        foreach ($result as $value) {
?>

<!--Продолжение цикла в котором выводятся все поля для пользователя-->
    <form class="form" action="Notes.php" method="get">
        <a class="plates" href="<?php echo '/Note.php?id=' .$value['id'];?>">
            <span class="Notes"><?php echo $value['Title']?></span>
            <span class="textarea"><?php if(mb_strlen( $value['Note']) >= 50){
                echo  mb_substr($value['Note'],0,50)."...";
                }else{
                echo $value['Note'];
                }?>
            </span>
        </a>
        <input type="submit" name="DeleteNote" class="delete" value="<?php echo $value['id'];?>">
    </form>
        <?php
            }
        }
    }
}
?>

        </div>
    </div>
</body>
</html>