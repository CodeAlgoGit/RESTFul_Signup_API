<?php

$conn = mysqli_connect('localhost','thedigit_api','asdf@123!','thedigit_api_tutorial_db');

if(!$conn){
    die("Connection failed: ". mysqli_connect_error());
}

?>