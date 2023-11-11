<?php

require_once ('DataBases/RegDataBase.php');

unset($_SESSION['logged_user']);

header("Location:index.php");