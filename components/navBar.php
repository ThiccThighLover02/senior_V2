<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class=<?= $active_nav === 'home' ? "nav-link active": "nav-link"; ?> aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class=<?= $active_nav === 'faq' ? "nav-link active": "nav-link"; ?> href="faq.php">FAQ</a>
                </li>
                <li class="nav-item">
                    <a class=<?= $active_nav == 'login' ? "nav-link active": "nav-link"; ?> href="login.php">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>