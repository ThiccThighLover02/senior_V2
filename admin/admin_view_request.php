<?php
session_start();
if (isset($_SESSION['admin']) && $_SESSION['admin'] === "admin") {
    $request_id = $_GET['id'];
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.5/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/fh-4.0.1/r-3.0.2/sc-2.4.1/sp-2.3.1/sr-1.4.1/datatables.min.js"></script>
        <link rel="stylesheet" href=<?= $bootstrap_css ?>>
        <title>Document</title>
    </head>

    <body class="bg-light overflow-hidden">
        <?php
        $user = "admin";
        $active = "requests";
        include '../components/dashboardNavbar.php';
        ?>
        <div class="row" id="sideMenu">
            <div class="col-lg-3 d-grid gap-2">
                <?php
                include '../components/sideMenu.php';
                ?>
            </div>
            <div class="col-lg-6 pt-2 bg-white overflow-auto d-flex justify-content-center align-items-center" id="profile-container" style="height: 85vh;">
                <div id="spinner" class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div class="col-lg-3">
                <div id="button-container" data-request-id=<?= $request_id ?> class="container-fluid d-grid gap-2 mt-3">
                    <button id="view-attach" class="btn btn-primary text-start text-white"><i class="fa-regular fa-eye"></i> View Attachments</button>
                    <button id="accept-senior" data-request-id=<?= $request_id ?> class="btn btn-success text-start text-white"><i class="fa-solid fa-print"></i> Accept Request</button>
                    <button id="reject-senior" data-request-id=<?= $request_id ?> class="btn btn-danger text-start text-white"><i class="fa-solid fa-circle-info"></i>Reject Request</button>
                </div>
            </div>
        </div>
    </body>

    <script src=<?= $bootstrap_js ?>></script>
    <script type="module" src="../dist/requestInfo.bundle.js"></script>

    </html>
<?php
} else {
    header("location: ../index.php");
}
?>