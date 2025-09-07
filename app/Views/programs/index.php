<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h1 class="mb-4">Programs</h1>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <p class="text-muted">Manage research programs and their associated projects.</p>
        <a href="<?= site_url('programs/new') ?>" class="btn btn-success">Add New Program</a>
    </div>

    <!-- Programs List -->
    <div class="row">
        <?php foreach ($programs as $program): ?>
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?= esc($program['name']) ?></h5>
                        <p class="card-text"><?= esc($program['description']) ?: 'No description' ?></p>
                        <p class="text-muted">
                            Start: <?= $program['start_date'] ? date('M d, Y', strtotime($program['start_date'])) : 'Not set' ?><br>
                            End: <?= $program['end_date'] ? date('M d, Y', strtotime($program['end_date'])) : 'Not set' ?>
                        </p>
                        <div class="d-flex gap-2">
                            <a href="<?= site_url('programs/' . $program['id']) ?>" class="btn btn-primary">View Details</a>
                            <a href="<?= site_url('programs/' . $program['id'] . '/edit') ?>" class="btn btn-warning">Edit</a>
                            <form action="<?= site_url('programs/' . $program['id']) ?>" method="post" class="d-inline">
                                <?= csrf_field() ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this program?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if (empty($programs)): ?>
        <div class="alert alert-info">No programs found.</div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>