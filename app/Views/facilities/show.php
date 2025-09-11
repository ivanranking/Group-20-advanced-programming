<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?><?= esc($title) ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="max-w-4xl mx-auto p-6">
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <a href="<?= site_url('facilities') ?>" class="text-gray-600 hover:text-gray-900">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-2xl font-bold text-gray-900"><?= esc($facility['name']) ?></h1>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <h3 class="text-sm font-medium text-gray-500">Location</h3>
                <p class="mt-1 text-gray-900"><?= esc($facility['location']) ?></p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Projects</h3>
                <p class="mt-1 text-gray-900"><?= count($projects ?? []) ?></p>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500">Services</h3>
                <p class="mt-1 text-gray-900"><?= count($services ?? []) ?></p>
            </div>
        </div>
        <div class="mt-6 border-t pt-6">
            <h3 class="text-sm font-medium text-gray-500">Description</h3>
            <p class="mt-1 text-gray-900"><?= esc($facility['description']) ?></p>
        </div>
    </div>

    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Associated Projects</h2>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <ul class="divide-y divide-gray-200">
                <?php if (!empty($projects)): ?>
                    <?php foreach ($projects as $project): ?>
                        <li class="p-4"><?= esc($project['name']) ?></li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li class="p-4 text-center text-gray-500">No projects yet.</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    <div class="mb-8">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Available Services</h2>
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <ul class="divide-y divide-gray-200">
                <?php if (!empty($services)): ?>
                    <?php foreach ($services as $service): ?>
                        <li class="p-4"><?= esc($service['name']) ?></li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li class="p-4 text-center text-gray-500">No services yet.</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>

    <div class="flex justify-end space-x-4">
        <a href="<?= site_url('facilities/edit/' . $facility['id']) ?>" class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">Edit</a>
        <a href="<?= site_url('facilities/delete/' . $facility['id']) ?>" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700" onclick="return confirm('Are you sure?')">Delete</a>
    </div>
</div>
<?= $this->endSection() ?>