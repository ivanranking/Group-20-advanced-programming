<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>All Projects</h1>
        <a href="<?= site_url('/projects/new') ?>" class="btn btn-primary">Add New Project</a>
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
                        <th>Program</th>
                        <th>Status</th>
                        <th>Start Date</th>
                        <th>Budget</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (! empty($projects) && is_array($projects)): ?>
                        <?php foreach ($projects as $project): ?>
                            <tr>
                                <td>
                                    <a href="<?= site_url('projects/' . $project['id']) ?>">
                                        <?= esc($project['name']) ?>
                                    </a>
                                </td>
                                <td><?= esc($project['program_name'] ?? 'N/A') ?></td>
                                <td><span class="badge bg-info"><?= esc($project['status']) ?></span></td>
                                <td><?= esc($project['start_date']) ?></td>
                                <td>$<?= number_format($project['budget'], 2) ?></td>
                                <td>
                                    <a href="<?= site_url('projects/' . $project['id']) ?>" class="btn btn-sm btn-info">View</a>
                                    <a href="<?= site_url('projects/edit/' . $project['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="<?= site_url('projects/delete/' . $project['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this project? This will also delete its outcomes and all links to participants, equipment, and services.');">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">No projects found.</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
