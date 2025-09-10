<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participants Dashboard</title>
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
            <span>Dashboard</span>
        </div>
        <nav class="w-full">
            <ul class="space-y-2">
                <li><a href="#" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-gray-200 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 2l-2.4 7.2h-7.6l6 4.8l-2.4 7.2l6-4.8l6 4.8l-2.4-7.2l6-4.8h-7.6z"></path>
                    </svg>
                    <span>Dashboard</span>
                </a></li>
                <li><a href="#" class="flex items-center space-x-3 p-3 rounded-xl bg-gray-200 text-blue-600 font-semibold transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    <span>Participants</span>
                </a></li>
                <li><a href="#" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-gray-200 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                        <path d="M13 2v7h7"></path>
                    </svg>
                    <span>Projects</span>
                </a></li>
                <li><a href="#" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-gray-200 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.19a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.08a2 2 0 0 1 1 1.73v.5a2 2 0 0 1-1 1.73l-.15.08a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2-2l.43-.25a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73v.5a2 2 0 0 0 1 1.73l.43.25a2 2 0 0 0 2-2l.15-.08a2 2 0 0 1 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.73v-.49a2 2 0 0 1 1-1.73l.15-.08a2 2 0 0 0 .73-2.73l-.22-.39a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 2l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                    <span>Settings</span>
                </a></li>
                <li><a href="#" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-gray-200 transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12.22 2h-.44a2 2 0 0 0-2 2v.19a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.08a2 2 0 0 1 1 1.73v.5a2 2 0 0 1-1 1.73l-.15.08a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2-2l.43-.25a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73v.5a2 2 0 0 0 1 1.73l.43.25a2 2 0 0 0 2-2l.15-.08a2 2 0 0 1 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.73v-.49a2 2 0 0 1 1-1.73l.15-.08a2 2 0 0 0 .73-2.73l-.22-.39a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 2l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                    </svg>
                    <span>Settings</span>
                </a></li>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="flex-1 p-8 overflow-y-auto">
        <!-- Participant Information Card -->
        <div class="bg-white rounded-3xl shadow-xl p-8 mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Participant Information</h2>
            <div class="flex items-center space-x-6">
                <img src="<?= base_url('writable/uploads/' . ($participant['profile_picture'] ?? 'default.png')) ?>" alt="Profile" class="w-24 h-24 rounded-full border-4 border-gray-200">
                <div class="flex flex-col space-y-1">
                    <h3 class="text-2xl font-bold text-gray-900"><?= esc($participant['name']) ?></h3>
                    <p class="text-gray-600">Email: <?= esc($participant['email']) ?></p>
                    <p class="text-gray-600">Phone: <?= esc($participant['phone'] ?? 'N/A') ?></p>
                    <p class="text-gray-600">Role: <?= esc($participant['role']) ?></p>
                </div>
            </div>
        </div>

        <!-- Linked Projects Card -->
        <div class="bg-white rounded-3xl shadow-xl p-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-6">Linked Projects</h2>
            <div class="space-y-4">
                <!-- Project Alpha -->
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center space-x-2">
                            <span class="text-lg text-yellow-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 2l-2.4 7.2h-7.6l6 4.8l-2.4 7.2l6-4.8l6 4.8l-2.4-7.2l6-4.8h-7.6z"></path>
                                </svg>
                            </span>
                            <span class="font-semibold text-gray-800">Project Alpha</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <span class="text-sm font-semibold text-green-500 flex items-center">
                                <span class="h-2 w-2 rounded-full bg-green-500 mr-1"></span>
                                Active
                            </span>
                            <span class="text-sm font-semibold text-yellow-500 flex items-center">
                                <span class="h-2 w-2 rounded-full bg-yellow-500 mr-1"></span>
                                Pending
                            </span>
                            <span class="text-sm font-semibold text-blue-500 flex items-center">
                                <span class="h-2 w-2 rounded-full bg-blue-500 mr-1"></span>
                                Pending
                            </span>
                        </div>
                    </div>
                    <p class="text-gray-500 text-sm">Description for Project Alpha.</p>
                </div>
                <!-- Website Redesign -->
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                    <div class="flex items-center justify-between mb-2">
                        <div class="flex items-center space-x-2">
                            <span class="text-lg text-blue-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                    <path d="M13 2v7h7"></path>
                                </svg>
                            </span>
                            <span class="font-semibold text-gray-800">Website Redesign</span>
                        </div>
                        <span class="text-sm text-red-500">*</span>
                    </div>
                    <p class="text-gray-500 text-sm">Description for Website Redesign.</p>
                </div>
                <div class="flex justify-end mt-4">
                    <a href="<?= site_url('projects/new') ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-xl shadow-md transition-colors flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <span>Add Project</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>