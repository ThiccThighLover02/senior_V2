<?php //This file is used to get all the data required like posts birthdays etc

if(isset($_GET['method']) && $_GET['method'] === "calendar"){
    include '../database/db_connect.php';
    getAllActivities($conn);
}


function getPosts($conn)
{
    $post_status = 'Posted';
    $post_sql = $conn->prepare("SELECT * FROM activity_tbl WHERE post_status=? ORDER BY date_created DESC, time_created DESC");
    $post_sql->bind_param("s", $post_status);
    $post_sql->execute();
    $post_result = $post_sql->get_result();

    return mysqli_fetch_all($post_result, MYSQLI_ASSOC); //we will return the array of results
}

function getOnePost($conn, $id)
{
    $post_status = 'Posted';
    $post_sql = $conn->prepare("SELECT * FROM activity_tbl WHERE post_id=? AND post_status=?");
    $post_sql->bind_param("is", $id, $post_status);
    $post_sql->execute();
    $post_result = $post_sql->get_result();

    return mysqli_fetch_assoc($post_result);
}

function getAllActivities($conn)
{
    $activities_sql = $conn->prepare("SELECT * FROM activity_tbl");
    if ($activities_sql->execute()) {
        $activities_array = array();

        $activities_results = $activities_sql->get_result();
        while ($activities_row = mysqli_fetch_assoc($activities_results)) {
            $activities_array[] = $activities_row;
        }

        echo json_encode($activities_array);
    } else {
        echo "something went wrong, idk what, but something wrong.";
    }
}
