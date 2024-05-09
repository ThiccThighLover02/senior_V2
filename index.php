<?php
$active_nav = "home";
$link = 'home';
include './database/db_connect.php';
include 'links.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href=<?php echo $bootstrap_css ?>>
    <title>Document</title>
</head>

<body>
    <?php include './components/navBar.php' ?>    
    <div class="container">

    </div>
</body>

<script src=<?php echo $bootstrap_js ?>></script>

</html>