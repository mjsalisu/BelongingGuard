<?php

error_reporting(0);
include("./dbcon.php");
include("../function/random.php");
include("../function/validate.php");

session_start();

$uploads_dir = '../uploads';

if (isset($_POST["addItem"])) {
    $trackId = generateRandomString();
    $regById = $_SESSION["token"];
    $itemName = mysqli_real_escape_string($con, validate($_POST["itemName"]));
    $itemType = mysqli_real_escape_string($con, validate($_POST["itemType"]));
    $itemQuantity = mysqli_real_escape_string($con, validate($_POST["itemQuantity"]));
    $itemDescription = mysqli_real_escape_string($con, validate($_POST["itemDescription"]));

    // return error if empty
    if (empty($itemName) || empty($itemType) || empty($itemQuantity) || empty($itemDescription)) {
        $_SESSION["msg"] = '
        All fields are required';
        header("location: ../item-reg.php");
        exit();
    }

    $itemImage = rand(1000, 10000) . "-" . $_FILES["itemImage"]["name"];
    $itemImage_tmp = $_FILES["itemImage"]["tmp_name"];
    move_uploaded_file($itemImage_tmp, $uploads_dir . '/' . $itemImage);

    $sql = "INSERT INTO `item_tbl`(`regById`, `trackId`, `itemName`, `itemType`, `itemQuantity`, `itemImage`, `itemDescription`, `status`) VALUES ('$regById','$trackId','$itemName','$itemType','$itemQuantity','$itemImage','$itemDescription','0')";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $_SESSION["msg"] = '
        Your item has been registered successfully and is awaiting approval';
        header("location: ../item-reg.php");
    } else {
        $_SESSION["msg"] = '
        Oooops, something went wrong';
        header("location: ../item-reg.php");
    }
}
