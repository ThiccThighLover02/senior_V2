<?php
    session_start();
    if(isset($_SESSION['admin'])){
?>
<!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php
        $link = "users";
        include_once '../links.php';
        ?>
        <link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.5/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/fh-4.0.1/r-3.0.2/sc-2.4.1/sp-2.3.1/sr-1.4.1/datatables.min.css" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link rel="stylesheet" href=<?= $bootstrap_css ?>>
        <title>Calendar</title>
    </head>

    <body class="bg-light overflow-hidden">
        <?php
        $user = "admin";
        $active = "calendar";
        include '../components/dashboardNavbar.php';
        ?>
        <div class="row" id="sideMenu">
            <div class="col-lg-3 d-grid gap-2">
                <?php
                include '../components/sideMenu.php';
                ?>
            </div>
            <div class="col-lg-8 bg-white d-flex justify-content-start p-2" id="calendar">
                <div id="spinner" class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                    
                </div>
            </div>
        </div>
    </body>

    <script src=<?= $bootstrap_js ?>></script>
    <script src="../dist/getEvents.bundle.js"></script>

    </html>
<?php
    }
?>