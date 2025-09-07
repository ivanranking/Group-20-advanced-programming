<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <h1 class="mb-4">Participants</h1>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <p class="text-muted">Manage research participants and their project assignments.</p>
        <a href="<?= site_url('participants/new') ?>" class="btn btn-success">Add New Participant</a>
    </div>

    <!-- Participants List -->
    <div class="row">
        <?php foreach ($participants as $participant): ?>
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?= esc($participant['name']) ?></h5>
                        <p class="card-text">
                            <strong>Email:</strong> <?= esc($participant['email']) ?><br>
                            <strong>Role:</strong> <span class="badge bg-primary"><?= esc($participant['role']) ?></span>
                        </p>
                        <a href="<?= site_url('participants/' . $participant['id']) ?>" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <?php if (empty($participants)): ?>
        <div class="alert alert-info">No participants found.</div>
    <?php endif; ?>
</div>
<?= $this->endSection() ?>