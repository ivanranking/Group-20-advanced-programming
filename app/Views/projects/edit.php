<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Project</h4>
                </div>
                <div class="card-body">
                    <form action="<?= site_url('projects/' . $project['id']) ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="PUT">

                        <div class="mb-3">
                            <label for="name" class="form-label">Name *</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= old('name', $project['name']) ?>" required>
                            <?php if (isset($errors['name'])): ?>
                                <div class="text-danger small"><?= $errors['name'] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"><?= old('description', $project['description']) ?></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="program_id" class="form-label">Program</label>
                                <select class="form-select" id="program_id" name="program_id">
                                    <option value="">Select Program</option>
                                    <?php foreach ($programs as $program): ?>
                                        <option value="<?= $program['id'] ?>" <?= old('program_id', $project['program_id']) == $program['id'] ? 'selected' : '' ?>>
                                            <?= esc($program['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="facility_id" class="form-label">Facility</label>
                                <select class="form-select" id="facility_id" name="facility_id">
                                    <option value="">Select Facility</option>
                                    <?php foreach ($facilities as $facility): ?>
                                        <option value="<?= $facility['id'] ?>" <?= old('facility_id', $project['facility_id']) == $facility['id'] ? 'selected' : '' ?>>
                                            <?= esc($facility['name']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status">
                                    <option value="active" <?= old('status', $project['status']) == 'active' ? 'selected' : '' ?>>Active</option>
                                    <option value="inactive" <?= old('status', $project['status']) == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                                    <option value="completed" <?= old('status', $project['status']) == 'completed' ? 'selected' : '' ?>>Completed</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="date" class="form-control" id="start_date" name="start_date" value="<?= old('start_date', $project['start_date']) ?>">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="date" class="form-control" id="end_date" name="end_date" value="<?= old('end_date', $project['end_date']) ?>">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?= site_url('projects/' . $project['id']) ?>" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Project</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h5>Danger Zone</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">Deleting this project will also remove all associated participants and outcomes.</p>
                    <form action="<?= site_url('projects/' . $project['id']) ?>" method="post" onsubmit="return confirm('Are you sure you want to delete this project?')">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger">Delete Project</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>