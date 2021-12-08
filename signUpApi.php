<?php

//include connection
include('conn.php');

$inputJson = file_get_contents("php://input");

$obj = json_decode($inputJson);

$_userName = trim($obj->{'userName'});
$_userEmail = trim($obj->{'userEmail'});
$_userMobile = trim($obj->{'userMobile'});
$_userPass = trim($obj->{'userPass'});

$_msg = "";
if(($_userName == "") && ($_userEmail == "") && ($_userMobile == "") && ($_userPass == "")){
    
    $response->r_msg = "empty";
    header('Content-type: application/json');
    echo(json_encode($response));
}
else{

    $sql_query_select = mysqli_query($conn, "SELECT `id` FROM `user_details_tbl` WHERE `user_mobile` = '$_userMobile'");
    if(mysqli_num_rows($sql_query_select) > 0){
        $_msg = "mobile number already exist";
    }
    else{
        $sql_query_insert = mysqli_query($conn, "INSERT INTO `user_details_tbl`(`user_name`, `user_email`, `user_mobile`, `user_pass`) 
        VALUES ('$_userName', '$_userEmail', '$_userMobile', '$_userPass')");
        if($sql_query_insert){
            $_msg = "success";
        }
        else{
            $_msg = "failed";
        }
    }

    $response->r_msg = $_msg;
    header('Content-type: application/json');
    echo(json_encode($response));
}


?>