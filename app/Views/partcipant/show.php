<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Participant Dashboard<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="space-y-6">
    <!-- Participant Information Card -->
    <div class="bg-white rounded-3xl shadow-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Participant Information</h2>
        <div class="flex items-start space-x-6">
            <img src="<?= $participant['image'] ?? 'https://placehold.co/150x150/e0e0e0/ffffff?text=Image' ?>" alt="Participant" class="rounded-full w-24 h-24 object-cover">
            <div>
                <h3 class="text-xl font-bold text-gray-800 mb-2"><?= esc($participant['name']) ?></h3>
                <p class="text-sm text-gray-500 mb-1">Email: <?= esc($participant['email']) ?></p>
                <p class="text-sm text-gray-500 mb-1">Phone: <?= esc($participant['phone']) ?></p>
                <p class="text-sm text-gray-500">Role: <?= esc($participant['role']) ?></p>
            </div>
        </div>
    </div>

    <!-- Linked Projects Card -->
    <div class="bg-white rounded-3xl shadow-lg p-6">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">Linked Projects</h2>
        <div class="space-y-4">
            <?php foreach ($projects as $project): ?>
                <div class="bg-gray-50 rounded-xl p-4 flex items-center space-x-4">
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 <?= isset($project['active']) && $project['active'] ? 'text-yellow-500' : 'text-gray-400' ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2l-2.4 7.2h-7.6l6 4.8l-2.4 7.2l6-4.8l6 4.8l-2.4-7.2l6-4.8h-7.6z"></path>
                        </svg>
                        <span class="font-bold text-gray-800"><?= esc($project['name']) ?></span>
                    </div>
                    <?php if (isset($project['statuses']) && is_array($project['statuses'])): ?>
                        <div class="flex space-x-2 text-sm text-gray-500">
                            <?php foreach ($project['statuses'] as $status): ?>
                                <span class="flex items-center space-x-1">
                                    <span class="w-2 h-2 rounded-full bg-<?= $status['color'] ?>-500"></span>
                                    <span><?= esc($status['name']) ?></span>
                                </span>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-sm text-gray-600 flex-1"><?= esc($project['description'] ?? '') ?></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="flex justify-end mt-4">
            <a href="<?= site_url('projects/create') ?>" class="bg-blue-600 text-white px-6 py-3 rounded-xl font-medium flex items-center justify-center shadow-lg hover:bg-blue-700 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Add Project
            </a>
        </div>
    </div>
</div>
<?= $this->endSection() ?>