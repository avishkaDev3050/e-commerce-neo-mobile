<?php

session_start();

if (isset($_SESSION["u"])) {

    $_SESSION["u"] = null;
    session_destroy();
    header('location: index.php');

}

?>