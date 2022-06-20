<?php

session_start();

$_SESSION['NIVEL'];

if($_SESSION = 1){

    header("location: usuarioadm.   php");

}else{

    header("location: login.php");

}

?>
