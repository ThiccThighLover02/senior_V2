<?php
session_start();
if (isset($_SESSION['admin']) && $_SESSION['admin'] === "admin") {
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
        <link rel="stylesheet" href=<?= $bootstrap_css ?>>
        <script src=<?= $jquery ?>></script>
        <title>Document</title>
        <style>
            .edit {
                cursor: pointer;
            }
        </style>
    </head>

    <body class="overflow-hidden bg-light">
        <div class="modal fade" id="modalId" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white" id="modalTitleId">
                            Modal title
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center justify-content-center" id="modal-body">
                        <div class="spinner-border text-dark" id="spinner-modal" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
        $user = "admin";
        $active = "home";
        include '../components/dashboardNavbar.php';
        ?>
        <div class="row" id="sideMenu">
            <div class="col-lg-3 d-grid gap-2">
                <?php
                include '../components/sideMenu.php';
                ?>
            </div>
            <div class="col-lg-5 col-s-12 pb-2 overflow-auto" style="height: 88vh;">
                <div class="container d-grid">
                    <button id="create-post" class="btn btn-primary mt-2">Create Post</button>
                </div>
                <div class="container" id="card-container">
                    <div class="d-flex justify-content-center mt-5" id="spinner">
                        <div class="spinner-border text-dark" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <!-- newsFeedCards will go here as fetch response -->

                </div>
            </div>
            <div class="col-lg-4">
                <div class="">
                    <h2 class="mt-3">Upcoming Birthdays</h2>
                </div>
                <div class="card">
                    <div class="card-header">Header</div>
                    <div class="card-body">
                        <h4 class="card-title">Title</h4>
                        <p class="card-text">Text</p>
                    </div>
                    <div class="card-footer text-muted">Footer</div>
                </div>

            </div>
        </div>
    </body>

    <script type="module" src="../js/getResponses.js"></script>
    <script src=<?= $bootstrap_js ?>></script>

    </html>
<?php
} else {
    header("location: ../index.php");
}
?>