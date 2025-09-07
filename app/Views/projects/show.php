<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><?= esc($project['name']) ?></h1>
        <div>
            <a href="<?= site_url('projects/' . $project['id'] . '/edit') ?>" class="btn btn-warning">Edit</a>
            <a href="<?= site_url('projects') ?>" class="btn btn-secondary">Back to List</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Project Details</h5>
                </div>
                <div class="card-body">
                    <p><strong>Description:</strong> <?= esc($project['description']) ?: 'No description' ?></p>
                    <p><strong>Status:</strong> <span class="badge bg-<?= $project['status'] == 'active' ? 'success' : ($project['status'] == 'completed' ? 'primary' : 'secondary') ?>"><?= esc($project['status']) ?></span></p>
                    <p><strong>Start Date:</strong> <?= $project['start_date'] ? date('M d, Y', strtotime($project['start_date'])) : 'Not set' ?></p>
                    <p><strong>End Date:</strong> <?= $project['end_date'] ? date('M d, Y', strtotime($project['end_date'])) : 'Not set' ?></p>
                    <p><strong>Created:</strong> <?= date('M d, Y', strtotime($project['created_at'])) ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5>Quick Actions</h5>
                </div>
                <div class="card-body">
                    <a href="<?= site_url('outcomes?project=' . $project['id']) ?>" class="btn btn-primary btn-sm w-100 mb-2">View Outcomes</a>
                    <a href="<?= site_url('participants?project=' . $project['id']) ?>" class="btn btn-info btn-sm w-100 mb-2">View Participants</a>
                    <a href="<?= site_url('projects/' . $project['id'] . '/add-participant') ?>" class="btn btn-success btn-sm w-100">Add Participant</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Participants -->
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Participants (<?= count($participants) ?>)</h5>
            <a href="<?= site_url('projects/' . $project['id'] . '/add-participant') ?>" class="btn btn-sm btn-success">Add Participant</a>
        </div>
        <div class="card-body">
            <?php if (!empty($participants)): ?>
                <div class="row">
                    <?php foreach ($participants as $participant): ?>
                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <h6 class="card-title"><?= esc($participant->name) ?></h6>
                                    <p class="card-text small">
                                        <strong>Email:</strong> <?= esc($participant->email) ?><br>
                                        <strong>Role:</strong> <?= esc($participant->role) ?>
                                    </p>
                                    <a href="<?= site_url('projects/' . $project['id'] . '/remove-participant/' . $participant->id) ?>" 
                                       class="btn btn-sm btn-danger" 
                                       onclick="return confirm('Remove this participant from the project?')">Remove</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-muted">No participants assigned to this project.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Outcomes -->
    <div class="card mb-4">
        <div class="card-header">
            <h5>Outcomes (<?= count($outcomes) ?>)</h5>
        </div>
        <div class="card-body">
            <?php if (!empty($outcomes)): ?>
                <div class="list-group">
                    <?php foreach ($outcomes as $outcome): ?>
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h6 class="mb-1"><?= esc($outcome->title) ?></h6>
                                <small class="text-muted">
                                    <?php if ($outcome->file_path): ?>
                                        <a href="<?= site_url('uploads/' . $outcome->file_path) ?>" target="_blank">Download</a>
                                    <?php elseif ($outcome->link): ?>
                                        <a href="<?= esc($outcome->link) ?>" target="_blank">View Link</a>
                                    <?php endif; ?>
                                </small>
                            </div>
                            <p class="mb-1"><?= esc($outcome->description) ?: 'No description' ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p class="text-muted">No outcomes for this project.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>