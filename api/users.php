<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST, PUT, PATCH, GET, DELETE');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

require_once "../config/Database.php";
require_once "../Classes/User.class.php";

$db=new config\Database;
$user = new Classes\User;
$conn=$db->connect();

if ($_SERVER['REQUEST_METHOD']=="POST") {
    
    $data=json_decode(file_get_contents("php://input"));

    $user->full_name=$data->full_name;
    $user->username=$data->username;
    $user->email=$data->email;
    $user->password=$data->password;

    if ($user->insertUser($conn)) {
        echo json_encode(
            array(
                "message"=>"User created!"
            )
        );
    }else{
        echo json_encode(
            array(
                "message"=>"User not created!"
            )
        );
    }

}


