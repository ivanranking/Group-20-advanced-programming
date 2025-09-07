<?php
// --- Data ---
// In a real application, you would fetch this data from a database.
$participants_count = $participant_count ?? 0;
$equipment_count = $equipment_count ?? 0;
$projects = $recent_projects ?? []; // An empty array to show the "No projects yet" state.
$quick_actions = ['Program', 'Project', 'Participant', 'Service', 'Equipment'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* A little extra style for the faint background text if needed */
        body::before {
            content: 'Misty forest landscape';
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 6rem; /* Adjust size as needed */
            font-weight: bold;
            color: rgba(0, 0, 0, 0.04);
            z-index: 0;
            pointer-events: none; /* Make text unselectable */
            white-space: nowrap;
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen p-4 sm:p-6 lg:p-8">

    <main class="bg-white rounded-xl shadow-lg w-full max-w-4xl p-6 sm:p-8 relative z-10">
        
        <header class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Dashboard</h1>
            <p class="text-gray-500 mt-1">Welcome back! Here's a quick overview of your workspace.</p>
        </header>

        <section class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg border border-gray-200 flex items-center gap-4">
                <div class="bg-blue-100 p-3 rounded-full">
                    <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-4.67c.12-.318.239-.636.354-.966M15 19.128c-1.113 0-2.16-.285-3.07-.786m7.745-8.702a4.125 4.125 0 00-7.533-2.493M3.375 10.5a4.125 4.125 0 007.533 2.493c.12-.318.239-.636.354-.966m-8.088-1.528A12.318 12.318 0 018.624 3c2.331 0 4.512.645 6.374 1.766l.001.109A6.375 6.375 0 014.036 9.33c-.12.318-.239.636-.354.966" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Participants</p>
                    <p class="text-2xl font-bold text-gray-800"><?php echo $participants_count; ?></p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg border border-gray-200 flex items-center gap-4">
                <div class="bg-green-100 p-3 rounded-full">
                    <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L17.25 21A2.652 2.652 0 0021 17.25l-5.877-5.877M11.42 15.17l2.471-2.471a2.652 2.652 0 000-3.75l-2.471-2.471L8.83 8.83l2.471 2.471a2.652 2.652 0 000 3.75l-2.471 2.471z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.42 15.17L8.83 12.58l-2.471 2.471a2.652 2.652 0 000 3.75l2.471 2.471a2.652 2.652 0 003.75 0l2.471-2.471z" />
                    </svg>
                </div>
                <div>
                    <p class="text-gray-500 text-sm">Equipment</p>
                    <p class="text-2xl font-bold text-gray-800"><?php echo $equipment_count; ?></p>
                </div>
            </div>
        </section>

        <section class="mb-8">
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Recently Added Projects</h2>
            <div class="bg-white p-8 rounded-lg border-2 border-dashed border-gray-200 text-center">
                <?php if (empty($projects)): ?>
                    <div class="flex flex-col items-center">
                        <svg class="h-12 w-12 text-gray-400 mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                           <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                        </svg>
                        <p class="text-gray-500 mb-4">No projects yet.</p>
                        <p class="text-gray-400 text-sm mb-4">Get started by creating your first project.</p>
                        <a href="<?= site_url('projects/new') ?>"><button class="bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-700 transition duration-300">+ Add New Project</button></a>
                    </div>
                <?php else: ?>
                    <div class="text-left">
                        <ul class="space-y-2">
                            <?php foreach ($projects as $project): ?>
                                <li class="bg-gray-50 p-3 rounded-lg">
                                    <strong><?php echo esc($project['name'] ?? ''); ?></strong> - Status: <?php echo esc($project['status'] ?? ''); ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <section>
            <h2 class="text-xl font-semibold text-gray-700 mb-4">Quick Actions</h2>
            <div class="space-y-3">
                <?php foreach ($quick_actions as $action): ?>
                <div class="bg-white p-4 rounded-lg border border-gray-200 flex justify-between items-center">
                    <span class="text-gray-700 font-medium"><?php echo $action; ?></span>
                    <div class="flex items-center gap-2">
                        <a href="<?= site_url(strtolower($action) . 's/new') ?>"><button class="bg-blue-100 text-blue-700 text-xs font-bold py-1 px-3 rounded-full hover:bg-blue-200 transition">New</button></a>
                        <a href="<?= site_url(strtolower($action) . 's') ?>"><button class="bg-gray-200 text-gray-700 text-xs font-bold py-1 px-3 rounded-full hover:bg-gray-300 transition">Manage</button></a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

    </main>

</body>
</html>
