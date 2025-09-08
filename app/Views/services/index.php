<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h1 class="mb-4">Services</h1>

    <!-- Filter Form -->
    <div class="row mb-4">
        <div class="col-md-8">
            <form method="get" class="row g-3">
                <div class="col-md-6">
                    <select name="facility" class="form-select">
                        <option value="">All Facilities</option>
                        <?php foreach ($facilities ?? [] as $facility): ?>
                            <option value="<?= $facility['id'] ?>" <?= $facility_id == $facility['id'] ? 'selected' : '' ?>>
                                <?= esc($facility['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <?php if ($facility_id): ?>
                        <a href="<?= site_url('services') ?>" class="btn btn-secondary ms-2">Clear Filters</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
        <div class="col-md-4 text-end">
            <a href="<?= site_url('services/new') ?>" class="btn btn-success">Add New Service</a>
        </div>
    </div>

    <!-- Services List -->
    <div class="row">
        <?php foreach ($services as $service): ?>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?= esc($service['name']) ?></h5>
                        <p class="card-text">
                            <strong>Description:</strong> <?= esc($service['description'] ?? 'No description') ?>
                        </p>
                        <div class="d-flex gap-2">
                            <a href="<?= site_url('services/' . $service['id']) ?>" class="btn btn-primary">View Details</a>
                            <a href="<?= site_url('services/' . $service['id'] . '/edit') ?>" class="btn btn-warning">Edit</a>
                            <form action="<?= site_url('services/' . $service['id']) ?>" method="post" class="d-inline">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this service?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if (empty($services)): ?>
        <div class="alert alert-info">No services found.</div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>