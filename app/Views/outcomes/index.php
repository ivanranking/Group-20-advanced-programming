<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Outcomes Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 flex h-screen overflow-hidden">
    <!-- Sidebar -->
    <div class="bg-white text-gray-800 w-64 p-6 flex flex-col shadow-lg rounded-r-3xl">
        <div class="flex items-center space-x-2 mb-10 text-gray-800 font-bold text-xl">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M4 17V7a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4v10a4 4 0 0 1-4 4H8a4 4 0 0 1-4-4z"></path>
                <circle cx="12" cy="12" r="2"></circle>
            </svg>
            <span>Admin Dashboard</span>
        </div>
        <nav class="w-full">
            <ul class="space-y-2">
                <li><a href="#" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-gray-200 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2l-2.4 7.2h-7.6l6 4.8l-2.4 7.2l6-4.8l6 4.8l-2.4-7.2l6-4.8h-7.6z"></path>
                    </svg>
                    <span>Meteons</span>
                </a></li>
                <li><a href="#" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-gray-200 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    <span>Solithans</span>
                </a></li>
                <li><a href="#" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-gray-200 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.19a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.08a2 2 0 0 1 1 1.73v.5a2 2 0 0 1-1 1.73l-.15.08a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2-2l.43-.25a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73v.5a2 2 0 0 0 1 1.73l.43.25a2 2 0 0 0 2-2l.15-.08a2 2 0 0 1 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.73v-.49a2 2 0 0 1 1-1.73l.15-.08a2 2 0 0 0 .73-2.73l-.22-.39a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 2l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                    <span>Sonsonang</span>
                </a></li>
                <li><a href="#" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-gray-200 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="10" rx="2" ry="2"></rect>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <span>Margin</span>
                </a></li>
                <li><a href="#" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-gray-200 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                        <path d="M13 2v7h7"></path>
                    </svg>
                    <span>Unisurats</span>
                </a></li>
                <li><a href="#" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-gray-200 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                    </svg>
                    <span>Footthlocms</span>
                </a></li>
                <li><a href="#" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-gray-200 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5C2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3C19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path>
                    </svg>
                    <span>Toittpson</span>
                </a></li>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-8 overflow-y-auto">
        <div class="flex flex-col items-start space-y-4 mb-8">
            <div class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M18 13a2 2 0 100-4 2 2 0 000 4zm-4 4a2 2 0 100-4 2 2 0 000 4zm-4-4a2 2 0 100-4 2 2 0 000 4z" />
                </svg>
                <h1 class="text-3xl font-bold text-gray-800">Outcomes</h1>
            </div>
        </div>

        <!-- Filter Form -->
        <div class="flex flex-wrap items-center space-y-4 md:space-y-0 md:space-x-4 mb-8">
            <div class="flex-1 min-w-0">
                <form method="get" class="flex flex-col sm:flex-row items-stretch space-y-2 sm:space-y-0 sm:space-x-2">
                    <select name="project" class="form-select px-4 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring focus:ring-blue-200">
    <option value="">All Projects</option>
    <?php foreach ($projects as $project): ?>
        <option value="<?= esc($project['id']) ?>" <?= ($project_id == $project['id']) ? 'selected' : '' ?>>
            <?= esc($project['name']) ?>
        </option>
    <?php endforeach; ?>
</select>
<button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-xl shadow-md transition-colors">
    Filter
</button>
<a href="<?= site_url('outcomes') ?>" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-6 rounded-xl shadow-md transition-colors">
    Clear
</a>
</form>
</div>
<div class="w-full sm:w-auto flex justify-end">
<a href="<?= site_url('outcomes/new') ?>" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded-xl shadow-md transition-colors">
    Add New Outcome
</a>
</div>
</div>

<!-- Outcomes List -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
<?php if (!empty($outcomes)): ?>
<?php foreach ($outcomes as $outcome): ?>
    <div class="bg-white rounded-3xl shadow-xl p-6 flex flex-col h-full">
        <div class="flex items-start justify-between mb-4">
            <h5 class="text-xl font-bold text-gray-800"><?= esc($outcome['title']) ?></h5>
            <div class="flex items-center space-x-2 text-sm font-medium">
                <span class="text-green-500">
                    <svg class="h-3 w-3 fill-current" viewBox="0 0 20 20">
                        <circle cx="10" cy="10" r="10"></circle>
                    </svg>
                </span>
                <span>Active</span>
            </div>
        </div>
        <p class="text-gray-600 mb-4"><?= esc($outcome['description']) ?></p>
        <div class="flex space-x-2 mt-auto">
            <a href="<?= site_url('outcomes/download/' . $outcome['id']) ?>" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-xl shadow-sm transition-colors text-sm">Download File</a>
            <a href="<?= esc($outcome['link']) ?>" target="_blank" class="bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-2 px-4 rounded-xl shadow-sm transition-colors text-sm">View Link</a>
            <a href="<?= site_url('outcomes/' . $outcome['id']) ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-xl shadow-sm transition-colors text-sm">View Details</a>
                </div>
    </div>
<?php endforeach; ?>
<?php else: ?>
    <div class="col-span-full alert bg-blue-100 text-blue-800 p-4 rounded-xl" role="alert">
        No outcomes found.
    </div>
<?php endif; ?>
</div>

<!-- No Outcomes Found -->
<div class="hidden alert bg-blue-100 text-blue-800 p-4 rounded-xl" role="alert">
    No outcomes found.
</div>
                </div>
            </div>
        </div>
        
        <!-- No Outcomes Found -->
        <div class="hidden alert bg-blue-100 text-blue-800 p-4 rounded-xl" role="alert">
            No outcomes found.
        </div>
    </div>
</body>
</html>