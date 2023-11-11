<?php

require_once("DataBases/db.php");
require_once ("DataBases/RegDataBase.php");
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="CSS/AddNew.css">
    <link type="image/x-icon" href="Icons/Favicon.png" rel="shortcut icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&family=Montserrat+Alternates:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Open+Sans:wght@400;500;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <form action="<?php $_SERVER['SCRIPT_NAME']?>" method="post" class="form">
        <textarea type="text" name="NoteTitle" class="NoteTitle" placeholder="Введите заголовок"></textarea>
        <textarea type="text" name="Note" class="Note" placeholder="Введите текст"></textarea>
        <input class="button" name="button" type="submit" value="Добавить">
    </form>
</body>
</html>

<!--Создание новой заметки-->
<?php

    if(isset($_POST['button']) && isset($_SESSION['logged_user'])){
        $UserID = $_SESSION['id'];
        $Title = str_replace("'","\'",$_POST['NoteTitle']);
        $Note = str_replace("'","\'",$_POST['Note']);
        $sql = ("INSERT INTO `UserNotes` (`Noteid`,`Title`,`Note`) VALUES ('$UserID','$Title','$Note')");

        if($conn->query($sql)){
            header("Location:index.php");
        }else{
            echo "Ошибка:". $conn ->connect_error();
        }
    $conn->close();
    }
?>