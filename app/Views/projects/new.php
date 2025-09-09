<?php
// Use real database data from controller instead of mock data
$users = []; // We'll populate this from database if needed

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
    <title>Create New Project</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <div class="max-w-4xl mx-auto p-6">
            <!-- Header -->
            <div class="mb-8">
                <div class="flex items-center space-x-4 mb-4">
                    <a href="<?= site_url('projects') ?>" class="text-gray-600 hover:text-gray-900">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h1 class="text-2xl font-bold text-gray-900">Create New Project</h1>
                </div>
                <p class="text-gray-600">Fill in the details below to create a new project.</p>
            </div>

            <!-- Form -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
                <form action="<?= site_url('projects') ?>" method="post" class="space-y-6">
                    <?= csrf_field() ?>

                    <!-- Project Title -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            Project Title *
                        </label>
                        <input
                            type="text"
                            id="name"
                            name="name"
                            value="<?= old('name') ?>"
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Enter project title"
                        >
                        <?php if (isset($errors['name'])): ?>
                            <div class="text-red-500 text-sm mt-1"><?= $errors['name'] ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Project Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Description *
                        </label>
                        <textarea
                            id="description"
                            name="description"
                            rows="4"
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Describe your project"
                        ><?= old('description') ?></textarea>
                        <?php if (isset($errors['description'])): ?>
                            <div class="text-red-500 text-sm mt-1"><?= $errors['description'] ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Category and Status -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="program_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Program
                            </label>
                            <select
                                id="program_id"
                                name="program_id"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            >
                                <option value="">Select Program</option>
                                <?php foreach ($programs ?? [] as $program): ?>
                                    <option value="<?= $program['id'] ?>" <?= old('program_id') == $program['id'] ? 'selected' : '' ?>>
                                        <?= esc($program['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div>
                            <label for="facility_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Facility
                            </label>
                            <select
                                id="facility_id"
                                name="facility_id"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            >
                                <option value="">Select Facility</option>
                                <?php foreach ($facilities ?? [] as $facility): ?>
                                    <option value="<?= $facility['id'] ?>" <?= old('facility_id') == $facility['id'] ? 'selected' : '' ?>>
                                        <?= esc($facility['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <!-- Status and Dates -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                Status
                            </label>
                            <select
                                id="status"
                                name="status"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            >
                                <option value="active" <?= old('status', 'active') == 'active' ? 'selected' : '' ?>>Active</option>
                                <option value="inactive" <?= old('status') == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                                <option value="completed" <?= old('status') == 'completed' ? 'selected' : '' ?>>Completed</option>
                            </select>
                        </div>

                        <div>
                            <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">
                                Start Date
                            </label>
                            <input
                                type="date"
                                id="start_date"
                                name="start_date"
                                value="<?= old('start_date') ?>"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            >
                        </div>

                        <div>
                            <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">
                                End Date
                            </label>
                            <input
                                type="date"
                                id="end_date"
                                name="end_date"
                                value="<?= old('end_date') ?>"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            >
                        </div>
                    </div>

                    <!-- Assign Team Members -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-4">
                            Assign Team Members
                        </label>

                        <div class="border border-gray-300 rounded-md p-4">
                            <div class="mb-4">
                                <div class="relative">
                                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                    <input
                                        type="text"
                                        id="memberSearch"
                                        placeholder="Search team members"
                                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-md w-full focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                        oninput="filterMembers()"
                                    >
                                </div>
                            </div>

                            <div class="space-y-3 max-h-64 overflow-y-auto">
                                <?php
                                // Get participants from database if available
                                $availableParticipants = isset($participants) ? $participants : [];
                                if (empty($availableParticipants)) {
                                    // Fallback: show a message if no participants available
                                    echo '<div class="text-center py-4 text-gray-500"><i class="fas fa-users text-2xl mb-2"></i><p>No participants available</p></div>';
                                } else {
                                    foreach ($availableParticipants as $participant): ?>
                                        <div class="member-item flex items-center space-x-3" data-name="<?= strtolower($participant['name'] ?? '') ?>">
                                            <input
                                                type="checkbox"
                                                name="participants[]"
                                                value="<?= $participant['id'] ?>"
                                                id="member_<?= $participant['id'] ?>"
                                                class="rounded border-gray-300"
                                            >
                                            <div class="h-8 w-8 rounded-full bg-gray-300 flex items-center justify-center">
                                                <span class="text-xs font-medium text-gray-700">
                                                    <?= getUserInitials($participant['name'] ?? 'U') ?>
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <p class="text-sm font-medium text-gray-900"><?= esc($participant['name'] ?? 'Unknown') ?></p>
                                                <p class="text-xs text-gray-500"><?= esc($participant['email'] ?? '') ?> | <?= esc($participant['role'] ?? 'No Role') ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach;
                                } ?>
                            </div>
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="flex justify-end space-x-4 pt-6 border-t">
                        <a href="<?= site_url('projects') ?>"
                           class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">
                            Cancel
                        </a>
                        <button
                            type="submit"
                            class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                        >
                            Create Project
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function filterMembers() {
            const search = document.getElementById('memberSearch').value.toLowerCase();
            document.querySelectorAll('.member-item').forEach(item => {
                const name = item.dataset.name;
                item.style.display = name.includes(search) ? 'flex' : 'none';
            });
        }
    </script>
</body>
</html>
<?= $this->endSection() ?>