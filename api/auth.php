<?php
error_reporting(0);
include("./dbcon.php");
include("../function/random.php");
include("../function/validate.php");

session_start();
// SIGNIN

if (isset($_POST["login"])) {

    $username = mysqli_real_escape_string($con, validate($_POST["username"]));
    $password = (mysqli_real_escape_string($con, validate($_POST["password"])));

    $sql = "SELECT * FROM `user` WHERE (email = '$username' OR phone = '$username') AND password = '$password';";
    $res = mysqli_query($con, $sql);
    if (mysqli_num_rows($res) > 0) {
        $userData = mysqli_fetch_assoc($res);
        $_SESSION["token"] = $userData["id"];
        $_SESSION["role"] = $userData["role"];
        header("location: ../index.php");
    } else {
        $_SESSION["msg"] = '
        Invalid Username Or Password.';
        header("location: ../login.php");
        // echo 'Error';
    }
}

// Register

if (isset($_POST["register"])) {
    $fullname = mysqli_real_escape_string($con, validate($_POST["fullname"]));
    $emailAddress = (mysqli_real_escape_string($con, validate($_POST["emailAddress"])));
    $phoneNumber = (mysqli_real_escape_string($con, validate($_POST["phoneNumber"])));
    $password = (mysqli_real_escape_string($con, validate($_POST["password"])));
    $sql = "INSERT INTO `user`(`name`, `email`, `phone`, `password`, `role`) VALUES ('$fullname','$emailAddress','$phoneNumber','$password','0')";
    $res = mysqli_query($con, $sql);
    if ($res) {
        $_SESSION["msg"] = '
        Account created successfull, Proceed to Login';
        header("location: ../register.php");
    } else {
        $_SESSION["msg"] = '
        Oooops, something went wrong';
        header("location: ../register.php");
    }
}
