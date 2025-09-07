<?= csrf_field() ?>
<input type="hidden" name="project_id" value="<?= old('project_id', $outcome['project_id'] ?? $project['id']) ?>">

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control" id="description" name="description" rows="3" required><?= old('description', $outcome['description'] ?? '') ?></textarea>
</div>
<div class="row">
    <div class="col-md-4 mb-3">
        <label for="metric" class="form-label">Metric</label>
        <input type="text" class="form-control" name="metric" id="metric" value="<?= old('metric', $outcome['metric'] ?? '') ?>">
    </div>
    <div class="col-md-4 mb-3">
        <label for="target_value" class="form-label">Target Value</label>
        <input type="number" step="any" class="form-control" name="target_value" id="target_value" value="<?= old('target_value', $outcome['target_value'] ?? '') ?>">
    </div>
    <div class="col-md-4 mb-3">
        <label for="actual_value" class="form-label">Actual Value</label>
        <input type="number" step="any" class="form-control" name="actual_value" id="actual_value" value="<?= old('actual_value', $outcome['actual_value'] ?? '') ?>">
    </div>
</div>
