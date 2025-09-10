<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Edit Facility<?= $this->endSection() ?>

<?= $this->section('content') ?>
<h1>Edit Facility</h1>
<form method="POST" action="<?= site_url('facilities/update/' . $facility['id']) ?>">
    <?= csrf_field() ?>
    <input type="hidden" name="_method" value="PUT">
    <label>Name:</label><br>
    <input type="text" name="name" value="<?= esc($facility['name']) ?>" required><br>
    <label>Location:</label><br>
    <input type="text" name="location" value="<?= esc($facility['location']) ?>" required><br>
    <label>Type:</label><br>
    <input type="text" name="type" value="<?= esc($facility['type']) ?>" required><br>
    <label>Status:</label><br>
    <input type="text" name="status" value="<?= esc($facility['status']) ?>" required><br><br>
    <button type="submit">Update</button>
</form>
<?= $this->endSection() ?>
