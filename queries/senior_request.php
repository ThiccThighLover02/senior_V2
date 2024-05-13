<?php
session_start();
date_default_timezone_set('Asia/Manila');
if (isset($_SESSION['admin'])) {
    if (isset($_POST['action']) && $_POST['action'] === "request") {
        include '../database/db_connect.php';
        $extension = ".jpeg";

        //first let's handle the images
        $temp_profile = $_FILES['id_pic']['tmp_name']; //temporary name
        $profile_name = $_FILES['id_pic']['name']; //original name of file
        $profile_size = $_FILES['id_pic']['size']; //file size
        $profile_error = $_FILES['id_pic']['error']; //if there is any error

        $new_profile = uniqid("REQUEST-PROFILE", false) . $extension; //new name of the profile image
        $profile_path = "../assets/requests/profile/" . $new_profile; //new file path

        //handle birth certificate image
        $temp_birth = $_FILES['birth_certificate']['tmp_name']; //temporary name
        $birth_name = $_FILES['birth_certificate']['name']; //original name of file
        $birth_size = $_FILES['birth_certificate']['size']; //file size
        $birth_error = $_FILES['birth_certificate']['error']; //if there is any error

        $new_birth = uniqid("REQUEST-BIRTH", false) . $extension; //new name of the birth image
        $birth_path = "../assets/requests/birth_certificate/" . $new_birth; //new file path

        //handle barangay certificate image
        $temp_bar = $_FILES['barangay_certificate']['tmp_name']; //temporary name
        $bar_name = $_FILES['barangay_certificate']['name']; //original name of file
        $bar_size = $_FILES['barangay_certificate']['size']; //file size
        $bar_error = $_FILES['barangay_certificate']['error']; //if there is any error

        $new_bar = uniqid("REQUEST-BAR", false) . $extension; //new name of the barangay image
        $bar_path = "../assets/requests/bar_certificate/" . $new_bar; //new file path
        $other_health = $_POST['other_health'];

        //After we have finished with the images we'll move one to the other information
        $_POST['id_pic'] = $new_profile;
        $_POST['birth_certificate'] = $new_birth;
        $_POST['barangay_certificate'] = $new_bar;

        //execute the code using addRequest function, and conn and post info as parameters
        include './requests_queries.php'; //import this file so we can use the function below
        // if(requestExist($conn, $_POST)){
        //     $reponse = array(
        //         "success" => false,
        //         "message" => "Request has already been made"
        //     );
        //     echo json_encode($response);
        // }
        if (addRequest($conn, $_POST)) {
            global $temp_profile, $temp_birth, $temp_bar; //declare the global temporary values
            global $profile_path, $birth_path, $bar_path; //declare the new path for the images

            //We will only move the files once the data has been added to the database
            move_uploaded_file($temp_profile, $profile_path); //move uploaded file to new directory
            move_uploaded_file($temp_birth, $birth_path); //move uploaded file to new directory
            move_uploaded_file($temp_bar, $bar_path); //move uploaded file to new directory

            $response = array(
                "success" => true,
                "message" => "i changed the value"
            );

            echo json_encode($response);
        } else {
            $response = array(
                "success" => false,
                "message" => "There has been an error please try again"
            );
            echo json_encode($response);
        }
    }
}
