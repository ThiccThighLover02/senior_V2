<?php
session_start();
include '../database/db_connect.php';
include '../queries/post_queries.php';

$target_dir = "";
$fileName;
$tempName;

if(isset($_FILES['image'])){
    $target_dir = '../assets/posts/';
    $fileName = $_FILES['image']['name'];
    $tempName = $_FILES['image']['tmp_name'];

    $targetFile = $target_dir . basename($fileName);

    if(move_uploaded_file($tempName, $targetFile)) {
        echo "The file " . basename($fileName) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

// this will handle the json input
// $json_data = file_get_contents('php://input');
// $received = json_decode($json_data, true);

// $data = array();

// foreach($received as $item){
//     $data[$item['name']] = $item['value'];
// }

//create an array to insert it into the 
$data = array(
    "postTitle" => $_POST['postTitle'],
    "postType" => $_POST['postType'],
    "eventDesc" => $_POST['eventDesc'],
    "date" => $_POST['date'],
    "timeStart" => $_POST['timeStart'],
    "timeEnd" => $_POST['timeEnd'],
    "location" => $_POST['location'],
    "eventType" => $_POST['eventType'],
    "fileName" => $fileName,
    "action" => "post"
);


if(isset($data['action']) && $data['action'] === 'post'){

    createPost($conn, $data);

    $response = array(
        "success" => true,
        "message" => "Post has been created",
    );

    echo json_encode($response);
}

elseif(isset($data['action']) && $data['action'] === 'update'){
    updatePost($conn, $data);

    $response = array(
        "success" => true,
        "message" => "Post has been updated"
    );
}

else{
    
    $response = array(
        "success" => false,
        "message" => "Action not defined"
    );
}

?>