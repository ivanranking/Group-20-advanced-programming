<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1><?= esc($outcome['title']) ?></h1>
        <div>
            <a href="<?= site_url('outcomes/' . $outcome['id'] . '/edit') ?>" class="btn btn-warning">Edit</a>
            <a href="<?= site_url('outcomes') ?>" class="btn btn-secondary">Back to List</a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <p><strong>Description:</strong> <?= esc($outcome['description']) ?: 'No description' ?></p>

            <?php if ($outcome['link']): ?>
                <p><strong>Link:</strong> <a href="<?= esc($outcome['link']) ?>" target="_blank"><?= esc($outcome['link']) ?></a></p>
            <?php endif; ?>

            <?php if ($outcome['file_path']): ?>
                <p><strong>File:</strong> <a href="<?= site_url('outcomes/download/' . $outcome['id']) ?>" class="btn btn-sm btn-outline-primary">Download File</a></p>
            <?php endif; ?>

            <p><strong>Created:</strong> <?= date('M d, Y', strtotime($outcome['created_at'])) ?></p>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h5>Danger Zone</h5>
        </div>
        <div class="card-body">
            <p class="text-muted">Deleting this outcome cannot be undone.</p>
            <form action="<?= site_url('outcomes/' . $outcome['id']) ?>" method="post" onsubmit="return confirm('Are you sure you want to delete this outcome?')">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="DELETE">
                <button type="submit" class="btn btn-danger">Delete Outcome</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>