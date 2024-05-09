<?php

$html = <<<HTML
    <form id="create-form">
        <div class="mb-2">
            <label for="" class="form-label">Post Title</label>
            <input id="post-title" name="postTitle" type="text" class="form-control">
        </div>

        <div class="mb-2">
            <label for="" class="form-label">Post Type</label>
            <input id="post-type" name="postType" type="text" class="form-control">
        </div>

        <div class="mb-2">
            <label for="" class="form-label">Event Description</label>
            <textarea class="form-control" name="eventDesc" id="eventDesc" cols="30" rows="10"></textarea>
        </div>

        <div class="mb-2">
            <label for="" class="form-label">Date of Event</label>
            <input id="date" name="date" type="date" min="1900-01-01" class="form-control">
        </div>

        <div class="mb-2">
            <label for="" class="form-label">Time Start</label>
            <input id="time-start" name="timeStart" type="time" class="form-control">
        </div>

        <div class="mb-2">
            <label for="" class="form-label">Time End</label>
            <input id="time-end" name="timeEnd" type="time" class="form-control">
        </div>

        <div class="mb-2">
            <label for="" class="form-label">Location</label>
            <input id="location" name="location" type="text" class="form-control">
        </div>

        <div class="mb-2">
            <label for="" class="form-label">Event Type</label>
            <select class="form-select" name="eventType" id="event-type">
                <option value="Event Type" hidden>Event Type</option>
                <option value="1">Recreational</option>
                <option value="2">Pensions</option>
                <option value="3">Health</option>
                <option value="4">Announcement</option>
            </select>
        </div>

        <div class="d-grid mb-4">
            <label for="" class="form-label">Images</label>
            <input id="image" name="image" type="file" accept=".jpg, .jpeg, .png" class="form-control">
        </div>
        
    </form>
    <div class="d-grid">
        <button class="btn btn-primary mb-2" id="create-post">Create Post</button>
        <button id="other-button" data-bs-dismiss="modal" class="btn btn-outline-primary">Cancel</button>
    </div>
HTML;

echo $html;
