<?php

// include connection file
include("conn.php");

$inputJson = file_get_contents("php://input");

header("Content-type: applection/json");

$obj = json_decode($inputJson);

$_userMobileNo = $obj->{'userId'};
$_userPass = $obj->{'userPass'};

$_msg = "";

if(($_userMobileNo == "") || ($_userPass == "")){
    $response->r_msg = "empty";
    echo(json_encode($response));
}
else{

    $sql_query_select_user = mysqli_query($conn, "SELECT `id` FROM `user_details_tbl` WHERE `user_mobile` = '$_userMobileNo'");
    if(mysqli_num_rows($sql_query_select_user) > 0){

        $sql_query_auth_user = mysqli_query($conn, "SELECT `id` FROM `user_details_tbl` WHERE `user_mobile` = '$_userMobileNo' AND `user_pass` = '$_userPass'");
        if(mysqli_num_rows($sql_query_auth_user) > 0){
            $row_data = mysqli_fetch_assoc($sql_query_auth_user);
            $userId = $row_data['id'];

            $response->r_msg = "success";
            $response->r_userId = $userId;
            echo(json_encode($response));
        }
        else{
            $response->r_msg = "wrong password";
            echo(json_encode($response));
        }
    }
    else{
        $response->r_msg = "wrong user id";
        echo(json_encode($response));
    }
}

?>