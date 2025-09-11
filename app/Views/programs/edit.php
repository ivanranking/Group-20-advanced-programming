<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?><?= $title ?><?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="flex justify-center mt-20">
    <div class="w-full max-w-2xl">
        <div class="bg-white shadow-xl p-6 rounded-3xl">
            <div class="text-center mb-6">
                <h4 class="text-2xl font-bold mb-0">Edit Program</h4>
            </div>
            <form action="<?= site_url('programs/' . $program['id']) ?>" method="post">
                <?= csrf_field() ?>
                <input type="hidden" name="_method" value="PUT">

                <div class="mb-4">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Name <span class="text-red-500">*</span></label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" id="name" name="name" value="<?= old('name', $program['name']) ?>" required>
                    <?php if (isset($errors['name'])): ?>
                        <div class="text-red-500 text-sm mt-1"><?= $errors['name'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Description</label>
                    <textarea class="w-full px-3 py-2 border border-gray-300 rounded-2xl focus:outline-none focus:ring-2 focus:ring-blue-500" id="description" name="description" rows="3"><?= old('description', $program['description']) ?></textarea>
                </div>

                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="start_date" class="block text-sm font-semibold text-gray-700 mb-2">Start Date</label>
                        <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" id="start_date" name="start_date" value="<?= old('start_date', $program['start_date']) ?>">
                    </div>
                    <div class="w-1/2">
                        <label for="end_date" class="block text-sm font-semibold text-gray-700 mb-2">End Date</label>
                        <input type="date" class="w-full px-3 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-blue-500" id="end_date" name="end_date" value="<?= old('end_date', $program['end_date']) ?>">
                    </div>
                </div>

                <div class="flex justify-between mt-6">
                    <a href="<?= site_url('programs/' . $program['id']) ?>" class="bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-full">Cancel</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-full">Update Program</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection() ?>