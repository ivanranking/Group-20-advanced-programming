<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><?= esc($facility['name']) ?></h1>
        <div>
            <a href="<?= site_url('facilities/' . $facility['id'] . '/edit') ?>" class="btn btn-warning">Edit</a>
            <a href="<?= site_url('facilities') ?>" class="btn btn-secondary">Back to List</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Facility Details</h5>
                </div>
                <div class="card-body">
                    <p><strong>Description:</strong> <?= esc($facility['description']) ?: 'No description' ?></p>
                    <p><strong>Location:</strong> <?= esc($facility['location']) ?: 'Not specified' ?></p>
                    <p><strong>Created:</strong> <?= date('M d, Y', strtotime($facility['created_at'])) ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Quick Actions</h5>
                </div>
                <div class="card-body">
                    <a href="<?= site_url('projects?facility=' . $facility['id']) ?>" class="btn btn-primary btn-sm w-100 mb-2">View Projects</a>
                    <a href="<?= site_url('services?facility=' . $facility['id']) ?>" class="btn btn-info btn-sm w-100 mb-2">View Services</a>
                    <a href="<?= site_url('equipment?facility=' . $facility['id']) ?>" class="btn btn-success btn-sm w-100">View Equipment</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Associated Projects -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Projects (<?= count($projects) ?>)</h5>
        </div>
        <div class="card-body">
            <?php if (!empty($projects)): ?>
                <div class="list-group">
                    <?php foreach ($projects as $project): ?>
                        <a href="<?= site_url('projects/' . $project->id) ?>" class="list-group-item list-group-item-action">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1"><?= esc($project->name) ?></h6>
                                <small class="text-muted"><?= esc($project->status) ?></small>
                            </div>
                            <p class="mb-1"><?= esc($project->description) ?: 'No description' ?></p>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-muted">No projects associated with this facility.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Associated Services -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Services (<?= count($services) ?>)</h5>
        </div>
        <div class="card-body">
            <?php if (!empty($services)): ?>
                <div class="row">
                    <?php foreach ($services as $service): ?>
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-title"><?= esc($service->name) ?></h6>
                                    <p class="card-text small"><?= esc($service->description) ?: 'No description' ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-muted">No services associated with this facility.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Associated Equipment -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Equipment (<?= count($equipment) ?>)</h5>
        </div>
        <div class="card-body">
            <?php if (!empty($equipment)): ?>
                <div class="row">
                    <?php foreach ($equipment as $item): ?>
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-title"><?= esc($item->name) ?></h6>
                                    <p class="card-text small">
                                        <strong>Capability:</strong> <?= esc($item->capability) ?: 'N/A' ?><br>
                                        <strong>Domain:</strong> <?= esc($item->domain) ?: 'N/A' ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-muted">No equipment associated with this facility.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>