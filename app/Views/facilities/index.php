<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Facilities<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Facilities</h1>
        <a href="<?= site_url('facilities/create') ?>" class="btn btn-primary">
            <i class="bi bi-plus-lg"></i> Add Facility
        </a>
    </div>

    <!-- Search -->
    <form method="get" action="<?= site_url('facilities') ?>" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search facilities..." value="<?= isset($_GET['search']) ? esc($_GET['search']) : '' ?>">
            <button class="btn btn-outline-secondary" type="submit">
                <i class="bi bi-search"></i> Search
            </button>
        </div>
    </form>

    <!-- Facilities Table -->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Location</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($facilities) && is_array($facilities)): ?>
                        <?php foreach ($facilities as $facility): ?>
                            <tr>
                                <td><?= esc($facility['id']) ?></td>
                                <td><?= esc($facility['name']) ?></td>
                                <td><?= esc($facility['location']) ?></td>
                                <td><?= esc($facility['description']) ?></td>
                                <td>
                                    <a href="<?= site_url('facilities/edit/'.$facility['id']) ?>" class="btn btn-sm btn-warning">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </a>
                                    <a href="<?= site_url('facilities/delete/'.$facility['id']) ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this facility?')">
                                        <i class="bi bi-trash"></i> Delete
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No facilities found.</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Pagination (if needed) -->
    <?php if (isset($pager)) : ?>
        <div class="mt-3">
            <?= $pager->links() ?>
        </div>
    <?php endif ?>
</div>
<?= $this->endSection() ?>
