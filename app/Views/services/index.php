<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mx-auto mt-5 px-4">
    <h1 class="text-2xl font-bold mb-4">Services</h1>

    <!-- Filter Form -->
    <div class="mb-4">
        <div class="flex flex-col md:flex-row md:items-end gap-4">
            <form method="get" class="flex flex-col md:flex-row gap-3 flex-1">
                <div class="flex-1">
                    <select name="facility" class="w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">All Facilities</option>
                        <?php foreach ($facilities ?? [] as $facility): ?>
                            <option value="<?= $facility['id'] ?>" <?= $facility_id == $facility['id'] ? 'selected' : '' ?>>
                                <?= esc($facility['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Filter</button>
                    <?php if ($facility_id): ?>
                        <a href="<?= site_url('services') ?>" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Clear Filters</a>
                    <?php endif; ?>
                </div>
            </form>
            <div class="text-right">
                <a href="<?= site_url('services/new') ?>" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add New Service</a>
            </div>
        </div>
    </div>

    <!-- Services List -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <?php foreach ($services as $service): ?>
            <div class="bg-white rounded-lg shadow-md p-6">
                <h5 class="text-xl font-semibold mb-2"><?= esc($service['name']) ?></h5>
                <p class="mb-4">
                    <strong>Description:</strong> <?= esc($service['description'] ?? 'No description') ?>
                </p>
                <div class="flex gap-2">
                    <a href="<?= site_url('services/' . $service['id']) ?>" class="bg-blue-500 hover:bg-blue-700 text-white px-4 py-2 rounded">View Details</a>
                    <a href="<?= site_url('services/' . $service['id'] . '/edit') ?>" class="bg-yellow-500 hover:bg-yellow-700 text-white px-4 py-2 rounded">Edit</a>
                    <form action="<?= site_url('services/' . $service['id']) ?>" method="post" style="display: inline;">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white px-4 py-2 rounded" onclick="return confirm('Are you sure you want to delete this service?')">Delete</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if (empty($services)): ?>
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mt-4">No services found.</div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>