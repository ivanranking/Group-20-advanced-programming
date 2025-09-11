<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?><?= esc($title) ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="max-w-7xl mx-auto p-6">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Facilities</h1>
        <p class="text-gray-600">Browse and manage all available facilities.</p>
    </div>

    <!-- Toolbar -->
    <div class="flex justify-between items-center mb-6">
        <div class="flex-1">
            <form action="<?= site_url('facilities') ?>" method="get" class="relative">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input
                    type="search"
                    name="search"
                    placeholder="Search facilities..."
                    value="<?= esc($search ?? '') ?>"
                    class="w-full max-w-md pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                >
            </form>
        </div>
        <div>
            <a href="<?= site_url('facilities/new') ?>" class="inline-flex items-center space-x-2 px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                <i class="fas fa-plus"></i>
                <span>Add Facility</span>
            </a>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Location</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php if (!empty($facilities)): ?>
                    <?php foreach ($facilities as $facility): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= esc($facility['id']) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900"><?= esc($facility['name']) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><?= esc($facility['location']) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                <a href="<?= site_url('facilities/' . $facility['id']) ?>" class="text-blue-600 hover:text-blue-900">View</a>
                                <a href="<?= site_url('facilities/edit/' . $facility['id']) ?>" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                                <a href="<?= site_url('facilities/delete/' . $facility['id']) ?>" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center py-12">
                            <i class="fas fa-building text-4xl text-gray-300"></i>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No facilities found</h3>
                            <p class="mt-1 text-sm text-gray-500">
                                Get started by <a href="<?= site_url('facilities/new') ?>" class="text-blue-600 hover:underline">adding a new facility</a>.
                            </p>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>
