<?php
session_start();


$_SESSION['user_id'] = "";
session_destroy();

setcookie('username', "");
setcookie('password', "");

header('Location: ./');
?>