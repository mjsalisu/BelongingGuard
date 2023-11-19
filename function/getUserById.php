<?php
    error_reporting(0);
    include("../api/dbcon.php");
    session_start();

    function getUserById($id, $con) {
        $sqlUser = "SELECT * FROM `user` WHERE id = '$id'";
        $resultUser = mysqli_query($con, $sqlUser);
        $userDataById = mysqli_fetch_assoc($resultUser);

        return $userDataById;
    }
    
    // test getUserById(5)
    // $userId = 5;
    // $user = getUserById($userId, $con);

    // Now $user contains the user data for the user with ID 5
    // echo $user["name"];
    // echo $user["email"];
?>
