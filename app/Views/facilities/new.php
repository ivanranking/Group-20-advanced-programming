<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Create Facility<?= $this->endSection() ?>

<?= $this->section('content') ?>
<style>
    .content {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 2rem;
        background-color: #f3f4f6;
    }
    .facility-card {ou
        background: white;
        padding: 2rem;
        border-radius: 1.5rem;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        width: 100%;
        max-width: 32rem;
    }
    .form-input {
        width: 100%;
        padding: 0.75rem;
        border-radius: 0.5rem;
        border: 1px solid #d1d5db;
        outline: none;
        margin-bottom: 1rem;
    }
    .form-input:focus {
        border-color: #3b82f6;
    }
    .form-label {
        display: block;
        font-weight: 500;
        color: #374151;
        margin-bottom: 0.5rem;
    }
    .btn-submit {
        background-color: #2563eb;
        color: white;
        padding: 0.75rem 2rem;
        border-radius: 0.5rem;
        font-weight: 500;
        border: none;
        cursor: pointer;
        transition: background-color 0.3s;
    }
    .btn-submit:hover {
        background-color: #1d4ed8;
    }
    .btn-back {
        background-color: #6b7280;
        color: white;
        padding: 0.75rem 2rem;
        border-radius: 0.5rem;
        font-weight: 500;
        text-decoration: none;
        display: inline-block;
        margin-right: 1rem;
        transition: background-color 0.3s;
    }
    .btn-back:hover {
        background-color: #4b5563;
    }
</style>

<div class="facility-card">
    <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">Create New Facility</h1>

    <form method="POST" action="<?= site_url('facilities/store') ?>">
        <?= csrf_field() ?>

        <label class="form-label">Name:</label>
        <input type="text" name="name" class="form-input" required>

        <label class="form-label">Location:</label>
        <input type="text" name="location" class="form-input" required>

        <label class="form-label">Type:</label>
        <input type="text" name="type" class="form-input" required>

        <label class="form-label">Status:</label>
        <select name="status" class="form-input" required>
            <option value="active">Active</option>
            <option value="inactive">Inactive</option>
        </select>

        <div class="flex justify-center mt-6">
            <a href="<?= site_url('facilities') ?>" class="btn-back">Back to Facilities</a>
            <button type="submit" class="btn-submit">Create Facility</button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>
