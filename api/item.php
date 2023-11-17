<?php

error_reporting(0);
include("./dbcon.php");
include("../function/random.php");
include("../function/validate.php");
session_start();
$uploads_dir = '../uploads';

// Register item
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

// Check-in or Reject item
if (isset($_POST["approveItem"]) || isset($_POST["rejectItem"])) {
    $checkInById = $_SESSION["token"];
    $trackingId = 'H1IZIEL';
    $itemName = mysqli_real_escape_string($con, validate($_POST["itemName"]));
    $itemType = mysqli_real_escape_string($con, validate($_POST["itemType"]));
    $itemQuantity = mysqli_real_escape_string($con, validate($_POST["itemQuantity"]));
    $itemDescription = mysqli_real_escape_string($con, validate($_POST["itemDescription"]));
    $checkInDate = $timestamp;
    $checkInNote = mysqli_real_escape_string($con, validate($_POST["checkInNote"]));
    if (isset($_POST["rejectItem"])) {
        $status = 1; // rejectItem
    } else {
        $status = 2; // approveItem
    }

    // return error if empty
    if (empty($itemName) || empty($itemType) || empty($itemQuantity) || empty($itemDescription)) {
        $_SESSION["msg"] = '
        All fields are required';
        header("location: ../checkin.php");
        exit();
    }

    $sql = "UPDATE `item_tbl` SET `itemName`='$itemName',`itemType`='$itemType',`itemQuantity`='$itemQuantity',`itemDescription`='$itemDescription',`checkInBy`='$checkInById',`checkInDate`='$checkInDate',`checkInNote`='$checkInNote',`status`=$status WHERE trackId='$trackingId'";
    $res = mysqli_query($con, $sql);
    if ($res) {
        $_SESSION["msg"] = '
       Item has been check-in successful';
        header("location: ../checkin.php");
    } else {
        $_SESSION["msg"] = '
        Oooops, something went wrong';
        header("location: ../checkin.php");
    }
}

// Check-out item
if (isset($_POST["approveItem"]))) {
    $checkInById = $_SESSION["token"];
    $trackingId = 'H1IZIEL';
    $itemName = mysqli_real_escape_string($con, validate($_POST["itemName"]));
    $itemType = mysqli_real_escape_string($con, validate($_POST["itemType"]));
    $itemQuantity = mysqli_real_escape_string($con, validate($_POST["itemQuantity"]));
    $itemDescription = mysqli_real_escape_string($con, validate($_POST["itemDescription"]));
    $checkInDate = $timestamp;
    $checkInNote = mysqli_real_escape_string($con, validate($_POST["checkInNote"]));
    $status = 2; // approveItem

    // return error if empty
    if (empty($itemName) || empty($itemType) || empty($itemQuantity) || empty($itemDescription)) {
        $_SESSION["msg"] = '
        All fields are required';
        header("location: ../checkin.php");
        exit();
    }

    $sql = "UPDATE `item_tbl` SET `itemName`='$itemName',`itemType`='$itemType',`itemQuantity`='$itemQuantity',`itemDescription`='$itemDescription',`checkInBy`='$checkInById',`checkInDate`='$checkInDate',`checkInNote`='$checkInNote',`status`=$status WHERE trackId='$trackingId'";
    $res = mysqli_query($con, $sql);
    if ($res) {
        $_SESSION["msg"] = '
       Item has been check-in successful';
        header("location: ../checkin.php");
    } else {
        $_SESSION["msg"] = '
        Oooops, something went wrong';
        header("location: ../checkin.php");
    }
}