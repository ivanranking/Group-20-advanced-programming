<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h1 class="mb-4">Equipment</h1>

    <!-- Filter Form -->
    <div class="row mb-4">
        <div class="col-md-8">
            <form method="get" class="row g-3">
                <div class="col-md-4">
                    <select name="facility" class="form-select">
                        <option value="">All Facilities</option>
                        <?php foreach ($facilities ?? [] as $facility): ?>
                            <option value="<?= $facility['id'] ?>" <?= $facility_id == $facility['id'] ? 'selected' : '' ?>>
                                <?= esc($facility['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="text" name="search" class="form-control" placeholder="Search by capability or domain" value="<?= esc($search ?? '') ?>">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <?php if ($facility_id || ($search ?? '')): ?>
                        <a href="<?= site_url('equipment') ?>" class="btn btn-secondary ms-2">Clear Filters</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
        <div class="col-md-4 text-end">
            <a href="<?= site_url('equipment/new') ?>" class="btn btn-success">Add New Equipment</a>
        </div>
    </div>

    <!-- Equipment List -->
    <div class="row">
        <?php foreach ($equipment_list as $equipment): ?>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?= esc($equipment['name']) ?></h5>
                        <p class="card-text">
                            <strong>Capability:</strong> <?= esc($equipment['capability'] ?? 'N/A') ?><br>
                            <strong>Domain:</strong> <span class="badge bg-primary"><?= esc($equipment['domain'] ?? 'N/A') ?></span><br>
                            <strong>Description:</strong> <?= esc($equipment['description'] ?? 'No description') ?>
                        </p>
                        <div class="d-flex gap-2">
                            <a href="<?= site_url('equipment/' . $equipment['id']) ?>" class="btn btn-primary">View Details</a>
                            <a href="<?= site_url('equipment/' . $equipment['id'] . '/edit') ?>" class="btn btn-warning">Edit</a>
                            <form action="<?= site_url('equipment/' . $equipment['id']) ?>" method="post" class="d-inline">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this equipment?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if (empty($equipment_list)): ?>
        <div class="alert alert-info">No equipment found.</div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>