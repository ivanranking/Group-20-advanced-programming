<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <a href="<?= site_url('/programs') ?>">&laquo; Back to all programs</a>

    <div class="card my-4">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h2><?= esc($program['name']) ?></h2>
                <div>
                    <a href="<?= site_url('programs/edit/' . $program['id']) ?>" class="btn btn-warning">Edit Program</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <p><?= esc($program['description']) ?></p>
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <strong>Start Date:</strong> <?= esc($program['start_date']) ?>
                </div>
                <div class="col-md-6">
                    <strong>End Date:</strong> <?= esc($program['end_date']) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3>Projects in this Program</h3>
        <a href="<?= site_url('/projects/new?program_id=' . $program['id']) ?>" class="btn btn-primary">Add New Project</a>
    </div>

    <div class="card">
        <div class="card-body">
            <?php if (! empty($projects)): ?>
                <ul class="list-group list-group-flush">
                    <?php foreach ($projects as $project): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <a href="<?= site_url('projects/' . $project['id']) ?>"><?= esc($project['name']) ?></a>
                            <span class="badge bg-secondary"><?= esc($project['status']) ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p class="text-center">No projects have been added to this program yet.</p>
            <?php endif; ?>
        </div>
    </div>

</div>

<?= $this->endSection() ?>
