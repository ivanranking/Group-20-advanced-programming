<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Participants<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="bg-white rounded-3xl shadow-xl p-8">
    <h1 class="text-2xl font-bold mb-4">Participants</h1>
    <a href="<?= site_url('participants/new') ?>" class="bg-blue-500 text-white px-4 py-2 rounded">Add Participant</a>
    <div class="overflow-x-auto mt-6">
        <table class="w-full table-auto">
            <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">ID</th>
                    <th class="py-3 px-6 text-left">Name</th>
                    <th class="py-3 px-6 text-center">Email</th>
                    <th class="py-3 px-6 text-center">Phone</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                <?php foreach ($participants as $participant): ?>
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">
                            <?= esc($participant['id']) ?>
                        </td>
                        <td class="py-3 px-6 text-left">
                            <?= esc($participant['name']) ?>
                        </td>
                        <td class="py-3 px-6 text-center">
                            <?= esc($participant['email']) ?>
                        </td>
                        <td class="py-3 px-6 text-center">
                            <?= esc($participant['phone'] ?? 'N/A') ?>
                        </td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex item-center justify-center">
                                <a href="<?= site_url('participants/view/' . $participant['id']) ?>" class="w-8 h-8 rounded-full bg-green-500 text-white flex items-center justify-center mr-2">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="<?= site_url('participants/edit/' . $participant['id']) ?>" class="w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center mr-2">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>
                                <a href="<?= site_url('participants/delete/' . $participant['id']) ?>" class="w-8 h-8 rounded-full bg-red-500 text-white flex items-center justify-center" onclick="return confirm('Are you sure you want to delete this participant?');">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection() ?>