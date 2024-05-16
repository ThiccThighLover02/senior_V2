<?php
date_default_timezone_set('Asia/Manila');

function addRequest($conn, $data){
    $current_dateTime = date("Y-m-d H:i:s"); //Current time of request
    $request_stat = "pending"; //Set the status of the request
    $serialized_health = serialize($data['other_health']);

    include './guardian_queries.php';
    $guardian_result = addGuardian($conn, $data);

    $request_sql = $conn->prepare("INSERT INTO `request_tbl`(`first_name`, `middle_name`, `last_name`, `extension`, `purok_id`, `barangay_id`, `municipality_id`, `province_id`, `birth_date`, `birth_place`, `sex`, `citizenship`, `blood_id`, `physical_id`, `health`, `request_education_id`, `senior_email`, `cell_no`, `guardian_id`, `request_civil_id`, `request_religion_id`, `id_pic`, `birth_certificate`, `barangay_certificate`, `request_dateTime`, `request_status`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $request_sql->bind_param("ssssiiiissssiisisiiiisssss", $data['first_name'], $data['mid_name'], $data['last_name'], $data['extension'], $data['purok'], $data['barangay'], $data['municipality'], $data['province'], $data['birth_date'], $data['birth_place'], $data['sex'], $data['citizenship'], $data['blood_type'], $data['physical_disability'], $serialized_health, $data['education'], $data['senior_email'], $data['cell_no'], $guardian_result['guardian_id'], $data['civil_stat'], $data['religion'], $data['id_pic'], $data['birth_certificate'], $data['barangay_certificate'], $current_dateTime, $request_stat);

    if($request_sql->execute()){
        return true; //if it has been executed return true
    } else {
        return false; //if not, return false
    }
}

function updateRequest($conn, $id, $status){
    $request_sql = $conn->prepare("UPDATE request_tbl SET request_status=? WHERE request_id=?");
    $request_sql->bind_param("si", $status, $id);
    if($request_sql->execute()){
        return true;
    } else {
        return false;
    }
}

function getRequest($conn, $method)
{
    if ($method === "count") {
        $request_stat = "pending";

        $request_sql = $conn->prepare("SELECT COUNT(*) as row_count FROM request_tbl WHERE request_status=?");
        $request_sql->bind_param("s", $request_stat);
        $request_sql->execute();
        $request_result = $request_sql->get_result();

        return $request_result->fetch_assoc();
    } elseif ($method === "all") {
        $request_stat = "pending";

        $request_sql = $conn->prepare("SELECT * FROM request_tbl WHERE request_status=?");
        $request_sql->bind_param("s", $request_stat);
        $request_sql->execute();
        $request_result = $request_sql->get_result();

        $request_arr = array();

        while ($request_row = $request_result->fetch_assoc()) {
            $request_arr[] = $request_row;
        }

        return $request_arr;
    }
}

function getRequestInfo($conn, $id){
    
    $request_sql = $conn->prepare("SELECT * FROM request_tbl R INNER JOIN purok_tbl P ON R.purok_id=P.purok_id INNER JOIN barangay_tbl B ON R.barangay_id=B.barangay_id INNER JOIN municipality_tbl M ON R.municipality_id=M.municipality_id INNER JOIN province_tbl Pr ON R.province_id=Pr.province_id INNER JOIN education_tbl E ON R.request_education_id=E.education_id INNER JOIN religion_tbl Re ON R.request_religion_id=Re.religion_id INNER JOIN civil_tbl C ON R.request_civil_id=C.civil_id INNER JOIN blood_tbl Bl ON R.blood_id=Bl.blood_id INNER JOIN guardian_tbl G ON R.guardian_id=G.guardian_id WHERE request_id=?");
    $request_sql->bind_param("i", $id);
    $request_sql->execute();
    $request_result = $request_sql->get_result();

    return mysqli_fetch_assoc($request_result);
}

function requestExist($conn, $data){ //This just checks if the request exists based on the name
    $status = "pending";
    $request_sql = $conn->prepare("SELECT * FROM request_tbl WHERE request_status=? first_name=? AND middle_name=? AND last_name=? AND extension=?");
    $request_sql->bind_param("sssss", $status, $data['first_name'], $data['mid_name'], $data['last_name'], $data['extension']);
    $request_sql->execute();

    $request_result = $request_sql->get_result();
    $request_count = $request_result->num_rows;

    if($request_count > 0){
        return true;
    } else {
        return false;
    }
}
