<?php //This file is used to get all the data required like posts birthdays etc

    function getPosts($conn){
        $post_status = 'Posted';
        $post_sql = $conn->prepare("SELECT * FROM activity_tbl WHERE post_status=? ORDER BY date_created DESC, time_created DESC");
        $post_sql->bind_param("s", $post_status);
        $post_sql->execute();
        $post_result = $post_sql->get_result();

        return mysqli_fetch_all($post_result, MYSQLI_ASSOC); //we will return the array of results
    }

    function getOnePost($conn, $id){
        $post_status = 'Posted';
        $post_sql = $conn->prepare("SELECT * FROM activity_tbl WHERE post_id=? AND post_status=?");
        $post_sql->bind_param("is", $id, $post_status);
        $post_sql->execute();
        $post_result = $post_sql->get_result();

        return mysqli_fetch_assoc($post_result);
    }
?>