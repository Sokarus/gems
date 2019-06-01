<?php
function loginCheck(){
    if (!$_SESSION['login']) { 
        header("Location: /autorization.php");
        die ("Вы не залогинены!");
    }
}