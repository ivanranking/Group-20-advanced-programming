<?= csrf_field() ?>
<div class="mb-3">
    <label for="name" class="form-label">Service Name</label>
    <input type="text" class="form-control" id="name" name="name" value="<?= old('name', $service['name'] ?? '') ?>" required>
</div>
<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control" id="description" name="description" rows="3"><?= old('description', $service['description'] ?? '') ?></textarea>
</div>
<div class="mb-3">
    <label for="cost" class="form-label">Cost</label>
    <input type="number" step="0.01" class="form-control" id="cost" name="cost" value="<?= old('cost', $service['cost'] ?? '') ?>">
</div>
