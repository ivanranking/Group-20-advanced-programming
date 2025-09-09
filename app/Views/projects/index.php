<?php
// Use real database data from controller instead of mock data
$users = []; // We'll populate this from database if needed

// Use the real projects data from controller
$filteredProjects = $projects ?? [];

// Filter logic (already handled by controller)
$filter = $_GET['filter'] ?? 'all';
$search = $_GET['search'] ?? '';

// Count projects by status
$projectCounts = [
    'all' => count($projects ?? []),
    'active' => count(array_filter($projects ?? [], fn($p) => $p['status'] === 'active')),
    'completed' => count(array_filter($projects ?? [], fn($p) => $p['status'] === 'completed')),
];

function getStatusColor($status) {
    switch ($status) {
        case 'active': return 'bg-green-500';
        case 'completed': return 'bg-blue-500';
        default: return 'bg-gray-400';
    }
}

function getUserInitials($name) {
    $parts = explode(' ', $name);
    return strtoupper(substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));
}
?>

<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .progress-bar {
            background: linear-gradient(to right, #10b981 0%, #10b981 var(--progress), #e5e7eb var(--progress), #e5e7eb 100%);
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <div class="max-w-7xl mx-auto p-6">
            <!-- Header -->
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center space-x-3">
                    <h1 class="text-2xl font-bold text-gray-900">Projects</h1>
                    <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                </div>

                <div class="flex items-center space-x-3">
                    <div class="flex -space-x-2">
                        <?php
                        // Show some recent participants or team members
                        $recentUsers = array_slice($users, 0, 2);
                        foreach ($recentUsers as $user): ?>
                            <div class="h-8 w-8 rounded-full bg-gray-300 border-2 border-white flex items-center justify-center">
                                <span class="text-xs font-medium text-gray-700">
                                    <?= getUserInitials($user['name'] ?? 'U') ?>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Controls -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                <div class="flex items-center space-x-4">
                    <a href="<?= site_url('projects/new') ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md flex items-center space-x-2">
                        <i class="fas fa-plus"></i>
                        <span>New Project</span>
                    </a>

                    <form method="GET" class="relative">
                        <input type="hidden" name="filter" value="<?= htmlspecialchars($filter) ?>">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input
                            type="text"
                            name="search"
                            value="<?= htmlspecialchars($search) ?>"
                            placeholder="Search"
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-md w-64 focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                    </form>
                </div>

                <!-- Filter Tabs -->
                <div class="flex space-x-1">
                    <?php
                    $filters = [
                        'all' => ['label' => 'All', 'count' => $projectCounts['all']],
                        'active' => ['label' => 'Active', 'count' => $projectCounts['active']],
                        'completed' => ['label' => 'Completed', 'count' => $projectCounts['completed']],
                    ];
                    ?>
                    <?php foreach ($filters as $key => $filterData): ?>
                        <a href="?filter=<?= $key ?>&search=<?= urlencode($search) ?>"
                           class="px-4 py-2 rounded-md relative <?= $filter === $key ? 'bg-blue-50 text-blue-600' : 'text-gray-600 hover:text-gray-900' ?>">
                            <?= $filterData['label'] ?>
                            <?php if ($filter === $key): ?>
                                <div class="absolute bottom-0 left-0 right-0 h-0.5 bg-blue-600 rounded-t"></div>
                            <?php endif; ?>
                        </a>
                    <?php endforeach; ?>
                    <button class="px-4 py-2 text-gray-400">•••</button>
                </div>
            </div>

            <!-- Projects Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                <?php foreach ($filteredProjects as $project): ?>
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 flex flex-col h-full">
                        <!-- Header -->
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h3 class="text-lg font-semibold text-gray-900 mb-1">
                                    <?= esc($project['name']) ?>
                                </h3>
                                <p class="text-sm text-gray-500 mb-2">
                                    <?php
                                    // Show program name if available
                                    if (isset($project['program_name'])) {
                                        echo esc($project['program_name']);
                                    } elseif (isset($project['program_id']) && !empty($programs)) {
                                        $program = array_filter($programs, fn($p) => $p['id'] == $project['program_id']);
                                        echo !empty($program) ? esc(reset($program)['name']) : 'No Program';
                                    } else {
                                        echo 'No Program';
                                    }
                                    ?>
                                </p>
                                <p class="text-sm text-gray-600 leading-relaxed">
                                    <?= esc($project['description']) ?: 'No description available' ?>
                                </p>
                            </div>
                            <div class="flex space-x-1">
                                <a href="<?= site_url('projects/' . $project['id'] . '/edit') ?>"
                                   class="text-gray-400 hover:text-blue-600 p-1">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="<?= site_url('projects/' . $project['id']) ?>" method="post" class="d-inline">
                                    <?= csrf_field() ?>
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="text-gray-400 hover:text-red-600 p-1"
                                            onclick="return confirm('Are you sure you want to delete this project?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="flex-1 flex flex-col justify-between">
                            <div class="space-y-4">
                                <!-- Progress Bar (mock for now, can be enhanced later) -->
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-500 h-2 rounded-full" style="width: 65%"></div>
                                </div>

                                <!-- Actions and Participants -->
                                <div class="flex items-center justify-between">
                                    <a href="<?= site_url('projects/' . $project['id']) ?>"
                                       class="px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-600 hover:text-gray-900 hover:border-gray-400">
                                        View Details
                                    </a>

                                    <div class="flex items-center space-x-2">
                                        <div class="flex -space-x-2">
                                            <!-- Show participant avatars if available -->
                                            <?php
                                            $participants = isset($project['participants']) ? $project['participants'] : [];
                                            $displayParticipants = array_slice($participants, 0, 4);
                                            foreach ($displayParticipants as $participant): ?>
                                                <div class="h-8 w-8 rounded-full bg-gray-300 border-2 border-white flex items-center justify-center">
                                                    <span class="text-xs font-medium text-gray-700">
                                                        <?= getUserInitials($participant['name'] ?? 'U') ?>
                                                    </span>
                                                </div>
                                            <?php endforeach; ?>
                                            <?php if (count($participants) > 4): ?>
                                                <div class="h-8 w-8 rounded-full bg-gray-100 border-2 border-white flex items-center justify-center">
                                                    <span class="text-xs text-gray-600">
                                                        +<?= count($participants) - 4 ?>
                                                    </span>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <button onclick="openAssignModal('<?= $project['id'] ?>', '<?= esc($project['name']) ?>')"
                                                class="ml-2 px-3 py-1 border border-gray-300 rounded-md text-sm text-gray-600 hover:text-gray-900 hover:border-gray-400 flex items-center space-x-1">
                                            <i class="fas fa-users text-xs"></i>
                                            <span>Assign</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Empty State -->
            <?php if (empty($filteredProjects)): ?>
                <div class="text-center py-12">
                    <p class="text-gray-500">No projects found matching your criteria.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Assign Participants Modal -->
    <div id="assignModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg max-w-md w-full p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold">Assign Participants</h3>
                    <button onclick="closeAssignModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="space-y-4">
                    <div class="relative">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input
                            type="text"
                            id="participantSearch"
                            placeholder="Search participants"
                            class="pl-10 pr-4 py-2 border border-gray-300 rounded-md w-full focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            oninput="filterParticipants()"
                        >
                    </div>

                    <div class="space-y-3 max-h-64 overflow-y-auto">
                        <div class="text-sm text-gray-500 border-b pb-2">Available Participants</div>

                        <form id="assignForm" method="POST" action="<?= site_url('projects/assign-participants') ?>">
                            <input type="hidden" id="projectId" name="project_id" value="">
                            <div id="participantsList">
                                <!-- Participants will be loaded dynamically or from database -->
                                <div class="text-center py-4 text-gray-500">
                                    <i class="fas fa-users text-2xl mb-2"></i>
                                    <p>Loading participants...</p>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="flex justify-end space-x-3 pt-4 border-t">
                        <button onclick="closeAssignModal()"
                                class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                            Cancel
                        </button>
                        <button onclick="submitAssignment()"
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Assign
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openAssignModal(projectId, projectTitle) {
            document.getElementById('projectId').value = projectId;
            document.getElementById('assignModal').classList.remove('hidden');
            // Load participants dynamically if needed
            loadParticipants();
        }

        function closeAssignModal() {
            document.getElementById('assignModal').classList.add('hidden');
            document.getElementById('participantSearch').value = '';
            filterParticipants();
        }

        function filterParticipants() {
            const search = document.getElementById('participantSearch').value.toLowerCase();
            document.querySelectorAll('.participant-item').forEach(item => {
                const name = item.dataset.name;
                item.style.display = name.includes(search) ? 'flex' : 'none';
            });
        }

        function submitAssignment() {
            const form = document.getElementById('assignForm');
            const checkedBoxes = form.querySelectorAll('input[name="participants[]"]:checked');

            if (checkedBoxes.length === 0) {
                alert('Please select at least one participant.');
                return;
            }

            form.submit();
        }

        function loadParticipants() {
            // This could be enhanced to load participants dynamically
            console.log('Loading participants...');
        }
    </script>
</body>
</html>
<?= $this->endSection() ?>