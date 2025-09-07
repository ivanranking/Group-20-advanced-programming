<?= csrf_field() ?>
<div class="mb-3">
    <label for="first_name" class="form-label">First Name</label>
    <input type="text" class="form-control" id="first_name" name="first_name" value="<?= old('first_name', $participant['first_name'] ?? '') ?>" required>
</div>
<div class="mb-3">
    <label for="last_name" class="form-label">Last Name</label>
    <input type="text" class="form-control" id="last_name" name="last_name" value="<?= old('last_name', $participant['last_name'] ?? '') ?>" required>
</div>
<div class="mb-3">
    <label for="email" class="form-label">Email</label>
    <input type="email" class="form-control" id="email" name="email" value="<?= old('email', $participant['email'] ?? '') ?>">
</div>
<div class="mb-3">
    <label for="phone" class="form-label">Phone</label>
    <input type="tel" class="form-control" id="phone" name="phone" value="<?= old('phone', $participant['phone'] ?? '') ?>">
</div>
<div class="mb-3">
    <label for="role" class="form-label">Role</label>
    <input type="text" class="form-control" id="role" name="role" value="<?= old('role', $participant['role'] ?? '') ?>">
</div>
