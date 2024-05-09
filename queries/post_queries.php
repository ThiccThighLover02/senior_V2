<?php

function createPost($conn, $data)
{
    $post_status = "posted";
    $date_now = new DateTime();

    //declare the variables that we are going to use
    $post_admin_id = 1;
    $post_title = $data['postTitle'];
    $post_type = $data['postType'];
    $event_id = $data['eventType'];
    $post_desc = $data['eventDesc'];
    $post_pic = $data['fileName'];
    $post_date = $data['date'];
    $date_created = $date_now->format("Y-m-d");
    $time_created = $date_now->format("H:i:s");
    $post_loc = $data['location'];
    $time_start = $data['timeStart'];
    $time_end = $data['timeEnd'];


    $create_post = $conn->prepare("INSERT INTO `activity_tbl`(`post_status`, `post_admin_id`, `post_title`, `post_type`, `event_type_id`, `post_description`, `post_pic`, `post_date`, `date_created`, `time_created`, `post_loc`, `time_start`, `time_end`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $create_post->bind_param("sississssssss", $post_status, $post_admin_id, $post_title, $post_type, $event_id, $post_desc, $post_pic, $post_date, $date_created, $time_created, $post_loc, $time_start, $time_end);

    $create_post->execute();
}

function updatePost($conn, $data)
{
    $date_now = new DateTime();
    //declare the variables that we are going to use
    $post_admin_id = 1;
    $post_title = $data['postTitle'];
    $post_type = $data['postType'];
    $event_id = $data['eventType'];
    $post_desc = $data['eventDesc'];
    $post_pic = $data['image'];
    $post_date = $data['date'];
    $date_created = $date_now->format("Y-m-d");
    $time_created = $date_now->format("H:i:s");
    $post_loc = $data['location'];
    $time_start = $data['timeStart'];
    $time_end = $data['timeEnd'];
    $post_id = $data['id'];

    $update_post = $conn->prepare("UPDATE `activity_tbl` SET `post_admin_id`=?, `post_title`=?, `post_type`=?, `event_type_id`=?, `post_description`=?, `post_pic`=?, `post_date`=?, `date_created`=?, `time_created`=?, `post_loc`=?, `time_start`=?, `time_end`=? WHERE post_id=?");

    $update_post->bind_param("ississssssssi", $post_admin_id, $post_title, $post_type, $event_id, $post_desc, $post_pic, $post_date, $date_created, $time_created, $post_loc, $time_start, $time_end, $post_id);

    $update_post->execute();
}
