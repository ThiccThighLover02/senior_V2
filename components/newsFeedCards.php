<?php
include '../database/db_connect.php';
include '../queries/getData.php';
$html = ''; //set the empty html string
if (isset($_GET['id']) && isset($_GET['modal'])) {
    $id = $_GET['id'];
    $post_row = getOnePost($conn, $id); //Get one post from this function

    $html .= <<<HTML
            <form data-form-id="{$id}" id="edit-form" class="mb-3">
                <div>
                    <label for="post-title" class="form-label">Post Title</label>
                    <input id="post-title" name="postTitle" type="text" class="form-control" value="{$post_row['post_title']}">
                </div>

                <div>
                    <label for="post-type" class="form-label">Post Type</label>
                    <input id="post-type" name="postType" type="text" class="form-control" value="{$post_row['post_type']}">
                </div>
                <div>
                    <label for="event-desc" class="form-label">Event Description</label>
                    <input id="event-desc" name="eventDesc" type="text" class="form-control" value="{$post_row['post_type']}">
                </div>
                <div>
                    <label for="date" class="form-label">Date of Event</label>
                    <input id="date" name="date" type="text" class="form-control" value="{$post_row['post_date']}">
                </div>
                <div>
                    <label for="" class="form-label">Time Start</label>
                    <input type="text" name="timeStart" class="form-control" value="{$post_row['time_start']}">
                </div>
                <div>
                    <label for="" class="form-label">Time End</label>
                    <input type="text" name="timeEnd" class="form-control" value="{$post_row['time_end']}">
                </div>
                <div>
                    <label for="" class="form-label">Location</label>
                    <input type="text" name="location" class="form-control" value="{$post_row['post_loc']}">
                </div>
                <div>
                    <label for="" class="form-label">Event Type</label>
                    <input type="text" name="eventType" class="form-control" value="{$post_row['event_type_id']}">
                </div>
                <div>
                    <label for="" class="form-label">Images</label>
                    <input type="text" name="image" class="form-control" value="{$post_row['post_pic']}">
                </div>
            </form>

            <div class="d-grid">
                <button id="update-button" class="btn btn-primary mb-2">Update Post</button>
                <button id="close-button" data-bs-dismiss="modal" class="btn btn-outline-danger">Delete</button>
            </div>

    HTML;

    echo $html;
} else { //get all the posts
    $post_row = getPosts($conn);
    $arr_count = count($post_row);

    if ($arr_count === 0) {
        $html = <<<HTML
            <h1>There are no new posts</h1>
        HTML;
    } else {

        foreach ($post_row as $row) {
            $html .= <<<HTML
            <div class="card mt-3 w-90" >
                <div class="card-header">
                    <div class="row d-flex justify-content-between">
                        <div class="col-8">
                            <div class="container-fluid d-flex gap-2 align-middle">
                                <img class="img-thumbnail rounded-circle embed-responsive embed-responsive-1by1" src="../assets/seniors/profile/2x2suit.jpg" style="width: 4vw;" alt="">
                                <div class="container">
                                    <h5>Carlson Magtalas</h5>
                                    <h6>April 21, 2024 8:38PM</h6>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-4 text-end">
                            <h3 id="edit" class="edit" data-card-id="{$row['post_id']}">...</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text">{$row['post_title']}</p>
                </div>
        HTML;

            if ($row['post_pic'] !== null) {
                $html .= <<<HTML
                <img src="../assets/posts/{$row['post_pic']}" class="card-img-top" alt="...">
            </div>
            HTML;
            }
        $html .= <<<HTML
            </div>
        HTML;
        }
    }

    echo $html;
}
