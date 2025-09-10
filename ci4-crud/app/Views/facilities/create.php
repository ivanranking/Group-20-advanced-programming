<?= $this->extend('layouts/default') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h2>Create New Facility</h2>
            <?= form_open('/facilities/store') ?>
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= old('name') ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3"><?= old('description') ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create Facility</button>
            <a href="/facilities" class="btn btn-secondary">Cancel</a>
            <?= form_close() ?>
        </div>
    </div>
</div>
<?= $this->endSection() ?>