<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h1 class="mb-4">Projects</h1>

    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('success') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('error') ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Filter Form -->
    <div class="row mb-4">
        <div class="col-md-8">
            <form method="get" class="row g-3">
                <div class="col-md-4">
                    <select name="facility" class="form-select">
                        <option value="">All Facilities</option>
                        <?php foreach ($facilities as $facility): ?>
                            <option value="<?= $facility['id'] ?>" <?= $facility_id == $facility['id'] ? 'selected' : '' ?>>
                                <?= esc($facility['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <select name="program" class="form-select">
                        <option value="">All Programs</option>
                        <?php foreach ($programs as $program): ?>
                            <option value="<?= $program['id'] ?>" <?= $program_id == $program['id'] ? 'selected' : '' ?>>
                                <?= esc($program['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <?php if ($facility_id || $program_id): ?>
                        <a href="<?= site_url('projects') ?>" class="btn btn-secondary ms-2">Clear Filters</a>
                    <?php endif; ?>
                </div>
            </form>
        </div>
        <div class="col-md-4 text-end">
            <a href="<?= site_url('projects/new') ?>" class="btn btn-success">Add New Project</a>
        </div>
    </div>

    <!-- Projects List -->
    <div class="row">
        <?php foreach ($projects as $project): ?>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?= esc($project['name']) ?></h5>
                        <p class="card-text"><?= esc($project['description']) ?: 'No description' ?></p>
                        <p class="text-muted">
                            Status: <span class="badge bg-<?= $project['status'] == 'active' ? 'success' : ($project['status'] == 'completed' ? 'primary' : 'secondary') ?>"><?= esc($project['status']) ?></span><br>
                            Start: <?= $project['start_date'] ? date('M d, Y', strtotime($project['start_date'])) : 'Not set' ?>
                        </p>
                        <div class="d-flex gap-2">
                            <a href="<?= site_url('projects/' . $project['id']) ?>" class="btn btn-primary">View Details</a>
                            <a href="<?= site_url('projects/' . $project['id'] . '/edit') ?>" class="btn btn-warning">Edit</a>
                            <form action="<?= site_url('projects/' . $project['id']) ?>" method="post" class="d-inline">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this project?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if (empty($projects)): ?>
        <div class="alert alert-info">No projects found.</div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>