<?php
function getPurok($conn)
{
    $purok_sql = $conn->prepare('SELECT * FROM purok_tbl');
    $purok_sql->execute();
    $purok_result = $purok_sql->get_result();
    $purok_arr = $purok_result->fetch_all(MYSQLI_ASSOC);

    return $purok_arr;
}

function getBarangay($conn)
{
    $barangay_sql = $conn->prepare('SELECT * FROM barangay_tbl');
    $barangay_sql->execute();
    $barangay_result = $barangay_sql->get_result();
    $barangay_arr = $barangay_result->fetch_all(MYSQLI_ASSOC);

    return $barangay_arr;
}

function getMunicipality($conn)
{
    $municipality_sql = $conn->prepare('SELECT * FROM municipality_tbl');
    $municipality_sql->execute();
    $municipality_result = $municipality_sql->get_result();
    $municipality_arr = $municipality_result->fetch_all(MYSQLI_ASSOC);

    return $municipality_arr;
}

function getProvince($conn)
{
    $province_sql = $conn->prepare('SELECT * FROM province_tbl');
    $province_sql->execute();
    $province_result = $province_sql->get_result();
    $province_arr = $province_result->fetch_all(MYSQLI_ASSOC);

    return $province_arr;
}

function getBlood($conn)
{
    $blood_sql = $conn->prepare('SELECT * FROM blood_tbl');
    $blood_sql->execute();
    $blood_result = $blood_sql->get_result();
    $blood_arr = $blood_result->fetch_all(MYSQLI_ASSOC);

    return $blood_arr;
}

function getPhysical($conn)
{
    $physical_sql = $conn->prepare('SELECT * FROM physical_tbl');
    $physical_sql->execute();
    $physical_result = $physical_sql->get_result();
    $physical_arr = $physical_result->fetch_all(MYSQLI_ASSOC);

    return $physical_arr;
}

function getEducation($conn)
{
    $education_sql = $conn->prepare('SELECT * FROM education_tbl');
    $education_sql->execute();
    $education_result = $education_sql->get_result();
    $education_arr = $education_result->fetch_all(MYSQLI_ASSOC);

    return $education_arr;
}

function getReligion($conn)
{
    $religion_sql = $conn->prepare('SELECT * FROM religion_tbl');
    $religion_sql->execute();
    $religion_result = $religion_sql->get_result();
    $religion_arr = $religion_result->fetch_all(MYSQLI_ASSOC);

    return $religion_arr;
}

function getCivil($conn)
{
    $civil_sql = $conn->prepare('SELECT * FROM civil_tbl');
    $civil_sql->execute();
    $civil_result = $civil_sql->get_result();
    $civil_arr = $civil_result->fetch_all(MYSQLI_ASSOC);

    return $civil_arr;
}