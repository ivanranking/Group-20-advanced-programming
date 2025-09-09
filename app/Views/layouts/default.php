<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?> | Capstone Dashboard</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', Arial, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: #f5f7fa;
            display: flex;
            overflow: hidden;
        }
        .sidebar {
            width: 220px;
            background: linear-gradient(to bottom, #ffffff, #f8fafc);
            padding: 1.5rem 0;
            box-shadow: 4px 0 15px rgba(0,0,0,0.08);
            display: flex;
            flex-direction: column;
            align-items: center;
            transition: all 0.3s ease;
        }
        .sidebar:hover {
            box-shadow: 4px 0 20px rgba(0,0,0,0.12);
        }
        .sidebar .logo {
            margin-bottom: 2.5rem;
            transition: transform 0.3s ease;
        }
        .sidebar .logo:hover {
            transform: scale(1.05);
        }
        .sidebar .logo img {
            height: 50px;
        }
        .sidebar .nav-item {
            padding: 0.75rem 1.5rem;
            color: #475569;
            cursor: pointer;
            text-align: left;
            width: 90%;
            margin: 0.25rem auto;
            border-radius: 8px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            font-size: 0.95rem;
            font-weight: 500;
            text-decoration: none;
        }
        .sidebar .nav-item.active {
            color: #1e40af;
            background: #dbeafe;
            font-weight: 600;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .sidebar .nav-item:hover {
            color: #1e40af;
            background: #eff6ff;
            transform: translateX(5px);
        }
        .sidebar .nav-item .icon {
            font-size: 1.3rem;
            margin-right: 1rem;
            transition: transform 0.3s ease;
        }
        .sidebar .nav-item:hover .icon {
            transform: scale(1.1);
        }
        .sidebar .nav-item .text {
            font-size: 0.95rem;
            display: inline;
        }
        .main-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            overflow: auto;
        }
        .top-nav {
            background: #fff;
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: box-shadow 0.3s ease;
        }
        .top-nav:hover {
            box-shadow: 0 4px 15px rgba(0,0,0,0.12);
        }
        .top-nav h2 {
            font-size: 1.5rem;
            color: #1e293b;
            margin: 0;
            font-weight: 600;
        }
        .top-nav .user {
            display: flex;
            align-items: center;
        }
        .top-nav .user img {
            height: 36px;
            border-radius: 50%;
            margin-left: 1rem;
            cursor: pointer;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .top-nav .user img:hover {
            transform: scale(1.1);
            box-shadow: 0 0 8px rgba(0,0,0,0.15);
        }
        .content {
            padding: 2rem;
            flex: 1;
            background: #f5f7fa;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo">
            <img src="/images/logo.png" alt="Capstone Logo">
        </div>
        <a href="<?= site_url('dashboard') ?>" class="nav-item active">
            <i class="fas fa-home icon"></i>
            <span class="text">Home</span>
        </a>
        <a href="<?= site_url('dashboard') ?>" class="nav-item">
            <i class="fas fa-tachometer-alt icon"></i>
            <span class="text">Dashboard</span>
        </a>
        <a href="<?= site_url('facilities') ?>" class="nav-item">
            <i class="fas fa-building icon"></i>
            <span class="text">Facilities</span>
        </a>
        <a href="<?= site_url('services') ?>" class="nav-item">
            <i class="fas fa-concierge-bell icon"></i>
            <span class="text">Services</span>
        </a>
        <a href="<?= site_url('projects') ?>" class="nav-item">
            <i class="fas fa-project-diagram icon"></i>
            <span class="text">Projects</span>
        </a>
        <a href="<?= site_url('participants') ?>" class="nav-item">
            <i class="fas fa-user-friends icon"></i>
            <span class="text">Participants</span>
        </a>
        <a href="<?= site_url('outcomes') ?>" class="nav-item">
            <i class="fas fa-chart-bar icon"></i>
            <span class="text">Outcomes</span>
        </a>
    </div>
    <div class="main-container">
        <div class="top-nav">
            <h2>Admin Dashboard</h2>
            <div class="user">
                <img src="/images/user.png" alt="User Profile">
            </div>
        </div>
        <div class="content">
            <?= $this->renderSection('content') ?>
        </div>
    </div>
</body>
</html>