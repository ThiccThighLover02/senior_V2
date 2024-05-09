<?php
session_start();

include '../database/db_connect.php';
include './requests_queries.php';
include './senior_queries.php';

$reponse = array(
    "success" => false,
    "message" => ""
);


if (isset($_SESSION['admin'])) {
    if (isset($_GET['id'])) {
        if (isset($_GET['action']) && $_GET['action'] === 'approve'){
            global $response;
            $request_id = $_GET['id'];

            $data = getRequestInfo($conn, $request_id);
            $status = 'approved';
            if (updateRequest($conn, $request_id, $status)) {
                if (addSenior($conn, $data, 'request')) {

                    $response['success'] = true;
                    $response['message'] = "Request has been approved";

                    echo json_encode($response);
                }
            } else {
                $response = array(
                    "success" => false,
                    "message" => "An error occurred, try again"
                );

                echo json_encode($response);
            }
        }
        elseif(isset($_GET['action']) && $_GET['action'] === 'reject'){
            global $response;
            $request_id = $_GET['id'];

            $data = getRequestInfo($conn, $request_id);
            $status = 'disapproved';
            if(updateRequest($conn, $request_id, $status)){
                $response = array(
                    "success" => true,
                    "message" => "Request has been rejected"
                );
                echo json_encode($response);
            } else{
                $reponse['message'] = "Something went wrong with the request, try again";
            }
        }
    }
}
