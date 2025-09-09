<?= $this->extend('layouts/default') ?> 

<?= $this->section('title') ?>Edit Facility<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container py-5">

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Edit Facility</h2>
        <a href="<?= site_url('facilities') ?>" class="btn btn-outline-secondary rounded-pill shadow-sm">
            <i class="fas fa-arrow-left me-2"></i> Back to Facilities
        </a>
    </div>

    <!-- Card -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4">
            <form method="post" action="<?= site_url('facilities/update/' . $facility['id']) ?>" class="needs-validation" novalidate>
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">

                <!-- Name -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Facility Name</label>
                    <input type="text" name="name" value="<?= esc($facility['name']) ?>" 
                           class="form-control rounded-pill shadow-sm" required>
                </div>

                <!-- Location -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Location</label>
                    <input type="text" name="location" value="<?= esc($facility['location']) ?>" 
                           class="form-control rounded-pill shadow-sm">
                </div>

                <!-- Type -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Type</label>
                    <input type="text" name="type" value="<?= esc($facility['type']) ?>" 
                           class="form-control rounded-pill shadow-sm">
                </div>

                <!-- Status -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Status</label>
                    <select name="status" class="form-select rounded-pill shadow-sm">
                        <option value="active" <?= ($facility['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active</option>
                        <option value="inactive" <?= ($facility['status'] ?? '') === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">Description</label>
                    <textarea name="description" rows="4" class="form-control rounded-4 shadow-sm"><?= esc($facility['description']) ?></textarea>
                </div>

                <!-- Submit -->
                <div class="text-end">
                    <button type="submit" class="btn btn-primary rounded-pill px-5 shadow-sm">
                        <i class="fas fa-save me-2"></i> Update Facility
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>
<?= $this->endSection() ?>
