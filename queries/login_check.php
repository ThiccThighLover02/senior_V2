<?php
session_start();
include '../database/db_connect.php';
include '../queries/senior_queries.php';
include '../queries/admin_queries.php';

$json_data = file_get_contents('php://input');
$data = json_decode($json_data, true);


if (isset($data['username'])) {
    $username = $data['username'];
    $password = $data['password'];

    $response = array(
        "success" => false,
        "message" => "",
        "user" => ""
    );

    if (adminLoginCheck($conn, $username, $password)) {
        $response['success'] = "true";
        $response['message'] = "Login Success";
        $response['user'] = "admin";
        $_SESSION['admin'] = $username;
    } elseif (seniorLoginCheck($conn, $username, $password)) {
        $response['success'] = "true";
        $response['message'] = "Login Success";
        $response['user'] = 'senior';
        $_SESSION['senior'] = $username;
    }

    echo json_encode($response);
} else {
    $response = array(
        "success" => false,
        "message" => "Still no data received pak this shits"
    );

    echo json_encode($response);
}
