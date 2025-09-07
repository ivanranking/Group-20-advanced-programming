<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4><?= esc($program['name']) ?></h4>
                    <div>
                        <a href="<?= site_url('programs/' . $program['id'] . '/edit') ?>" class="btn btn-warning">Edit</a>
                        <form action="<?= site_url('programs/' . $program['id']) ?>" method="post" class="d-inline">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this program?')">Delete</button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text"><?= esc($program['description']) ?: 'No description' ?></p>
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Start Date:</strong> <?= $program['start_date'] ? date('M d, Y', strtotime($program['start_date'])) : 'Not set' ?>
                        </div>
                        <div class="col-md-6">
                            <strong>End Date:</strong> <?= $program['end_date'] ? date('M d, Y', strtotime($program['end_date'])) : 'Not set' ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Associated Projects</h5>
                </div>
                <div class="card-body">
                    <?php if (!empty($projects)): ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($projects as $project): ?>
                                <li class="list-group-item">
                                    <a href="<?= site_url('projects/' . $project['id']) ?>"><?= esc($project['name']) ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted">No projects associated with this program.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-3">
        <a href="<?= site_url('programs') ?>" class="btn btn-secondary">Back to Programs</a>
    </div>
</div>
<?= $this->endSection() ?>