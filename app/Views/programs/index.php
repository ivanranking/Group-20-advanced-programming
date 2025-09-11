<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?><?= esc($title) ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<!-- Header -->
<div class="flex items-center justify-between mb-8">
    <h1 class="text-3xl font-bold text-gray-900">Programs Dashboard</h1>
    <a href="<?= site_url('programs/new') ?>" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-xl shadow-md transition-colors flex items-center space-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
        <span>Create New Program</span>
    </a>
</div>

<!-- Programs List -->
<div class="space-y-6">
    <?php if (!empty($programs)): ?>
        <?php foreach ($programs as $index => $program): ?>
            <?php
            // Determine status and icon based on index for demo
            $statuses = ['Active', 'Upcoming', 'Completed'];
            $status = $statuses[$index % 3] ?? 'Active';
            $statusColors = [
                'Active' => ['text-green-500', 'bg-green-500'],
                'Upcoming' => ['text-yellow-500', 'bg-yellow-500'],
                'Completed' => ['text-red-500', 'bg-red-500']
            ];
            $color = $statusColors[$status];
            $icons = [
                'Active' => '<path d="M12 2l-2.4 7.2h-7.6l6 4.8l-2.4 7.2l6-4.8l6 4.8l-2.4-7.2l6-4.8h-7.6z"></path>',
                'Upcoming' => '<rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><line x1="3" y1="9" x2="21" y2="9"></line><path d="M9 21V9"></path>',
                'Completed' => '<circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line>'
            ];
            $iconPath = $icons[$status] ?? $icons['Active'];
            $iconColors = [
                'Active' => 'text-indigo-500',
                'Upcoming' => 'text-teal-500',
                'Completed' => 'text-red-500'
            ];
            $iconColor = $iconColors[$status];
            ?>
            <div class="bg-white rounded-3xl shadow-xl p-6 transition-transform transform hover:scale-105">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center space-x-3">
                        <span class="text-xl <?= $iconColor ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <?= $iconPath ?>
                            </svg>
                        </span>
                        <h2 class="text-2xl font-semibold text-gray-800"><?= esc($program['name']) ?></h2>
                    </div>
                    <span class="text-sm font-semibold <?= $color[0] ?> flex items-center">
                        <span class="h-2 w-2 rounded-full <?= $color[1] ?> mr-1 <?= $status === 'Active' ? 'animate-pulse' : '' ?>"></span>
                        <?= $status ?>
                    </span>
                </div>
                <p class="text-gray-600 mb-4"><?= esc($program['description']) ?></p>
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-4 text-sm text-gray-500">
                        <div class="flex items-center space-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                <circle cx="9" cy="7" r="4"></circle>
                                <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                            </svg>
                            <span>50 Participants</span>
                        </div>
                        <div class="flex items-center space-x-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="7 10 12 15 17 10"></polyline>
                                <line x1="12" y1="15" x2="12" y2="3"></line>
                            </svg>
                            <span>12 Projects</span>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <a href="<?= site_url('programs/' . $program['id'] . '/edit') ?>" class="text-blue-600 hover:text-blue-800 p-2 rounded-lg hover:bg-blue-50 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                            </svg>
                        </a>
                        <form action="<?= site_url('programs/' . $program['id']) ?>" method="post" class="inline" onsubmit="return confirm('Are you sure you want to delete this program?')">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="text-red-600 hover:text-red-800 p-2 rounded-lg hover:bg-red-50 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                    <line x1="10" y1="11" x2="10" y2="17"></line>
                                    <line x1="14" y1="11" x2="14" y2="17"></line>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <div class="text-center py-12">
            <i class="fas fa-tasks text-4xl text-gray-300"></i>
            <h3 class="mt-2 text-sm font-medium text-gray-900">No programs found</h3>
            <p class="mt-1 text-sm text-gray-500">
                Get started by <a href="<?= site_url('programs/new') ?>" class="text-blue-600 hover:underline">adding a new program</a>.
            </p>
        </div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>