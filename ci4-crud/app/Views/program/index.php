<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>All Programs</h1>
        <a href="<?= site_url('/programs/new') ?>" class="btn btn-primary">Add New Program</a>
    </div>

    <?php if (session()->has('success')): ?>
        <div class="alert alert-success"><?= session('success') ?></div>
    <?php endif; ?>
    <?php if (session()->has('error')): ?>
        <div class="alert alert-danger"><?= session('error') ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (! empty($programs) && is_array($programs)): ?>
                        <?php foreach ($programs as $program): ?>
                            <tr>
                                <td>
                                    <a href="<?= site_url('programs/' . $program['id']) ?>">
                                        <?= esc($program['name']) ?>
                                    </a>
                                </td>
                                <td><?= esc(substr($program['description'], 0, 50)) ?>...</td>
                                <td><?= esc($program['start_date']) ?></td>
                                <td><?= esc($program['end_date']) ?></td>
                                <td>
                                    <a href="<?= site_url('programs/' . $program['id']) ?>" class="btn btn-sm btn-info">View</a>
                                    <a href="<?= site_url('programs/edit/' . $program['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="<?= site_url('programs/delete/' . $program['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this program?');">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No programs found.</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
