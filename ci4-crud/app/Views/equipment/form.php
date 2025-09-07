<?= csrf_field() ?>
<div class="mb-3">
    <label for="name" class="form-label">Equipment Name</label>
    <input type="text" class="form-control" id="name" name="name" value="<?= old('name', $equipment['name'] ?? '') ?>" required>
</div>
<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea class="form-control" id="description" name="description" rows="3"><?= old('description', $equipment['description'] ?? '') ?></textarea>
</div>
<div class="mb-3">
    <label for="serial_number" class="form-label">Serial Number</label>
    <input type="text" class="form-control" id="serial_number" name="serial_number" value="<?= old('serial_number', $equipment['serial_number'] ?? '') ?>">
</div>
<div class="row">
    <div class="col-md-6 mb-3">
        <label for="purchase_date" class="form-label">Purchase Date</label>
        <input type="date" class="form-control" id="purchase_date" name="purchase_date" value="<?= old('purchase_date', $equipment['purchase_date'] ?? '') ?>">
    </div>
    <div class="col-md-6 mb-3">
        <label for="status" class="form-label">Status</label>
        <select class="form-select" id="status" name="status" required>
            <option value="Available" <?= (old('status', $equipment['status'] ?? '') === 'Available') ? 'selected' : '' ?>>Available</option>
            <option value="In Use" <?= (old('status', $equipment['status'] ?? '') === 'In Use') ? 'selected' : '' ?>>In Use</option>
            <option value="Maintenance" <?= (old('status', $equipment['status'] ?? '') === 'Maintenance') ? 'selected' : '' ?>>Maintenance</option>
        </select>
    </div>
</div>
