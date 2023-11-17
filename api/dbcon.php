<?php

$localhost = "localhost";
$username ="root";
$password = "";
$db = "mssn";

$con = mysqli_connect($localhost, $username, $password, $db);
if (mysqli_connect_errno()) {
    echo "Something went wrong, chech Database". mysqli_connect_error();
}
?>