<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Edit Participant<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="bg-white rounded-3xl shadow-xl p-8">
    <h1 class="text-2xl font-bold mb-4">Edit Participant</h1>
    <form action="<?= site_url('participants/update/' . $participant['id']) ?>" method="post" enctype="multipart/form-data">
        <div class="mb-4">
            <label for="name" class="block text-gray-700">Name</label>
            <input type="text" name="name" id="name" class="w-full px-4 py-2 border rounded-lg" value="<?= esc($participant['name']) ?>" required>
        </div>
        <div class="mb-4">
            <label for="email" class="block text-gray-700">Email</label>
            <input type="email" name="email" id="email" class="w-full px-4 py-2 border rounded-lg" value="<?= esc($participant['email']) ?>" required>
        </div>
        <div class="mb-4">
            <label for="phone" class="block text-gray-700">Phone</label>
            <input type="text" name="phone" id="phone" class="w-full px-4 py-2 border rounded-lg" value="<?= esc($participant['phone'] ?? '') ?>">
        </div>
        <div class="mb-4">
            <label for="profile_picture" class="block text-gray-700">Profile Picture</label>
            <input type="file" name="profile_picture" id="profile_picture" class="w-full px-4 py-2 border rounded-lg">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Participant</button>
    </form>
</div>
<?= $this->endSection() ?>