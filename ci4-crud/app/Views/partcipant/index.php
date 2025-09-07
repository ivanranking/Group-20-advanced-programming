<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>All Participants</h1>
        <a href="<?= site_url('/participants/new') ?>" class="btn btn-primary">Add New Participant</a>
    </div>

    <?php if (session()->has('success')): ?>
        <div class="alert alert-success"><?= session('success') ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($participants as $p): ?>
                    <tr>
                        <td><?= esc($p['first_name'] . ' ' . $p['last_name']) ?></td>
                        <td><?= esc($p['email']) ?></td>
                        <td><?= esc($p['phone']) ?></td>
                        <td><?= esc($p['role']) ?></td>
                        <td>
                            <a href="<?= site_url('participants/edit/' . $p['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                            <form action="<?= site_url('participants/delete/' . $p['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                <?= csrf_field() ?>
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
