<?php
// Use real database data from controller instead of mock data
function getUserInitials($name) {
    $parts = explode(' ', $name);
    return strtoupper(substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));
}

function getStatusBadge($status) {
    switch ($status) {
        case 'active':
            return '<span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Active</span>';
        case 'completed':
            return '<span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">Completed</span>';
        case 'pending':
            return '<span class="px-2 py-1 text-xs font-medium bg-yellow-100 text-yellow-800 rounded-full">Pending</span>';
        default:
            return '<span class="px-2 py-1 text-xs font-medium bg-gray-100 text-gray-800 rounded-full">Unknown</span>';
    }
}

// Mock activity data (could be enhanced with real data later)
$activities = [
    ['user' => 'Team Member', 'action' => 'updated the project progress', 'time' => '2 hours ago'],
    ['user' => 'Developer', 'action' => 'added new task', 'time' => '4 hours ago'],
    ['user' => 'Designer', 'action' => 'uploaded design files', 'time' => '1 day ago'],
];

// Mock tasks (could be enhanced with real data later)
$tasks = [
    ['id' => 1, 'title' => 'Initial setup', 'status' => 'completed', 'assignee' => 'Team Member'],
    ['id' => 2, 'title' => 'Development work', 'status' => 'active', 'assignee' => 'Developer'],
    ['id' => 3, 'title' => 'Testing phase', 'status' => 'pending', 'assignee' => 'QA'],
];
?>

<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?><?= esc($project['name']) ?> - Project Details<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($project['name']) ?> - Project Details</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <div class="max-w-6xl mx-auto p-6">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-4">
                        <a href="<?= site_url('projects') ?>" class="text-gray-600 hover:text-gray-900">
                            <i class="fas fa-arrow-left"></i>
                        </a>
                        <div>
                            <h1 class="text-2xl font-bold text-gray-900"><?= esc($project['name']) ?></h1>
                            <p class="text-gray-600">
                                <?php
                                // Show program name if available
                                if (isset($project['program_name'])) {
                                    echo esc($project['program_name']);
                                } elseif (isset($project['program_id']) && !empty($programs)) {
                                    $program = array_filter($programs, fn($p) => $p['id'] == $project['program_id']);
                                    echo !empty($program) ? esc(reset($program)['name']) : 'No Program';
                                } else {
                                    echo 'Project Details';
                                }
                                ?>
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center space-x-3">
                        <?= getStatusBadge($project['status']) ?>
                        <a href="<?= site_url('projects/' . $project['id'] . '/edit') ?>"
                           class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            <i class="fas fa-edit mr-2"></i>
                            Edit Project
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Project Overview -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Project Overview</h2>

                        <div class="space-y-6">
                            <!-- Description -->
                            <div>
                                <h3 class="text-sm font-medium text-gray-700 mb-2">Description</h3>
                                <p class="text-gray-600 leading-relaxed"><?= esc($project['description']) ?: 'No description available' ?></p>
                            </div>

                            <!-- Progress -->
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <h3 class="text-sm font-medium text-gray-700">Progress</h3>
                                    <span class="text-sm text-gray-600">65%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-3">
                                    <div class="bg-green-500 h-3 rounded-full" style="width: 65%"></div>
                                </div>
                            </div>

                            <!-- Project Details Grid -->
                            <div class="grid grid-cols-2 gap-6">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-700 mb-1">Created Date</h3>
                                    <p class="text-gray-600">
                                        <?php if ($project['created_at']): ?>
                                            <?= date('M j, Y', strtotime($project['created_at'])) ?>
                                        <?php else: ?>
                                            Not set
                                        <?php endif; ?>
                                    </p>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-700 mb-1">Start Date</h3>
                                    <p class="text-gray-600">
                                        <?php if ($project['start_date']): ?>
                                            <?= date('M j, Y', strtotime($project['start_date'])) ?>
                                        <?php else: ?>
                                            Not set
                                        <?php endif; ?>
                                    </p>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-700 mb-1">End Date</h3>
                                    <p class="text-gray-600">
                                        <?php if ($project['end_date']): ?>
                                            <?= date('M j, Y', strtotime($project['end_date'])) ?>
                                        <?php else: ?>
                                            Not set
                                        <?php endif; ?>
                                    </p>
                                </div>
                                <div>
                                    <h3 class="text-sm font-medium text-gray-700 mb-1">Team Size</h3>
                                    <p class="text-gray-600">
                                        <?php if (isset($participants) && is_array($participants)): ?>
                                            <?= count($participants) ?> members
                                        <?php else: ?>
                                            0 members
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tasks -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold text-gray-900">Tasks</h2>
                            <button class="px-3 py-1 text-sm bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                <i class="fas fa-plus mr-1"></i>
                                Add Task
                            </button>
                        </div>

                        <div class="space-y-3">
                            <?php foreach ($tasks as $task): ?>
                                <div class="flex items-center justify-between p-3 border border-gray-200 rounded-md">
                                    <div class="flex items-center space-x-3">
                                        <input type="checkbox" <?= $task['status'] === 'completed' ? 'checked' : '' ?>
                                               class="rounded border-gray-300">
                                        <div>
                                            <p class="text-sm font-medium text-gray-900 <?= $task['status'] === 'completed' ? 'line-through' : '' ?>">
                                                <?= esc($task['title']) ?>
                                            </p>
                                            <p class="text-xs text-gray-500">Assigned to <?= esc($task['assignee']) ?></p>
                                        </div>
                                    </div>
                                    <span class="px-2 py-1 text-xs font-medium rounded-full
                                        <?php
                                        switch($task['status']) {
                                            case 'completed': echo 'bg-green-100 text-green-800'; break;
                                            case 'active': echo 'bg-blue-100 text-blue-800'; break;
                                            case 'pending': echo 'bg-yellow-100 text-yellow-800'; break;
                                        }
                                        ?>">
                                        <?= ucfirst($task['status']) ?>
                                    </span>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Activity Feed -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h2 class="text-lg font-semibold text-gray-900 mb-4">Recent Activity</h2>

                        <div class="space-y-4">
                            <?php foreach ($activities as $activity): ?>
                                <div class="flex items-start space-x-3">
                                    <div class="h-8 w-8 rounded-full bg-gray-300 flex items-center justify-center flex-shrink-0">
                                        <span class="text-xs font-medium text-gray-700">
                                            <?= getUserInitials($activity['user']) ?>
                                        </span>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-900">
                                            <span class="font-medium"><?= esc($activity['user']) ?></span>
                                            <?= esc($activity['action']) ?>
                                        </p>
                                        <p class="text-xs text-gray-500"><?= esc($activity['time']) ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Team Members -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900">Team Members</h3>
                            <button onclick="openAssignModal()"
                                    class="text-blue-600 hover:text-blue-700 text-sm">
                                <i class="fas fa-plus mr-1"></i>
                                Add Member
                            </button>
                        </div>

                        <div class="space-y-3">
                            <?php if (isset($participants) && is_array($participants)): ?>
                                <?php foreach ($participants as $participant): ?>
                                    <div class="flex items-center space-x-3">
                                        <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                            <span class="text-sm font-medium text-gray-700">
                                                <?= getUserInitials($participant['name'] ?? 'U') ?>
                                            </span>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-sm font-medium text-gray-900"><?= esc($participant['name'] ?? 'Unknown') ?></p>
                                            <p class="text-xs text-gray-500"><?= esc($participant['role'] ?? '') ?> | <?= esc($participant['email'] ?? '') ?></p>
                                        </div>
                                        <button class="text-gray-400 hover:text-gray-600">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="text-center py-4 text-gray-500">
                                    <i class="fas fa-users text-2xl mb-2"></i>
                                    <p>No team members assigned</p>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h3>

                        <div class="space-y-2">
                            <button class="w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-md">
                                <i class="fas fa-file-alt mr-2"></i>
                                Generate Report
                            </button>
                            <button class="w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-md">
                                <i class="fas fa-share mr-2"></i>
                                Share Project
                            </button>
                            <button class="w-full text-left px-3 py-2 text-sm text-gray-700 hover:bg-gray-50 rounded-md">
                                <i class="fas fa-archive mr-2"></i>
                                Archive Project
                            </button>
                            <form action="<?= site_url('projects/' . $project['id']) ?>" method="post" class="d-inline">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="w-full text-left px-3 py-2 text-sm text-red-600 hover:bg-red-50 rounded-md"
                                        onclick="return confirm('Are you sure you want to delete this project?')">
                                    <i class="fas fa-trash mr-2"></i>
                                    Delete Project
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Assign Members Modal -->
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
                            <input type="hidden" name="project_id" value="<?= $project['id'] ?>">
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
        function openAssignModal() {
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