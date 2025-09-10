<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Capstone - <?= $this->renderSection('title') ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    
    <style>
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 56px; /* Height of navbar */
            left: 0;
            width: 250px;
            padding-top: 1rem;
            background-color: #343a40;
        }
        .sidebar a {
            color: #adb5bd;
            padding: 12px 20px;
            display: block;
            text-decoration: none;
            font-weight: 500;
        }
        .sidebar a:hover, .sidebar a.active {
            background-color: #495057;
            color: #fff;
            text-decoration: none;
        }
        main.content {
            margin-left: 250px;
            padding: 2rem;
            margin-top: 56px;
        }
        .navbar-brand img {
            height: 40px;
            margin-right: 8px;
        }
    </style>
    
    <?= $this->renderSection('styles') ?>
</head>
<body>
    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top shadow">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="<?= site_url() ?>">
                <img src="<?= base_url('images/capstone-logo.png') ?>" alt="Capstone Logo" />
                <span>Capstone</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Right side nav -->
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" 
                           aria-expanded="false">
                            <i class="fas fa-user-circle"></i> Account
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="#">Profile</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- Sidebar -->
    <div class="sidebar">
        <a href="<?= site_url('Dashboard') ?>" class="<?= uri_string() == 'Dashboard' ? 'active' : '' ?>"><i class="fas fa-tachometer-alt me-2"></i> Dashboard</a>
        <a href="<?= site_url('programs') ?>" class="<?= uri_string() == 'programs' ? 'active' : '' ?>"><i class="fas fa-calendar-alt me-2"></i> Programs</a>
        <a href="<?= site_url('projects') ?>" class="<?= uri_string() == 'projects' ? 'active' : '' ?>"><i class="fas fa-project-diagram me-2"></i> Projects</a>
        <a href="<?= site_url('participants') ?>" class="<?= uri_string() == 'participants' ? 'active' : '' ?>"><i class="fas fa-users me-2"></i> Participants</a>
        <a href="<?= site_url('equipment') ?>" class="<?= uri_string() == 'equipment' ? 'active' : '' ?>"><i class="fas fa-tools me-2"></i> Equipment</a>
        <a href="<?= site_url('services') ?>" class="<?= uri_string() == 'services' ? 'active' : '' ?>"><i class="fas fa-concierge-bell me-2"></i> Services</a>
    </div>
    
    <!-- Main Content -->
    <main class="content">
        <?= $this->renderSection('content') ?>
    </main>
    
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <?= $this->renderSection('scripts') ?>
</body>
</html>
