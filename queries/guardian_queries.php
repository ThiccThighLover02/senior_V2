<?php

function addGuardian($conn, $data){
    $guardian_sql = $conn->prepare("INSERT INTO `guardian_tbl`(`guardian_firstN`, `guardian_midN`, `guardian_lastN`, `guardian_extension`, `emergency_no`) VALUES (?, ?, ?, ?, ?)");

    $guardian_sql->bind_param("ssssi", $data['guardian_first'], $data['guardian_mid'], $data['guardian_last'], $data['guardian_extension'], $data['guardian_no']);

    if($guardian_sql->execute()){
        return ["success" => true, "guardian_id" => $guardian_sql->insert_id];
    } else {
        return ["success" => false, "guardian_id" => 0];
    }
}

function getGuardian($conn, $id){
    $guardian_sql = $conn->prepare("SELECT guardian_id FROM guardian_tbl WHERE guardian_id=?");
    $guardian_sql->bind_param("i", $id);

    if($guardian_sql->execute()){
        $guardian_result = $guardian_sql->get_result();
        return $guardian_result->fetch_assoc();
    }
}