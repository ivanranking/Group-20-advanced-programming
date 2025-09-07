<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Facility</h4>
                </div>
                <div class="card-body">
                    <form action="<?= site_url('facilities/' . $facility['id']) ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="PUT">

                        <div class="mb-3">
                            <label for="name" class="form-label">Name *</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= old('name', $facility['name']) ?>" required>
                            <?php if (isset($errors['name'])): ?>
                                <div class="text-danger small"><?= $errors['name'] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"><?= old('description', $facility['description']) ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location" value="<?= old('location', $facility['location']) ?>">
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?= site_url('facilities/' . $facility['id']) ?>" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Facility</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">
                    <h5>Danger Zone</h5>
                </div>
                <div class="card-body">
                    <p class="text-muted">Deleting this facility will also disassociate it from all related projects, services, and equipment.</p>
                    <form action="<?= site_url('facilities/' . $facility['id']) ?>" method="post" onsubmit="return confirm('Are you sure you want to delete this facility?')">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger">Delete Facility</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>