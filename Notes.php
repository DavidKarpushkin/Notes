<?php require_once('DataBases/db.php');


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Да уж</title>
    <link rel="stylesheet" type="text/css" href="CSS/Notes.css">
    <link type="image/x-icon" href="Icons/Favicon.png" rel="shortcut icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Didact+Gothic&family=Montserrat+Alternates:ital,wght@0,400;0,500;0,600;0,700;1,400&family=Open+Sans:wght@400;500;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>


<?php
//Удаление заметки
if(isset($_GET['DeleteNote'])){
    $idfordel = $_GET['DeleteNote'];

    $sql1 = ("DELETE FROM `UserNotes` WHERE id='$idfordel' ");
    if($conn ->query($sql1)){
        header("Location: index.php");
    }else{
        echo "Ошибка:". $conn-> connect_error;
    }
    $conn->close();
}

//Получение новых запсией
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $sql = "SELECT * FROM `UserNotes` WHERE id='$id' ";

    if($result = $conn->query($sql)){
        foreach($result as $val){

            $Title = $val['Title'];
            $Note = $val['Note'];
        }
    }
}?>

<form method="post" action="index.php">
    <div class="mda">
        <textarea spellcheck="false" class="Title" name="TitleFromText"><?php echo $Title?></textarea>
        <textarea   spellcheck="false" class="Note" name="NoteFromText"><?php echo $Note?></textarea>
        <input type="hidden" name="buttonNotes" value="<?php echo $val['id'];?>">
        <input type="submit" class="button"   value="Изменить">
    </div>
</form>
</body>
</html>

