<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h1 class="mb-4">Outcomes</h1>

    <!-- Filter Form -->
    <div class="row mb-4">
        <div class="col-md-6">
            <form method="get" class="d-flex">
                <select name="project" class="form-select me-2">
                    <option value="">All Projects</option>
                    <!-- Add project options here -->
                </select>
                <button type="submit" class="btn btn-primary">Filter</button>
                <?php if ($project_id): ?>
                    <a href="<?= site_url('outcomes') ?>" class="btn btn-secondary ms-2">Clear</a>
                <?php endif; ?>
            </form>
        </div>
        <div class="col-md-6 text-end">
            <a href="<?= site_url('outcomes/new') ?>" class="btn btn-success">Add New Outcome</a>
        </div>
    </div>

    <!-- Outcomes List -->
    <div class="row">
        <?php foreach ($outcomes as $outcome): ?>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?= esc($outcome['title']) ?></h5>
                        <p class="card-text"><?= esc($outcome['description']) ?: 'No description' ?></p>
                        <p class="text-muted">
                            <?php if ($outcome['file_path']): ?>
                                <a href="<?= site_url('outcomes/download/' . $outcome['id']) ?>" class="btn btn-sm btn-outline-primary">Download File</a>
                            <?php endif; ?>
                            <?php if ($outcome['link']): ?>
                                <a href="<?= esc($outcome['link']) ?>" target="_blank" class="btn btn-sm btn-outline-secondary">View Link</a>
                            <?php endif; ?>
                        </p>
                        <a href="<?= site_url('outcomes/' . $outcome['id']) ?>" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if (empty($outcomes)): ?>
        <div class="alert alert-info">No outcomes found.</div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>