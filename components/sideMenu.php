<?php
include '../database/db_connect.php';
include '../queries/requests_queries.php';

if ($user === 'admin') {
    $request_count = getRequest($conn, "count");
?>
    <script src="https://kit.fontawesome.com/ebda93f076.js" crossorigin="anonymous"></script>
    <div class="offcanvas-lg offcanvas-start" tabindex="-1" id="sideMenuCanvas" aria-labelledby="offcanvasLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasLabel">Admin</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-grid">
            <div class="list-group list-group-flush border-bottom">
                <a href="admin_home.php" class="list-group-item list-group-item-lg fs-4 <?= $active === 'home' ? "bg-dark text-white" : "" ?>"><i class="fa-regular fa-newspaper"></i> News Feed</a>

                <a href="admin_senior.php" class="list-group-item list-group-item-lg fs-4 <?= $active === 'senior' ? "bg-dark text-white" : "" ?>"><i class="fa-solid fa-person-cane"></i> Seniors</a>

                <a href="admin_requests.php" class="list-group-item list-group-item-lg fs-4 d-flex justify-content-between align-items-center <?= $active === 'requests' ? "bg-dark text-white" : "" ?>"><div><i class="fa-regular fa-file"></i> Requests</div> <?= $request_count['row_count'] > 0 ? '<span class="badge bg-info">' . $request_count['row_count'] . '</span>' : "" ?></a>

                <a href="" class="list-group-item list-group-item-lg fs-4 <?= $active === 'events' ? "bg-dark text-white" : "" ?>"><i class="fa-regular fa-address-book"></i> Event Logs</a>

                <a href="admin_calendar.php" class="list-group-item list-group-item-lg fs-4 <?= $active === 'calendar' ? "bg-dark text-white" : "" ?>"><i class="fa-regular fa-calendar-days"></i> Calendar</a>
                
                <a href="" class="list-group-item list-group-item-lg fs-4 <?= $active === 'activities' ? "bg-dark text-white" : "" ?>"><i class="fa-solid fa-person-running"></i> Activities</a>
                <a href="" class="list-group-item list-group-item-lg fs-4"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
            </div>
        </div>
    </div>

<?php
} elseif ($user === 'senior') {
?>

    <h1>This is senior side menu</h1>

<?php
}

?>