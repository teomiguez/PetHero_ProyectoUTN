<?php
    session_start();

    if (!isset($_SESSION['id']))
    {
        header("location: " . FRONT.ROOT . "Auth/ShowViewLogin");
    }
?>