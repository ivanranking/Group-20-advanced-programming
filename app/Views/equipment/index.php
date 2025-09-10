<?= $this->extend('layouts/default') ?>

<?= $this->section('title') ?>Equipment Management<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-gray-800">Equipment Management</h1>
    <a href="<?= site_url('equipment/new') ?>" class="bg-blue-600 text-white px-6 py-3 rounded-xl font-medium flex items-center justify-center shadow-lg hover:bg-blue-700 transition duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>
        Add New Equipment
    </a>
</div>

<!-- Search and Filters -->
<div class="flex items-center space-x-4 mb-6">
    <div class="relative flex-1">
        <input type="text" id="search" placeholder="Search by capability or domain..." class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:border-blue-500">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 absolute left-3 top-1/2 transform -translate-y-1/2" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
        </svg>
    </div>
    <div class="flex space-x-2">
        <span class="text-gray-500 font-medium">Filter</span>
        <button class="px-4 py-2 rounded-lg text-blue-600 font-bold bg-blue-100 transition-colors" onclick="filterEquipment('all')">All</button>
        <button class="px-4 py-2 rounded-lg text-gray-600 font-medium hover:bg-gray-200 transition-colors" onclick="filterEquipment('active')">Active</button>
        <button class="px-4 py-2 rounded-lg text-gray-600 font-medium hover:bg-gray-200 transition-colors" onclick="filterEquipment('maintenance')">Maintenance</button>
        <button class="px-4 py-2 rounded-lg text-gray-600 font-medium hover:bg-gray-200 transition-colors" onclick="filterEquipment('retired')">Retired</button>
    </div>
</div>

<!-- Equipment Grid -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="equipmentGrid">
    <?php foreach ($equipment_list as $equipment): ?>
    <div class="bg-white rounded-xl shadow-lg p-4 flex flex-col space-y-4 equipment-card" data-status="active">
        <div class="flex items-center justify-between relative">
            <div class="bg-gray-800 text-white rounded-lg px-3 py-1 font-bold">ID: <?= esc($equipment['id']) ?></div>
            <div class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400 cursor-pointer" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" onclick="toggleDropdown(this)">
                    <circle cx="12" cy="12" r="1"></circle>
                    <circle cx="12" cy="5" r="1"></circle>
                    <circle cx="12" cy="19" r="1"></circle>
                </svg>
                <div class="absolute right-0 top-full mt-1 bg-white rounded-lg shadow-lg p-2 hidden z-10 min-w-[100px]" id="dropdown-<?= $equipment['id'] ?>">
                    <a href="<?= site_url('equipment/' . $equipment['id'] . '/edit') ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit</a>
                    <a href="<?= site_url('equipment/delete/' . $equipment['id']) ?>" class="block px-4 py-2 text-sm text-red-600 hover:bg-gray-100" onclick="return confirm('Are you sure?')">Delete</a>
                </div>
            </div>
        </div>
        <div class="flex justify-center">
            <img src="https://placehold.co/150x150/e0e0e0/ffffff?text=<?= substr(esc($equipment['name']), 0, 1) ?>" alt="<?= esc($equipment['name']) ?>" class="rounded-lg">
        </div>
        <div class="text-center font-bold text-gray-800"><?= esc($equipment['name']) ?></div>
        <div class="text-center text-gray-600"><?= esc($equipment['capability'] ?? 'N/A') ?> - <?= esc($equipment['domain'] ?? 'N/A') ?></div>
        <div class="flex items-center justify-center space-x-1">
            <span class="block w-2.5 h-2.5 rounded-full bg-green-500"></span>
            <span class="text-sm text-gray-500">Active</span>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<script>
function searchEquipment() {
    const input = document.getElementById('search');
    const filter = input.value.toLowerCase();
    const cards = document.querySelectorAll('.equipment-card');
    cards.forEach(card => {
        const text = card.textContent.toLowerCase();
        card.style.display = text.includes(filter) ? '' : 'none';
    });
}

document.getElementById('search').addEventListener('keyup', searchEquipment);

function filterEquipment(status) {
    const cards = document.querySelectorAll('.equipment-card');
    cards.forEach(card => {
        if (status === 'all' || card.dataset.status === status) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
    // Update button styles if needed
    document.querySelectorAll('[onclick^="filterEquipment"]').forEach(btn => btn.classList.remove('text-blue-600', 'bg-blue-100'));
    event.target.classList.add('text-blue-600', 'bg-blue-100');
}

function toggleDropdown(button) {
    const dropdownId = button.parentElement.querySelector('div').id;
    const dropdown = document.getElementById(dropdownId);
    dropdown.classList.toggle('hidden');
    // Close others if open
    document.querySelectorAll('.equipment-card .hidden').forEach(d => {
        if (d.id !== dropdownId) d.classList.add('hidden');
    });
}

// Close dropdown on outside click
document.addEventListener('click', function(event) {
    if (!event.target.closest('.relative')) {
        document.querySelectorAll('.equipment-card div[id^="dropdown-"]').forEach(d => d.classList.add('hidden'));
    }
});
</script>
<?= $this->endSection() ?>