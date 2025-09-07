<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Create New Participant</h4>
                </div>
                <div class="card-body">
                    <form action="<?= site_url('participants') ?>" method="post">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label for="name" class="form-label">Name *</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= old('name') ?>" required>
                            <?php if (isset($errors['name'])): ?>
                                <div class="text-danger small"><?= $errors['name'] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email *</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= old('email') ?>" required>
                            <?php if (isset($errors['email'])): ?>
                                <div class="text-danger small"><?= $errors['email'] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select class="form-select" id="role" name="role">
                                <option value="researcher" <?= old('role', 'researcher') == 'researcher' ? 'selected' : '' ?>>Researcher</option>
                                <option value="student" <?= old('role') == 'student' ? 'selected' : '' ?>>Student</option>
                                <option value="faculty" <?= old('role') == 'faculty' ? 'selected' : '' ?>>Faculty</option>
                                <option value="staff" <?= old('role') == 'staff' ? 'selected' : '' ?>>Staff</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?= site_url('participants') ?>" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Create Participant</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>