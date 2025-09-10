<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Facilities<?= $this->endSection() ?>

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
    .facility-card {
        background: white;
        padding: 2rem;
        border-radius: 1.5rem;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        width: 100%;
        max-width: 80rem;
    }
    .search-input {
        width: 100%;
        padding: 0.75rem 1rem 0.75rem 2.5rem;
        border-radius: 0.75rem;
        border: 1px solid #d1d5db;
        outline: none;
    }
    .search-input:focus {
        border-color: #3b82f6;
    }
    .btn-primary-custom {
        background-color: #2563eb;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 0.75rem;
        font-weight: 500;
        font-size: 1.125rem;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s;
    }
    .btn-primary-custom:hover {
        background-color: #1d4ed8;
    }
    .btn-secondary-custom {
        background-color: #e5e7eb;
        color: #374151;
        padding: 0.5rem 1rem;
        border-radius: 0.75rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background-color 0.3s;
    }
    .btn-secondary-custom:hover {
        background-color: #d1d5db;
    }
    .table-custom {
        min-width: 100%;
        background: white;
    }
    .table-custom th {
        background-color: #f9fafb;
        color: #6b7280;
        text-transform: uppercase;
        font-size: 0.875rem;
        font-weight: bold;
        padding: 0.75rem 1.5rem;
        text-align: left;
    }
    .table-custom td {
        padding: 0.75rem 1.5rem;
        color: #4b5563;
        font-size: 0.875rem;
    }
    .table-custom tr:hover {
        background-color: #f3f4f6;
    }
    .status-select {
        background: transparent;
        border: 0;
        outline: none;
    }
</style>

<div class="facility-card">
    <!-- Header -->
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-3xl font-bold text-gray-800">Facilities</h1>
        <a href="<?= site_url('facilities/new') ?>" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-medium text-sm flex items-center hover:bg-blue-700 transition duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
            </svg>
            Add Facility
        </a>
    </div>

    <!-- Search Bar -->
    <div class="relative mb-4">
        <input type="text" id="search" placeholder="Search Facilities..." class="w-full pl-8 pr-4 py-2 rounded-lg border border-gray-300 focus:outline-none focus:border-blue-500 text-sm" onkeyup="searchFacilities()">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-gray-400 absolute left-2.5 top-1/2 transform -translate-y-1/2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
        </svg>
    </div>

    <!-- Facilities Table -->
    <div class="overflow-hidden rounded-xl shadow-md">
        <table class="table-custom" id="facilitiesTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($facilities) && is_array($facilities)): ?>
                    <?php foreach ($facilities as $facility): ?>
                        <tr>
                            <td><?= esc($facility['name']) ?></td>
                            <td><?= esc($facility['location']) ?></td>
                            <td><?= esc($facility['type']) ?></td>
                            <td>
                                <div class="flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <select class="status-select">
                                        <option value="active" <?= ($facility['status'] ?? '') === 'active' ? 'selected' : '' ?>>Active</option>
                                        <option value="inactive" <?= ($facility['status'] ?? '') === 'inactive' ? 'selected' : '' ?>>Inactive</option>
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="flex items-center space-x-2">
                                    <a href="<?= site_url('facilities/' . $facility['id']) ?>" class="btn-secondary-custom">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.523 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                        </svg>
                                        View
                                    </a>
                                    <a href="<?= site_url('facilities/edit/' . $facility['id']) ?>" class="btn-secondary-custom">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                            <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-2a1 1 0 112 0v2a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="<?= site_url('facilities/delete/' . $facility['id']) ?>" method="post" class="d-inline">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn-secondary-custom" onclick="return confirm('Are you sure you want to delete this facility?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.728-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center py-8">No facilities found.</td>
                    </tr>
                <?php endif ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function searchFacilities() {
    const input = document.getElementById('search');
    const filter = input.value.toLowerCase();
    const table = document.getElementById('facilitiesTable');
    const tr = table.getElementsByTagName('tr');

    for (let i = 1; i < tr.length; i++) {
        tr[i].style.display = '';
        const tdArray = tr[i].getElementsByTagName('td');
        let show = false;
        for (let j = 0; j < tdArray.length; j++) {
            if (tdArray[j]) {
                if (tdArray[j].innerText.toLowerCase().indexOf(filter) > -1) {
                    show = true;
                    break;
                }
            }
        }
        if (!show) {
            tr[i].style.display = 'none';
        }
    }
}
</script>
<?= $this->endSection() ?>
