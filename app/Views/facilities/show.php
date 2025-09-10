<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Facility Details<?= $this->endSection() ?>

<?= $this->section('content') ?>
<h1>Facility Details</h1>
<p><strong>Name:</strong> <?= esc($facility['name']) ?></p>
<p><strong>Location:</strong> <?= esc($facility['location']) ?></p>
<p><strong>Type:</strong> <?= esc($facility['type']) ?></p>
<p><strong>Status:</strong> <?= esc($facility['status']) ?></p>
<a href="<?= site_url('facilities') ?>">Back to Facilities</a>
<?= $this->endSection() ?>