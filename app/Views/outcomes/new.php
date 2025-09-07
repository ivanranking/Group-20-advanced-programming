<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Create New Outcome</h4>
                </div>
                <div class="card-body">
                    <form action="<?= site_url('outcomes') ?>" method="post" enctype="multipart/form-data">
                        <?= csrf_field() ?>

                        <div class="mb-3">
                            <label for="project_id" class="form-label">Project *</label>
                            <select class="form-select" id="project_id" name="project_id" required>
                                <option value="">Select Project</option>
                                <?php foreach ($projects as $project): ?>
                                    <option value="<?= $project['id'] ?>" <?= old('project_id') == $project['id'] ? 'selected' : '' ?>>
                                        <?= esc($project['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?php if (isset($errors['project_id'])): ?>
                                <div class="text-danger small"><?= $errors['project_id'] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">Title *</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?= old('title') ?>" required>
                            <?php if (isset($errors['title'])): ?>
                                <div class="text-danger small"><?= $errors['title'] ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"><?= old('description') ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="link" class="form-label">Link (URL)</label>
                            <input type="url" class="form-control" id="link" name="link" value="<?= old('link') ?>" placeholder="https://example.com">
                        </div>

                        <div class="mb-3">
                            <label for="file_path" class="form-label">Upload File</label>
                            <input type="file" class="form-control" id="file_path" name="file_path" accept=".pdf,.doc,.docx,.txt,.jpg,.png">
                            <div class="form-text">Supported formats: PDF, DOC, DOCX, TXT, JPG, PNG</div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="<?= site_url('outcomes') ?>" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Create Outcome</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>