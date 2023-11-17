<?php

error_reporting(0);
include("./dbcon.php");
include("../function/random.php");
include("../function/validate.php");

session_start();

$uploads_dir = '../uploads';

if (isset($_POST["addItem"])) {
    $trackId = generateRandomString();

    $id = mysqli_real_escape_string($con, validate($_POST["id"]));
    $itemName = mysqli_real_escape_string($con, validate($_POST["itemName"]));
    $itemType = mysqli_real_escape_string($con, validate($_POST["itemType"]));
    $itemQuantity = mysqli_real_escape_string($con, validate($_POST["itemQuantity"]));
    $itemDescription = mysqli_real_escape_string($con, validate($_POST["itemDescription"]));

    $itemImage = rand(1000, 10000) . "-" . $_FILES["itemImage"]["name"];
    $itemImage_tmp = $_FILES["itemImage"]["tmp_name"];
    move_uploaded_file($itemImage_tmp, $uploads_dir . '/' . $itemImage);

    $sql = "INSERT INTO `item_tbl`(`userId`, `trackId`, `itemName`, `itemType`, `itemQuantity`, `itemImage`, `itemDescription`, `status`) VALUES ('$id','$trackId','$itemName','$itemType','$itemQuantity','$itemImage','$itemDescription','0')";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $_SESSION["msg"] = '
        Item Registered successfull';
        header("location: ../item_reg.php");
    } else {
        $_SESSION["msg"] = '
        Oooops, something went wrong';
        header("location: ../item_reg.php");
    }
}
