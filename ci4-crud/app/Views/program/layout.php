<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?> | Capstone Project</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,.1);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
    <div class="container">
        <a class="navbar-brand" href="<?= site_url('/') ?>">CapstoneWardrobe</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('programs') ?>">Programs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('projects') ?>">Projects</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('participants') ?>">Participants</a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('equipment') ?>">Equipment</a>
                </li>
                 <li class="nav-item">
                    <a class="nav-link" href="<?= site_url('services') ?>">Services</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main>
    <?= $this->renderSection('content') ?>
</main>

<footer class="container text-center mt-5 py-3">
    <p>&copy; <?= date('Y') ?> Capstone Management System</p>
</footer>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
