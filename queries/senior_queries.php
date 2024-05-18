<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function handleImage($orig_path, $folder, $new_path, $image_name)
{
    if (!file_exists($orig_path . $folder . $image_name)) {
        return false;
    } else {
        rename($orig_path . $folder . $image_name, $new_path . $folder . $image_name);
        return true;
    }
}


function addSenior($conn, $data, $method)
{

    require '../vendor/phpmailer/phpMailer/src/Exception.php';
    require '../vendor/phpmailer/phpMailer/src/PHPMailer.php';
    require '../vendor/phpmailer/phpMailer/src/SMTP.php';

    if ($method === 'request') {
        //let's declare all the variables that we need
        $random = random_int(1000, 9999);
        $message_id = hexdec(uniqid());
        $password = date("Y") . "-" . $random;
        $data_password = password_hash($password, PASSWORD_DEFAULT);
        $dateTime_created = date("Y-m-d H:i:s");
        $status = "Active";

        include '../phpqrcode/qrlib.php'; //This is what will generate the qr code
        $tempDir = '../assets/seniors/qr/';
        $codeContents = uniqid("senior", true); //This will be the contents of the qr code

        $fileName = $data['first_name'] . "-" . $data['last_name'] . "QR" . '.png';

        $pngAbsoluteFilePath = $tempDir . $fileName;
        $urlRelativeFilePath = $tempDir . $fileName;

        //let's generate the qr code
        if (!file_exists($pngAbsoluteFilePath)) { //if the file exists
            QRcode::png($codeContents, $pngAbsoluteFilePath);
        } else {
            unlink($pngAbsoluteFilePath);
            QRcode::png($codeContents, $pngAbsoluteFilePath);
        }

        // we will fix the images here
        $orig_path = "../assets/requests/";
        $new_path = "../assets/seniors/";

        //this will handle the check if images exist
        //if exists, it will move to senior folder, if not it will return an error
        if (!handleImage($orig_path, "bar_certificate/", $new_path, $data['barangay_certificate'])) {
            echo "an error has occurred with bar_certificate";
        } elseif (!handleImage($orig_path, "birth_certificate/", $new_path, $data['birth_certificate'])) {
            echo "an error has occurred with birth_certificate";
        } elseif (!handleImage($orig_path, "profile/", $new_path, $data['id_pic'])) {
            echo "an error has occurred with profile picture";
        }
        // this is where the images end

        include './guardian_queries.php';

        $senior_sql = $conn->prepare("INSERT INTO `senior_tbl`(`status`, `first_name`, `mid_name`, `last_name`, `extension`, `message_id`, `senior_purok_id`, `senior_barangay_id`, `senior_municipality_id`, `senior_province_id`, `date_birth`, `birth_place`, `sex`, `citizenship`, `blood_id`, `physical_id`, `health`, `education_id`, `cell_no`, `guardian_id`, `religion_id`, `civil_id`, `senior_email`, `senior_password`, `qr_image`, `id_pic`, `birth_certificate`, `bar_certificate`, `qr_contents`, `account_created`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $senior_sql->bind_param("sssssiiiiissssiisiiiiissssssss", $status, $data['first_name'], $data['middle_name'], $data['last_name'], $data['extension'], $message_id, $data['purok_id'], $data['barangay_id'], $data['municipality_id'], $data['province_id'], $data['birth_date'], $data['birth_place'], $data['sex'], $data['citizenship'], $data['blood_id'], $data['physical_id'], $data['health'], $data['request_education_id'], $data['cell_no'], $data['guardian_id'], $data['request_religion_id'], $data['request_civil_id'], $data['senior_email'], $data_password, $fileName, $data['id_pic'], $data['birth_certificate'], $data['barangay_certificate'], $codeContents, $dateTime_created);


        if ($senior_sql->execute()) {
            //First we have to send the email
            $subject = "Account Approval";
            $message = "Hello " . $data['first_name'] . " " . $data['last_name'] . ", your account has been approved. <br> You may proceed to the senior login page and enter the following credentials:<br>

            <h1>" . "Email: " . $data['senior_email'] . "</h1> <br>
            <h1>" . "Password: " . $password . "</h1>";

            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'seniorcitizensystem@gmail.com';
            $mail->Password = 'qkjtmhbkbuqnixdj';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('seniorcitizensystem@gmail.com');
            $mail->addAddress($data['senior_email']);
            $mail->isHTML(true);

            $mail->Subject = $subject;
            $mail->Body = $message;

            $mail->send();
            return true;
        } else {
            return false;
        }
    } elseif ($method === 'admin') {
        echo 'admin did this shit';
    }
}


function seniorLoginCheck($conn, $username, $password)
{
    $senior_sql = $conn->prepare("SELECT * FROM senior_tbl WHERE senior_email=?");
    $senior_sql->bind_param("s", $username);
    $senior_sql->execute();
    $senior_result = $senior_sql->get_result();
    $senior_row = mysqli_fetch_assoc($senior_result);
    $senior_count = mysqli_num_rows($senior_result);

    if ($senior_count === 1 && password_verify($password, $senior_row['senior_password'])) {
        return true;
    }

    return false;
}

function getAllSeniors($conn)
{
    $senior_sql = $conn->prepare("SELECT * FROM senior_tbl S INNER JOIN purok_tbl P ON S.senior_purok_id=P.purok_id INNER JOIN barangay_tbl B ON S.senior_barangay_id=B.barangay_id INNER JOIN municipality_tbl M ON S.senior_municipality_id=M.municipality_id INNER JOIN province_tbl Pr ON S.senior_province_id=Pr.province_id");
    $senior_sql->execute();
    $senior_result = $senior_sql->get_result();

    $senior_arr = array(); //declare array that will be returned

    while ($senior_row = $senior_result->fetch_assoc()) {
        $senior_arr[] = $senior_row;
    }

    return $senior_arr;
}

function getOneSenior($conn, $id)
{
    $senior_sql = $conn->prepare("SELECT * FROM senior_tbl S INNER JOIN purok_tbl P ON S.senior_purok_id=P.purok_id INNER JOIN barangay_tbl B ON S.senior_barangay_id=B.barangay_id INNER JOIN municipality_tbl M ON S.senior_municipality_id=M.municipality_id INNER JOIN province_tbl Pr ON S.senior_province_id=Pr.province_id INNER JOIN education_tbl E ON S.education_id=E.education_id INNER JOIN religion_tbl R ON S.religion_id=R.religion_id INNER JOIN civil_tbl C ON S.civil_id=C.civil_id INNER JOIN blood_tbl Bl ON S.blood_id=Bl.blood_id INNER JOIN physical_tbl Ph ON S.physical_id=Ph.physical_id INNER JOIN guardian_tbl G ON S.guardian_id=G.guardian_id WHERE senior_id=?");
    $senior_sql->bind_param("i", $id);
    if ($senior_sql->execute()) {
        $senior_result = $senior_sql->get_result();
        return mysqli_fetch_assoc($senior_result);
    } else {
        return false;
    }
}


function checkNo($conn, $no)
{ //check if number exists in senior 
    $senior_sql = $conn->prepare("SELECT senior_id FROM senior_tbl WHERE cell_no=?");
    $senior_sql->bind_param("i", $no);
    $senior_sql->execute();
    $senior_result = $senior_sql->get_result();

    $senior_count = mysqli_num_rows($senior_result);

    if ($senior_count > 0) {
        return true;
    } else {
        return false;
    }
}
