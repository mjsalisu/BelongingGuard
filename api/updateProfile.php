<?php
error_reporting(0);
include("./dbcon.php");
include("../function/random.php");
include("../function/validate.php");

session_start();
// Update profile

if (isset($_POST["updateProfile"])) {

    $id = mysqli_real_escape_string($con, validate($_POST["id"]));
    $regNumber = mysqli_real_escape_string($con, validate($_POST["regNumber"]));
    $faculty = (mysqli_real_escape_string($con, validate($_POST["faculty"])));
    $department = (mysqli_real_escape_string($con, validate($_POST["department"])));

    $sql = "UPDATE `user_tbl` SET `regNo`='$regNumber',`faculty`='$faculty',`department`='$department' WHERE id = '$id'";
    $res = mysqli_query($con, $sql);
    if ($res) {
        $_SESSION["msg"] = '
        Account Updated successfull';
        header("location: ../profile.php");
    } else {
        $_SESSION["msg"] = '
        Oooops, something went wrong';
        header("location: ../profile.php");
    }
}

// updating password

if (isset($_POST["changePass"])) {
    $id = mysqli_real_escape_string($con, validate($_POST["id"]));
    $newPassword = mysqli_real_escape_string($con, validate($_POST["newPassword"]));


    $sql = "UPDATE `user_tbl` SET `password`='$newPassword' WHERE id = '$id'";
    $res = mysqli_query($con, $sql);
    if ($res) {
        $_SESSION["msg"] = '
        Password Updated successfull';
        header("location: ../profile.php");
    } else {
        $_SESSION["msg"] = '
        Oooops, something went wrong';
        header("location: ../profile.php");
    }
}
