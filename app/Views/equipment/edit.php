<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Equipment</h4>
                </div>
                <div class="card-body">
                    <form action="<?= site_url('equipment/' . $equipment['id']) ?>" method="post">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_method" value="PUT">

                        <div class="mb-3">
                            <label for="name" class="form-label">Name *</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= old('name', $equipment['name']) ?>" required>
                            <?php if (isset($errors['name'])): ?>
                                <div class="text-danger small"><?= $errors['name'] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="capability" class="form-label">Capability</label>
                            <input type="text" class="form-control" id="capability" name="capability" value="<?= old('capability', $equipment['capability']) ?>" placeholder="e.g., High magnification imaging">
                        </div>

                        <div class="mb-3">
                            <label for="domain" class="form-label">Domain</label>
                            <input type="text" class="form-control" id="domain" name="domain" value="<?= old('domain', $equipment['domain']) ?>" placeholder="e.g., Biology, Chemistry">
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Detailed description of the equipment"><?= old('description', $equipment['description']) ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="facility_id" class="form-label">Facility</label>
                            <select class="form-select" id="facility_id" name="facility_id">
                                <option value="">Select Facility</option>
                                <?php foreach ($facilities as $facility): ?>
                                    <option value="<?= $facility['id'] ?>" <?= old('facility_id', $equipment['facility_id']) == $facility['id'] ? 'selected' : '' ?>>
                                        <?= esc($facility['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?= site_url('equipment/' . $equipment['id']) ?>" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Equipment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>