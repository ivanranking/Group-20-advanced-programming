<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?><?= esc($title) ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="max-w-4xl mx-auto p-6">
    <div class="mb-8">
        <div class="flex items-center space-x-4 mb-4">
            <a href="<?= site_url('facilities') ?>" class="text-gray-600 hover:text-gray-900">
                <i class="fas fa-arrow-left"></i>
            </a>
            <h1 class="text-2xl font-bold text-gray-900"><?= esc($title) ?></h1>
        </div>
        <p class="text-gray-600">Update the details for this facility.</p>
    </div>

    <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-8">
        <form action="<?= site_url('facilities/update/' . $facility['id']) ?>" method="post" class="space-y-6">
            <?= csrf_field() ?>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
                <input type="text" id="name" name="name" value="<?= old('name', $facility['name']) ?>" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Enter facility name">
                <?php if (session()->has('errors') && ($error = session('errors')['name'] ?? null)): ?>
                    <div class="text-red-500 text-sm mt-1"><?= esc($error) ?></div>
                <?php endif; ?>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                <textarea id="description" name="description" rows="4" required class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Describe the facility"><?= old('description', $facility['description']) ?></textarea>
                <?php if (session()->has('errors') && ($error = session('errors')['description'] ?? null)): ?>
                    <div class="text-red-500 text-sm mt-1"><?= esc($error) ?></div>
                <?php endif; ?>
            </div>

            <div>
                <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                <input type="text" id="location" name="location" value="<?= old('location', $facility['location']) ?>" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Enter facility location">
            </div>

            <div class="flex justify-end space-x-4 pt-6 border-t">
                <a href="<?= site_url('facilities') ?>" class="px-6 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50">Cancel</a>
                <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Update Facility</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
