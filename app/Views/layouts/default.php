<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?> | Capstone Dashboard</title>
    <script src="https://cdn.tailwindcss.com?v=3.3.3"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css?v=5.15.4">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 flex h-screen">
    <!-- Sidebar -->
    <div class="bg-slate-900 text-white w-64 p-4 space-y-6">
        <div class="text-center">
            <h2 class="text-2xl font-bold">Capstone</h2>
        </div>
        <nav>
            <a href="<?= site_url('dashboard') ?>" class="flex items-center space-x-2 py-2 px-4 rounded-md hover:bg-slate-800">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="<?= site_url('programs') ?>" class="flex items-center space-x-2 py-2 px-4 rounded-md hover:bg-slate-800">
                <i class="fas fa-tasks"></i>
                <span>Programs</span>
            </a>
            <a href="<?= site_url('projects') ?>" class="flex items-center space-x-2 py-2 px-4 rounded-md hover:bg-slate-800">
                <i class="fas fa-project-diagram"></i>
                <span>Projects</span>
            </a>
            <a href="<?= site_url('participants') ?>" class="flex items-center space-x-2 py-2 px-4 rounded-md hover:bg-slate-800">
                <i class="fas fa-users"></i>
                <span>Participants</span>
            </a>
            <a href="<?= site_url('facilities') ?>" class="flex items-center space-x-2 py-2 px-4 rounded-md hover:bg-slate-800">
                <i class="fas fa-building"></i>
                <span>Facilities</span>
            </a>
            <a href="<?= site_url('services') ?>" class="flex items-center space-x-2 py-2 px-4 rounded-md hover:bg-slate-800">
                <i class="fas fa-concierge-bell"></i>
                <span>Services</span>
            </a>
            <a href="<?= site_url('equipment') ?>" class="flex items-center space-x-2 py-2 px-4 rounded-md hover:bg-slate-800">
                <i class="fas fa-tools"></i>
                <span>Equipment</span>
            </a>
            <a href="<?= site_url('outcomes') ?>" class="flex items-center space-x-2 py-2 px-4 rounded-md hover:bg-slate-800">
                <i class="fas fa-chart-line"></i>
                <span>Outcomes</span>
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-8 overflow-y-auto">
        <?= $this->renderSection('content') ?>
    </div>
</body>
</html>