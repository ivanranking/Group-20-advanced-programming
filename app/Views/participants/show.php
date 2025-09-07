<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><?= esc($participant['name']) ?></h1>
        <div>
            <a href="<?= site_url('participants/' . $participant['id'] . '/edit') ?>" class="btn btn-warning">Edit</a>
            <a href="<?= site_url('participants') ?>" class="btn btn-secondary">Back to List</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Participant Details</h5>
                </div>
                <div class="card-body">
                    <p><strong>Email:</strong> <?= esc($participant['email']) ?></p>
                    <p><strong>Role:</strong> <span class="badge bg-primary"><?= esc($participant['role']) ?></span></p>
                    <p><strong>Joined:</strong> <?= date('M d, Y', strtotime($participant['created_at'])) ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Quick Actions</h5>
                </div>
                <div class="card-body">
                    <a href="<?= site_url('projects?participant=' . $participant['id']) ?>" class="btn btn-primary btn-sm w-100 mb-2">View Projects</a>
                    <a href="<?= site_url('participants/' . $participant['id'] . '/assign-project') ?>" class="btn btn-success btn-sm w-100">Assign to Project</a>
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
                                <small class="text-muted">
                                    <span class="badge bg-<?= $project->status == 'active' ? 'success' : ($project->status == 'completed' ? 'primary' : 'secondary') ?>">
                                        <?= esc($project->status) ?>
                                    </span>
                                </small>
                            </div>
                            <p class="mb-1"><?= esc($project->description) ?: 'No description' ?></p>
                            <small class="text-muted">
                                <?php if ($project->facility_id): ?>
                                    Facility: <?= esc($project->facility_name ?? 'Unknown') ?>
                                <?php endif; ?>
                            </small>
                        </a>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-muted">No projects assigned to this participant.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>