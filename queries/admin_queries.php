<?php

function adminLoginCheck($conn, $username, $password)
{
    $admin_sql = $conn->prepare("SELECT * FROM admin_tbl WHERE admin_username=?");
    $admin_sql->bind_param("s", $username);
    $admin_sql->execute();
    $admin_result = $admin_sql->get_result();
    $admin_row = mysqli_fetch_assoc($admin_result);
    $admin_count = mysqli_num_rows($admin_result);
    

    if ($admin_count === 1) {
        if($password == $admin_row['admin_password']){
            return true;
        }
    }
    return false;
}
