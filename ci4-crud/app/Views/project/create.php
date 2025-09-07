<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="container mt-5">
    <h1>Create a New Project</h1>

    <div class="card">
        <div class="card-body">
            <?php if (session()->has('errors')): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach (session('errors') as $error): ?>
                            <li><?= esc($error) ?></li>
                        <?php endforeach ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('/projects/create') ?>" method="post">
                <?= csrf_field() ?>
                
                <div class="mb-3">
                    <label for="name" class="form-label">Project Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= old('name') ?>" required>
                </div>

                <div class="mb-3">
                    <label for="program_id" class="form-label">Associated Program (Optional)</label>
                    <select class="form-select" id="program_id" name="program_id">
                        <option value="">None</option>
                        <?php foreach($programs as $program): ?>
                        <option value="<?= $program['id'] ?>" <?= (old('program_id') ?? service('request')->getGet('program_id')) == $program['id'] ? 'selected' : '' ?>>
                            <?= esc($program['name']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4"><?= old('description') ?></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" id="start_date" name="start_date" value="<?= old('start_date') ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="end_date" class="form-label">End Date</label>
                        <input type="date" class="form-control" id="end_date" name="end_date" value="<?= old('end_date') ?>">
                    </div>
                </div>
                
                 <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="budget" class="form-label">Budget</label>
                        <input type="number" step="0.01" class="form-control" id="budget" name="budget" value="<?= old('budget') ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="Planning" <?= old('status') === 'Planning' ? 'selected' : '' ?>>Planning</option>
                            <option value="In Progress" <?= old('status') === 'In Progress' ? 'selected' : '' ?>>In Progress</option>
                            <option value="Completed" <?= old('status') === 'Completed' ? 'selected' : '' ?>>Completed</option>
                            <option value="On Hold" <?= old('status') === 'On Hold' ? 'selected' : '' ?>>On Hold</option>
                        </select>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Create Project</button>
                <a href="<?= site_url('/projects') ?>" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
