<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Participant</h4>
                </div>
                <div class="card-body">
                    <form action="<?= site_url('participants/' . $participant['id']) ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="PUT">

                        <div class="mb-3">
                            <label for="name" class="form-label">Name *</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= old('name', $participant['name']) ?>" required>
                            <?php if (isset($errors['name'])): ?>
                                <div class="text-danger small"><?= $errors['name'] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= old('email', $participant['email']) ?>" required>
                            <?php if (isset($errors['email'])): ?>
                                <div class="text-danger small"><?= $errors['email'] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select" id="role" name="role">
                                <option value="researcher" <?= old('role', $participant['role']) == 'researcher' ? 'selected' : '' ?>>Researcher</option>
                                <option value="student" <?= old('role', $participant['role']) == 'student' ? 'selected' : '' ?>>Student</option>
                                <option value="faculty" <?= old('role', $participant['role']) == 'faculty' ? 'selected' : '' ?>>Faculty</option>
                                <option value="staff" <?= old('role', $participant['role']) == 'staff' ? 'selected' : '' ?>>Staff</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?= site_url('participants/' . $participant['id']) ?>" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Participant</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h5>Danger Zone</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">Deleting this participant will remove them from all associated projects.</p>
                    <form action="<?= site_url('participants/' . $participant['id']) ?>" method="post" onsubmit="return confirm('Are you sure you want to delete this participant?')">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger">Delete Participant</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>