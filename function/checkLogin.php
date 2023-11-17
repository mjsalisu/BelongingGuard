<?php
    session_start();
    function checklogin() {
        if ($_SESSION["token"] == "") {
            $_SESSION["msg"] = '
            Please Login.';
            header("location: ./login.php");
        }
    }