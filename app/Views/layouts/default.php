<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?> | Capstone Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <div class="bg-slate-900 text-gray-300 w-64 p-6 flex flex-col items-center">
        <div class="flex items-center space-x-2 mb-10 text-white font-bold text-xl">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 17V7a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4v10a4 4 0 0 1-4 4H8a4 4 0 0 1-4-4z"></path>
                <circle cx="12" cy="12" r="2"></circle>
            </svg>
            <span>Capstone</span>
        </div>
        <nav class="w-full">
            <ul class="space-y-2">
                <li><a href="<?= site_url('dashboard') ?>" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-800 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="3" width="7" height="9" rx="2" ry="2"></rect>
                        <rect x="14" y="3" width="7" height="5" rx="2" ry="2"></rect>
                        <rect x="14" y="12" width="7" height="9" rx="2" ry="2"></rect>
                        <rect x="3" y="16" width="7" height="5" rx="2" ry="2"></rect>
                    </svg>
                    <span>Dashboard</span>
                </a></li>
                <li><a href="<?= site_url('facilities') ?>" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-800 transition-colors">
                    <i class="fas fa-building h-5 w-5"></i>
                    <span>Facilities</span>
                </a></li>
                <li><a href="<?= site_url('services') ?>" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-800 transition-colors">
                    <i class="fas fa-concierge-bell h-5 w-5"></i>
                    <span>Services</span>
                </a></li>
                <li><a href="<?= site_url('projects') ?>" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-800 transition-colors">
                    <i class="fas fa-project-diagram h-5 w-5"></i>
                    <span>Projects</span>
                </a></li>
                <li><a href="<?= site_url('participants') ?>" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-800 transition-colors">
                    <i class="fas fa-user-friends h-5 w-5"></i>
                    <span>Participants</span>
                </a></li>
                <li><a href="<?= site_url('outcomes') ?>" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-slate-800 transition-colors">
                    <i class="fas fa-chart-bar h-5 w-5"></i>
                    <span>Outcomes</span>
                </a></li>
                <li><a href="<?= site_url('equipment') ?>" class="flex items-center space-x-3 p-3 rounded-lg bg-blue-600 text-white font-bold">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                    </svg>
                    <span>Equipment</span>
                </a></li>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-8 overflow-y-auto">
        <?= $this->renderSection('content') ?>
    </div>
</body>
</html>