<?php
$link = 'home';
include './links.php'; //import the links
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src=<?php echo $jquery ?>></script>
    <link rel="stylesheet" href=<?php echo $bootstrap_css ?>>
    <title>Login</title>
</head>

<body>
    <?php
    $active_nav = "login";
    include './components/navBar.php'
    ?>
    <div class="container pt-4">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="bg-dark rounded-3 col-lg-6 p-3">
                    <form id="login-form" class="d-flex flex-column">
                        <h1 class="text-white">Login</h1>

                        <div class="mb-3">
                            <label for="username" class="form-label fs-3 text-white">Email</label>
                            <input class="form-control" id="username" name="username" type="text" placeholder="Enter email" required>
                        </div>

                        <div class="mb-2">
                            <label for="password" class="form-label fs-3 text-white">Password</label>
                            <input id="password" class="form-control" name="password" type="password" placeholder="Enter Password" required>
                        </div>

                        <div class="form-check-lg mb-3">
                            <input class="form-check-input" type="checkbox" name="checked" id="checked">
                            <label class="form-check-label text-white" for="checked" class="form-label text-white">Show password</label>
                        </div>

                        <a class="fs-5 mb-3 text-white">Forgot Password</a>

                        <button class="btn btn-primary mb-2 rounded-pill" type="submit">Login</button>
                        <a class="btn btn-danger text-white rounded-pill" href="./signUp.php">Signup</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="./node_modules/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="./js/formCheck.js"></script>

</html>