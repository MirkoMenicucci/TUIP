<?php
    session_start();
    if ($_SESSION['ACCESS'] == ""){
        header("location:coming-soon.php");
    }
    $t=time();
    if (isset($_SESSION['logged']) && ($t - $_SESSION['logged'] > 1800)) {
        session_destroy();
        session_unset();
        header('location: coming-soon.php');
    }else {
        $_SESSION['logged'] = time();
    } 
?>