<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4><?= esc($equipment['name']) ?></h4>
                    <div>
                        <a href="<?= site_url('equipment/' . $equipment['id'] . '/edit') ?>" class="btn btn-warning">Edit</a>
                        <form action="<?= site_url('equipment/' . $equipment['id']) ?>" method="post" class="d-inline">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="DELETE">
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this equipment?')">Delete</button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <p class="card-text"><?= esc($equipment['description']) ?: 'No description' ?></p>
                    <div class="row">
                        <div class="col-md-6">
                            <strong>Facility:</strong> <?= $facility ? esc($facility['name']) : 'Not assigned' ?>
                        </div>
                        <div class="col-md-6">
                            <strong>Domain:</strong> <?= esc($equipment['domain'] ?? 'Not specified') ?>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <strong>Capability:</strong> <?= esc($equipment['capability'] ?? 'Not specified') ?>
                        </div>
                        <div class="col-md-6">
                            <strong>Created:</strong> <?= date('M d, Y', strtotime($equipment['created_at'])) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5>Equipment Information</h5>
                </div>
                <div class="card-body">
                    <p><strong>Equipment ID:</strong> <?= $equipment['id'] ?></p>
                    <p><strong>Last Updated:</strong> <?= date('M d, Y H:i', strtotime($equipment['updated_at'])) ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-3">
        <a href="<?= site_url('equipment') ?>" class="btn btn-secondary">Back to Equipment</a>
    </div>
</div>
<?= $this->endSection() ?>