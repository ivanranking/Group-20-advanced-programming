<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h1 class="mb-4">Facilities</h1>

    <!-- Search Form -->
    <div class="row mb-4">
        <div class="col-md-6">
            <form method="get" class="d-flex">
                <input type="text" name="search" class="form-control me-2" placeholder="Search facilities..." value="<?= esc($search) ?>">
                <button type="submit" class="btn btn-primary">Search</button>
                <?php if ($search): ?>
                    <a href="<?= site_url('facilities') ?>" class="btn btn-secondary ms-2">Clear</a>
                <?php endif; ?>
            </form>
        </div>
        <div class="col-md-6 text-end">
            <a href="<?= site_url('facilities/new') ?>" class="btn btn-success">Add New Facility</a>
        </div>
    </div>

    <!-- Facilities List -->
    <div class="row">
        <?php foreach ($facilities as $facility): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?= esc($facility['name']) ?></h5>
                        <p class="card-text"><?= esc($facility['description']) ?: 'No description' ?></p>
                        <p class="text-muted">Location: <?= esc($facility['location']) ?: 'Not specified' ?></p>
                        <a href="<?= site_url('facilities/' . $facility['id']) ?>" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if (empty($facilities)): ?>
        <div class="alert alert-info">No facilities found.</div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>